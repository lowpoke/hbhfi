<?php

	
	
	$page_template = 'submit.htm';
	$page_type = 'file';
	
	$step = mysql_real_escape_string(GET('step','start'));
	$smarty->assign('step',$step);
	
	//if($step == 'details') { echo print_r($_SESSION); exit; }
	
	// Session vars
	
	$current_step					= SESSION('current_step',0);  // Steps...  0: start (login/sign-up), 1: details, 2: upload, 3: thumbnail, 4: preview, 5: finish
	$sub_in_progress      = SESSION('sub_in_progress',false);
	
	$new_project_id       = SESSION('new_project_id',NULL);
	$new_builder_id       = SESSION('new_builder_id',NULL);	
	$user_saved           = SESSION('user_saved',false);
	$upload_saved         = SESSION('upload_saved',false);
	$thumbnail_generated  = SESSION('thumbnail_generated',false);
	$error_fields = array(); $smarty->assign('error_fields',$error_fields); // for validation purposes
	
	// Form validation
	
	$post_valid = false;
	$validation_text = '';
	
	// Initialise project
	
	$project = array();			
	$smarty->assign('project',$project);
	
	
	// PROCESS ACTIONS
	
	if(isset($_POST))
		{
			$save_action = mysql_real_escape_string(POST('save_action',''));
			
			switch($save_action)
				{
					case 'login' :
					
						// Process login
						
						require('inc/submit_project/login.php');
												
					break;
					
					case 'sign_up' :
					
						// Process sign-up
												
						require('inc/submit_project/sign_up.php');
						
					break;
					
					
					case 'details' :
					
						require('inc/submit_project/project_details.php');
						
					break;
					
					
					case 'upload' :
					
						require('inc/submit_project/upload.php');
						
					break;
					
					
					case 'thumbnail' :
											
						$thumbnail_generated = false;
						
						if($thumbnail_generated == false)
							{								
								$thumbnail_file = POST('thumbnail_file','');
								
								if(strlen(trim($thumbnail_file)) > 0)
									{
										$project_path = 'images/projects/'.$new_project_id.'/';
										$thumbnail_path = $project_path.$thumbnail_file;
										
										if(file_exists($thumbnail_path))
											{									
												// Check if thumbnail is already in DB, delete if it does
												
												$check_thumb_SQL = "SELECT `image_id`,`image_filename` FROM `project_images` WHERE `image_type` = 'thumbnail' AND `image_project` = '".$new_project_id."' LIMIT 1";
												$check_thumb = db_select($check_thumb_SQL);
												
												if($check_thumb['num_rows'] > 0)
													{
														// Delete exisitng thumb
														
														$delete_thumb_SQL = "DELETE FROM `project_images` WHERE `image_type` = 'thumbnail' AND `image_project` = '".$new_project_id."'";														
														$delete_thumb = db_delete($delete_thumb_SQL);
													}
												
												$insert_image_SQL = "INSERT INTO `project_images` (`image_id`,`image_type`,`image_filename`,`image_project`,`image_builder`) VALUES (NULL,'thumbnail','".$thumbnail_file."',".$new_project_id.",23)";
												$insert_image = db_insert($insert_image_SQL);
												
												// Update project with new thumbnail
												
												$save_project_SQL = "UPDATE
																						 			`projects`
																						 SET
																						 
																						 	`project_thumbnail` = ".$insert_image['insert_ID']."
																						 																			 	
																						 WHERE
																						 
																						 	`project_id` = ".$new_project_id."";
																				 	
												$save_project = db_update($save_project_SQL);
												
												$_SESSION['thumbnail_generated'] = true;
												
												$_SESSION['current_step'] = 4;
												header("Location: ".ROOT."submit/preview");
											}
									}
							}
						
					break;
					
					case 'preview' :
						
						$save_project_SQL = "UPDATE
																		 			`projects`
																		 SET
																		 
																		 	`project_live` = 1
																		 																			 	
																		 WHERE
																		 
																		 	`project_id` = ".$new_project_id."";
																 	
						$save_project = db_update($save_project_SQL);
						
						if($save_project)
							{
								//  Refresh project count						
								include_once('inc/get_projects.php');
								refresh_project_count();
								
								$_SESSION['current_step'] = 5;
								header("Location: ".ROOT."submit/finish");
							}
						
						
					break;
						
				}		
		
		}
		
	
	if($step == 'start')
		{
			$_SESSION['show_submit_button'] = false;
			$show_submit_button = false;
			
			if($Auth->User_Authenticated() && $current_step > 0)
				{
					header("Location: ".ROOT."submit/details");
				}
			elseif($Auth->User_Authenticated() && $current_step == 0)
				{
					require('inc/submit_project/initiate_project.php');
					$new_project_id = initiate_project();
					$_SESSION['current_step'] = 1;
					header("Location: ".ROOT."submit/details");
				}
		}
		
	if($step == 'details')
		{
			if($current_step < 1)
				{
					header("Location: ".ROOT."submit");
				}
			
			include_once('inc/get_project.php');	
	
			// Get project data
			
			$get_project = get_project($new_project_id);
			
			if($get_project['exists'])
				{
					$project = $get_project['data'];					
					$smarty->assign('project',$project);
				}		
		}
		
	if($step == 'upload')
		{
			if($current_step < 2)
				{
					header("Location: ".ROOT."submit/details");
				}
		}	
		
	
	if($step == 'thumbnail')
		{
			if($current_step < 3)
				{
					header("Location: ".ROOT."submit/upload");
				}
			
			// Get project data
			
			include_once('inc/get_project.php');	
			$get_project = get_project($new_project_id);
			
			if($get_project['exists'])
				{
					$project = $get_project['data'];					
					$smarty->assign('project',$project);
				}
				
			// Get thumbnails
			
			$get_images = get_images($new_project_id,'full');
			$image_thumbnails = $get_images['data'];
			
			$first_image = $image_thumbnails[0];
			
			//echo var_dump($first_image); exit;
						
			$smarty->assign('image_thumbnails',$image_thumbnails);
			$smarty->assign('first_image',$first_image);
			$thumbnail_js = true;
			
		}
		
	
	if($step == 'preview')
		{
			if($current_step < 4)
				{
					header("Location: ".ROOT."submit/details");
				}
			
			include_once('inc/get_project.php');
			
			$preview_project = SESSION('preview_project',$new_project_id);
	
			// Get project data
			
			$get_project = get_project($preview_project);
			
			if($get_project['exists'])
				{
					$project = $get_project['data'];
		
					// Get images for this project
					
					$get_images = get_images($project['project_id']);
					$project_images = ($get_images['num_images']) ? $get_images['data'] : array();
					$smarty->assign('project_images',$project_images);
					
					$smarty->assign('project',$project);
					$smarty->assign('project_category',$project['category_slug']);
					
					$_SESSION['preview_project'] = $new_project_id; // Set preview_project var so script doesn't forget project after preview page refresh
				}
				
			
		}
		
	if($step == 'finish')
		{
			if($current_step < 5)
				{
					header("Location: ".ROOT."submit/preview");
				}
			
			include_once('inc/get_project.php');
			
			// Get project data
			
			$get_project = get_project($new_project_id);
			
			if($get_project['exists'])
				{
					$project = $get_project['data'];
		
					// Get images for this project
					
					$get_images = get_images($project['project_id']);
					$project_images = ($get_images['num_images']) ? $get_images['data'] : array();
					$smarty->assign('project_images',$project_images);
					
					$smarty->assign('project',$project);
					$smarty->assign('project_category',$project['category_slug']);
										
					
					if($current_step == 5)
						{			
							$current_step = 0;
							$new_project_id = NULL;
							$new_builder_id = NULL;
							$user_saved = false;
							$upload_saved = false;
							$thumbnail_generated = false;						
							$show_submit_button = true;							
							$project_created = false;						
										
							$_SESSION['current_step'] = $current_step;
							$_SESSION['new_project_id'] = $new_project_id;
							$_SESSION['new_builder_id'] = $new_builder_id;
							$_SESSION['user_saved'] = $user_saved;
							$_SESSION['upload_saved'] = $upload_saved;
							$_SESSION['thumbnail_generated'] = $thumbnail_generated;						
							$_SESSION['show_submit_button'] = $show_submit_button;						
							$_SESSION['project_created'] = $project_created;
							$_SESSION['sub_in_progress'] = false;
						}
					
				}
			
			}
	
	

/*
			
			$smarty->assign('project',$project);
			$smarty->assign('project_category',$project['category_slug']);
*/

			
?>
