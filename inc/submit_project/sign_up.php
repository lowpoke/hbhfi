<?php

						$smarty->assign('save_action','sign_up');
						
						// POST vars
						
						$user_nickname   = mysql_real_escape_string(POST('user_nickname',''));
						$user_first_name = mysql_real_escape_string(POST('user_first_name',''));
						$user_last_name  = mysql_real_escape_string(POST('user_last_name',''));
						$user_email      = mysql_real_escape_string(POST('user_email',''));						
						$user_country    = mysql_real_escape_string(POST('user_country',''));				
						$user_password   = mysql_real_escape_string(POST('user_password',''));
						$user_confirm_password   = mysql_real_escape_string(POST('user_confirm_password',''));
						
						// Validate Fields
						
						$validated = true;
						$missing_fields = array();
						$error_fields = array();
												
						if(!validate_text($user_nickname)) { $validated = false; $missing_fields[] = '<em>&quot;Nickname&quot;</em> required'; $error_fields[] = 'user_nickname'; }
						if(!validate_text($user_first_name)) { $validated = false; $missing_fields[] = '<em>&quot;First Name&quot;</em> required'; $error_fields[] = 'user_first_name'; }
						if(!validate_text($user_last_name)) { $validated = false; $missing_fields[] = '<em>&quot;Last Name&quot;</em> required'; $error_fields[] = 'user_last_name'; }
						if(!valid_email($user_email)) { $validated = false; $missing_fields[] = 'Valid <em>&quot;Email Address&quot;</em> required'; $error_fields[] = 'user_email'; }
						if($user_country == 'NULL') { $validated = false; $missing_fields[] = '<em>&quot;Country&quot;</em> required'; $error_fields[] = 'user_country'; }
						if(!validate_text($user_password)) { $validated = false; $missing_fields[] = '<em>&quot;Password&quot;</em> required'; $error_fields[] = 'password'; }
						if($user_password != $user_confirm_password) { $validated = false; $missing_fields[] = 'Passwords must match'; $error_fields[] = 'password'; }
						
						// Check email to see if it's already in use
						
						$check_email_SQL = "SELECT `builder_id` FROM `builders` WHERE `builder_email` = '".$user_email."' LIMIT 1";
						$check_email = db_select($check_email_SQL);
						if(strlen($user_email) > 0 && $check_email['num_rows'] > 0)
							{
								// Email/user already exists
								
								$validated = false;
								$error_fields[] = 'user_email';
								$smarty->assign('email_error',true);
							}
						else
							{
								$smarty->assign('email_error',false);
							}
							
							
						// Save data and move on	
						
						if($validated)
							{
				
								$save_builder_SQL = "INSERT INTO
																		 		`builders`
																		 	(
																			 	`builder_short_name`, 
																				`builder_first_name`,
																				`builder_last_name`,
																				`builder_email`,
																				`builder_country`,
																				`builder_password`
																			 )
																		 	
																		 VALUES
																		 	(
																			 	'".$user_nickname."',																 	
																			 	'".$user_first_name."',
																			 	'".$user_last_name."',																 	
																			 	'".$user_email."',															 	
																			 	'".$user_country."',											 	
																			 	'".md5(md5($user_password))."'
																		 	)";
								
								
								$user_saved = false;
								
								if($user_saved == false)
									{							
										$save_builder = db_insert($save_builder_SQL);
										$new_builder_id = $save_builder['insert_ID'];
										$_SESSION['new_builder_id'] = $new_builder_id;
										
										//session_regenerate_id(true);
										
										require('inc/submit_project/initiate_project.php');
										$new_project_id = initiate_project();
											
										$_SESSION['auth_initiated'] = true;
										$_SESSION['current_user'] = $new_builder_id;								
										$_SESSION['user_authenticated'] = true;
										$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
										$_SESSION['session_age'] = date("U");	
								
										// Update project with new builder
										
										$save_project_SQL = "UPDATE
																				 			`projects`
																						 SET																		 
																						 	`project_builder` = '".$new_builder_id."'																		 	
																						 WHERE																		 
																						 	`project_id` = ".$new_project_id."";
																						 																					 	
										$save_project = db_update($save_project_SQL);
										
										if($save_project)
											{
												$_SESSION['sub_in_progress'] = true;
												$_SESSION['current_step'] = 1;
												
												//echo print_r($_SESSION); //exit;
												
												//echo '<a href="/submit/details">details</a>'; exit;
												
												header("Location: ".ROOT."submit/details");
											}
										else
											{										
												$post_valid = false;
												$validation_text = 'Project data could not be saved.  Please reload to try again.';
												$smarty->assign('post_valid',$post_valid);
												$smarty->assign('validation_text',$validation_text);
											}
											
										$_SESSION['user_saved'] = $user_saved;
										
									}
							
							}
						else
							{
								$validation_text = '<strong>Please check the following:</strong><p>';
								
								foreach($missing_fields as $mfield)
									{
										$validation_text .= $mfield.'<br />';
									}
									
								$validation_text .= '</p>';
								
								$post_valid = false;
								$smarty->assign('post_valid',$post_valid);
								$smarty->assign('validation_text',$validation_text);								
								$smarty->assign('error_fields',$error_fields);
							}
						
						//echo $save_builder_SQL;
						
?>