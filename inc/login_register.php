<?php
	
	$page_template = 'login_register.htm';
	$page_type = 'file';
	
	// PROCESS ACTIONS
	
	if(isset($_POST))
		{
			$save_action = mysql_real_escape_string(POST('save_action',''));
			
			switch($save_action)
				{
					case 'login' :
					
						// Process login
						
							$smarty->assign('save_action','login');
	
							$login_email = POST('login_email','');
							$login_password = POST('login_password','');
							
							$login = $Auth->Process_Login($login_email,$login_password);
							
							if($login)
								{
									header("Location: ".ROOT);
								}
							else
								{
									$post_valid = false;
									$validation_text = $Auth->login_result;
									$smarty->assign('post_valid',$post_valid);
									$smarty->assign('validation_text',$validation_text);
									$smarty->assign('process_login',true);
									$smarty->assign('login_result',$Auth->login_result);
									$smarty->assign('login_valid',$Auth->login_valid);
								}
												
					break;
					
					case 'sign_up' :
					
						// Process sign-up
												
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
										
										session_regenerate_id(true);					
											
										$_SESSION['auth_initiated'] = true;
										$_SESSION['current_user'] = $new_builder_id;								
										$_SESSION['user_authenticated'] = true;
										$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
										$_SESSION['session_age'] = date("U");	
										
										header("Location: ".ROOT);
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
						

						
					break;
					
				}		
		
		}
		
			
?>