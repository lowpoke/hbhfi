<?php

						$project_category =     mysql_real_escape_string(POST('project_category',''));
						$project_item =         mysql_real_escape_string(POST('project_item',''));
						$project_type =         mysql_real_escape_string(POST('project_type',''));
						$project_name =         mysql_real_escape_string(POST('project_name',''));
						$project_description =  mysql_real_escape_string(POST('project_description',''));
						
						// Validate Fields
						
						$validated = true;
						$missing_fields = array();
						$error_fields = array();
												
						if($project_category == 'NULL') { $validated = false; $missing_fields[] = '<em>&quot;Category&quot;</em> required'; $error_fields[] = 'project_category'; }
						if(!validate_text($project_item)) { $validated = false; $missing_fields[] = '<em>&quot;Item&quot;</em> required'; $error_fields[] = 'project_item'; }
						if(!validate_text($project_type)) { $validated = false; $missing_fields[] = '<em>&quot;Project Type&quot;</em> required'; $error_fields[] = 'project_type'; }
						if(!validate_text($project_name)) { $validated = false; $missing_fields[] = '<em>&quot;Project Name&quot;</em> required'; $error_fields[] = 'project_name'; }
						if(!validate_text($project_description)) { $validated = false; $missing_fields[] = '<em>&quot;Description&quot;</em> required'; $error_fields[] = 'project_description'; }
						
						// Save project
				
						if($validated)
							{
						
								$save_project_SQL = "UPDATE
																		 			`projects`
																		 SET
																		 
																		 	`project_category` = '".$project_category."',
																		 	`project_type` = '".$project_type."',
																		 	`project_name` = '".$project_name."',																 	
																		 	`project_item` = '".$project_item."',
																		 	`project_description` = '".$project_description."'
																		 	
																		 WHERE
																		 
																		 	`project_id` = ".$new_project_id."";
																		 	
								$save_project = db_update($save_project_SQL);
								
								if($Auth->User_Authenticated())
									{
										$save_project_SQL = "UPDATE
																		 			`projects`
																				 SET																		 
																				 	`project_builder` = '".$Auth->Current_User()."'																		 	
																				 WHERE																		 
																				 	`project_id` = ".$new_project_id."";
																		 	
										$save_project = db_update($save_project_SQL);
																				
										if($save_project)
											{										
												$_SESSION['current_step'] = 2;
												header("Location: ".ROOT."submit/upload");
											}
										else
											{
												$post_valid = false;
												$validation_text = 'Project data could not be saved.  Please reload to try again.';
												$smarty->assign('post_valid',$post_valid);
												$smarty->assign('validation_text',$validation_text);
											}
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
						
?>