<?php

						include('functions/save_image.php');
						
						$max_size = 1024 * 5000;
						include('functions/upload_class.php');
						$upload_directory = 'images/projects/'.$project_id.'/';
						
						$upload_saved = false;
						$errors = array();
						$num_errors = 0;
						
						if($upload_saved == false)
							{						
								// Upload selected files
								
								$upload_fields = array('new_image');
								
								$images_uploaded = 0;
								
								for($u=0; $u<count($upload_fields); $u++)
									{
										if(array_key_exists($upload_fields[$u],$_FILES))
											{
												$file2upload = $upload_fields[$u];
												$upload = new file_upload;
												
												$upload->upload_dir = $upload_directory.'originals/';
												$upload->extensions = array(".jpg", ".jpeg", ".png");
												$upload->exclude = false;
												$upload->max_length_filename = 50;
												$upload->rename_file = false;
												
												$upload->the_temp_file = $_FILES[$file2upload]['tmp_name'];
												$upload->the_file = $_FILES[$file2upload]['name'];
												$upload->http_error = $_FILES[$file2upload]['error'];
												$upload->replace = 'y';
												$upload->do_filename_check = 'n';
												
												
												//Process upload
												
												if ($upload->upload())
													{
														$file = mysql_real_escape_string($upload->file_copy);
														$get_images_SQL = "SELECT 1 FROM project_images WHERE image_filename = '{$file}' AND image_project = {$project_id}";
														$get_images = db_select($get_images_SQL);
														
														if ($get_images['num_rows'] != 0)
														{
															$errors[] = 'Image <strong>"'.$upload->file_copy.'"</strong> already exists. To upload a new file, remove the old one first.';
															$num_errors++ ;
															continue;
														}
														
														
														$full_path = $upload->upload_dir.$upload->file_copy;
														$save_image = save_image($upload->file_copy,'w605',$upload_directory.'originals/',$upload_directory);
														
														if($save_image)
															{
																$insert_image_SQL = "INSERT INTO `project_images` (`image_id`,`image_type`,`image_filename`,`image_project`,`image_builder`) VALUES (NULL,'full','".$upload->file_copy."',".$project_id.",23)";
																$insert_image = db_insert($insert_image_SQL);
																
																$images_uploaded++ ;
															}
														else
															{
																$errors[] = 'Image <strong>"'.$upload->file_copy.'"</strong> failed to upload.';
																$num_errors++ ;
															}
														
													}
												else
													{
														if($_FILES[$file2upload]['name'])
															{
																$errors[] = 'Image <strong>"'.$_FILES[$file2upload]['name'].'"</strong> failed to upload.';
																$num_errors++ ;
															}
													}
											
											}							
									}
								
								
								if($num_errors == 0)
									{								
										header("Location: ".ROOT."update/{$project_id}/images");
										exit;
									}
								else
									{
										$error_text = '';
									
										foreach($errors as $error)
											{
												$error_text .= '<li>'.$error.'</li>';
											}
																					
										$post_valid = false;
										$smarty->assign('post_valid',$post_valid);
										$smarty->assign('error_text',$error_text);
									}
							}
						
?>
