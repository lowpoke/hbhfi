<?php

						include('functions/save_image.php');
						
						$max_size = 1024 * 5000;
						include('functions/upload_class.php');
						$upload_directory = 'images/projects/'.$new_project_id.'/';
						
						$upload_saved = false;
						$errors = array();
						$num_errors = 0;
						
						if($upload_saved == false)
							{						
								// Check & clear existing images for project
																
								$check_images_SQL = "SELECT `image_id`,`image_filename` FROM `project_images` WHERE `image_project` = '".$new_project_id."' AND `image_type` = 'full'";
								$check_images = db_select($check_images_SQL);
																								
								if($check_images['num_rows'] > 0)
									{
										for($ci=0; $ci<$check_images['num_rows']; $ci++)
											{
												$checked_image = $check_images['result'][$ci];
												$checked_edited = $upload_directory.$checked_image['image_filename'];
												$checked_originals = $upload_directory.'originals/'.$checked_image['image_filename'];
												
												if(file_exists($checked_edited))
													{
														unlink($checked_edited);
													}
												
												if(file_exists($checked_originals))
													{
														unlink($checked_originals);
													}
											}
																												
										$clear_images_SQL = "DELETE FROM `project_images` WHERE `image_project` = '".$new_project_id."'";
										$clear_images = db_delete($clear_images_SQL);
									}
									
								// Upload selected files
								
								$upload_fields = array('image_one','image_two','image_three','image_four','image_five');
								
								//$upload_fields = array('image_one');
						
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
														$full_path = $upload->upload_dir.$upload->file_copy;
														$save_image = save_image($upload->file_copy,'w605',$upload_directory.'originals/',$upload_directory);
														
														if($save_image)
															{
																$insert_image_SQL = "INSERT INTO `project_images` (`image_id`,`image_type`,`image_filename`,`image_project`,`image_builder`) VALUES (NULL,'full','".$upload->file_copy."',".$new_project_id.",23)";
																$insert_image = db_insert($insert_image_SQL);
																
																$images_uploaded++ ;
															}
														else
															{
																$errors[] = 'Image '.($u + 1).' - <strong>"'.$upload->file_copy.'"</strong> failed to upload.';
																$num_errors++ ;
															}
														
													}
												else
													{
														if($_FILES[$file2upload]['name'])
															{
																$errors[] = 'Image '.($u + 1).' - <strong>"'.$_FILES[$file2upload]['name'].'"</strong> failed to upload.';
																$num_errors++ ;
															}
													}
											
											}							
									}
																	
								if($images_uploaded == 0)
									{
										$errors[] = '<strong>Please select at least one image to upload.</strong>';
										$num_errors++ ;
									}
								
								if($num_errors == 0)
									{								
										$_SESSION['current_step'] = 3;
										$_SESSION['upload_saved'] = true;
										header("Location: ".ROOT."submit/thumbnail");
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