<?php

	
	switch($action)
		{
	
			case 'new_gallery' :

				
				$gallery_name = addslashes(POST('gallery_name',''));
				$create_gal_SQL = "INSERT INTO `photo_galleries` VALUES (NULL,'".$gallery_name."','".returnDate('yyyymmddhhmm')."','admin')";
				//echo $create_gal_SQL; exit;
				$create_gal = db_insert($create_gal_SQL);
					
				if($create_gal)
					{ $result = result('success','Gallery <b>"'.$gallery_name.'"</b> created successfully.'); }
				else
					{ $result = result('fail','Gallery <b>"'.$gallery_name.'"</b> could not be created.'); }

			break ;
			
			
			case 'upload' :
			
				$max_size = 1024 * 5000;
				include('functions/upload_class.php');
				include('../functions/image_editor.php');
				$my_upload = new file_upload;
				$upload_directory = '../images/'.POST('file_destination','').'/';
				
				$my_upload->upload_dir = $upload_directory;
				$my_upload->extensions = array(".png", ".jpg", ".gif");
				$my_upload->max_length_filename = 50;
				$my_upload->rename_file = false;
				
				$my_upload->the_temp_file = $_FILES['upload']['tmp_name'];
				$my_upload->the_file = $_FILES['upload']['name'];
				$my_upload->http_error = $_FILES['upload']['error'];
				$my_upload->replace = POST('replace','n');
				$my_upload->do_filename_check = POST('check','n');
				$new_name = (isset($_POST['name'])) ? $_POST['name'] : "";
				
				if ($my_upload->upload($new_name))
					{
						$full_path = $my_upload->upload_dir.$my_upload->file_copy;
						$info = $my_upload->get_uploaded_file_info($full_path);
					}
				
				$result = $my_upload->show_error_string();
				if(isset($info))
					{ $result = $info; }
			
			break;
			
			case 'remove' :

				$image_ID = POST('image_ID',0) ;
				$photo_gal = POST('photo_gal',0) ;
				$image_name = POST('image_name','');				
				$gallery_name = POST('gallery_name','');
				
				$remove_image_SQL = "DELETE FROM `photo_gallery_images` WHERE `ID` = ".$image_ID." AND `Photo_Gallery` = ".$photo_gal ;
																					
				//echo $remove_image_SQL;
				
				$remove_image = db_delete($remove_image_SQL);
				
				if($remove_image == true)
					{
						$result = result('success',"<strong>'".$image_name."'</strong> removed from <strong>".$gallery_name."</strong>");
					}
				else
					{
						$result = result('warning',"<strong>'".$image_name."'</strong> could not be removed from <strong>".$gallery_name."</strong>");
					}

			break;
			
			
			case 'edit_image' :
					// Define POST variables
					
					$image_ID      = POST('image_ID',NULL);
					$image_name    = POST('image_name','');
					$photo_gal     = POST('photo_gal',0);
					$caption       = addslashes(POST('caption',''));
										
					$edit_image_SQL = "UPDATE `photo_gallery_images` SET
																								`Caption` = '".$caption."'  
																						
																						WHERE `ID` = ".$image_ID." AND `Photo_Gallery` = ".$photo_gal;
																						
					#echo $edit_image_SQL;
					
					$edit_image = db_update($edit_image_SQL);
					
					if($edit_image == true)
						{
							$result = result('success',"Changes to <strong>'".POST('image_name','')."'</strong> saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to <strong>'".POST('image_name','')."'</strong> have been saved.");
						}
					
					break;
			
			
			case 'save_order' :
					// Define POST variables
					
					$new_order = POST('new_order','');
					$photo_gal = POST('photo_gal',0);
					$items = array();

					if(strlen(trim($new_order)) > 0)
						{
							$new_order = substr($new_order,0,-1);
							$new_order = explode(',',$new_order);
							
							if(count($new_order) > 0)
								{
									$cnt = 0;
									foreach($new_order as $item)
										{
											$item = explode(':',$item);
											$items[$cnt]['ID'] = $item[0];
											$items[$cnt]['order'] = $item[1];
											$cnt++;
										}
								}
								
							if(count($items) > 	0)
								{
									$success = 0;
									foreach($items as $item)
										{
											$save_item_SQL = "UPDATE `photo_gallery_images` SET `Order` = ".$item['order']." WHERE `ID` = ".$item['ID']." AND `Photo_Gallery` = ".$photo_gal ;
											$save_item = db_update($save_item_SQL);
											//echo $save_item_SQL.'<br />';
											
											if($save_item) $success++;
										}
										
									$result = result('success','<strong>'.$success.'</strong> item'.plural($success).' re-ordered successfully.');
								}
						
						}
					else
						{
							$result = result('warning','<strong>No items re-ordered.</strong>');
						}
					
					break;
					
					
					
				case 'add_images' :
					// Define POST variables
					
					$images      = POST('images',array());
					$photo_gal   = POST('photo_gal',0);
					
					$success = 0;
					
					foreach($images as $image)
						{
							$image = explode(':',$image);
														
							$add_image_SQL = "INSERT INTO `photo_gallery_images` (`ID`,`Photo_Gallery`,`Image`,`Folder`) VALUES (NULL,".$photo_gal.",'".$image[1]."','".$image[0]."')";
																								
							//echo $add_image_SQL.'<br />';
							
							$add_image = db_update($add_image_SQL);
							
							if($add_image)
								{
									$success++;
								}					
						}
					
					if($success > 0)
						{
							$result = result('success',"<strong>".$success."</strong> image".plural($success)." added to photo gallery.");
						}
					else
						{
							$result = result('warning',"No images added to photo gallery.");
						}
					
					break;
					
					case 'delete_gallery' :
					
						$gallery_ID = GET('gallery_ID',0);
						
						$get_gallery_SQL = "SELECT * FROM `photo_galleries` WHERE `ID` = ".$gallery_ID." LIMIT 1";
						$get_gallery = db_select($get_gallery_SQL);						
						$gallery = $get_gallery['result'][0];
						
						$delete_gal_SQL = "DELETE FROM `photo_galleries` WHERE `ID` = ".$gallery_ID ;
						#echo $delete_gal_SQL;
						$delete_gal = db_delete($delete_gal_SQL);
						
						if($delete_gal)
							{
								$result = result('success',"Photo gallery <strong>".$gallery['Name']."</strong> deleted.");
							}
						else
							{
								$result = result('warning',"<strong>".$gallery['Name']."</strong> could not be deleted.");
							}
					
					
					
					break;
					
					
					case 'edit_gallery' :
					
						$gallery_ID = POST('gallery_ID',0);
						$gallery_name = addslashes(POST('gallery_name',''));
						
						$edit_gal_SQL = "UPDATE `photo_galleries` SET `Name` = '".$gallery_name."' WHERE `ID` = ".$gallery_ID ;
						#echo $edit_gal_SQL;
						$edit_gal = db_update($edit_gal_SQL);
						
						if($edit_gal)
							{
								$result = result('success',"Changes to <strong>".$gallery_name."</strong> saved successfully.");
							}
						else
							{
								$result = result('fail',"No changes to <strong>".$gallery_name."</strong> saved.");
							}
					
					
					
					break;
			
			
		}
	
	if(isset($result)) { $smarty->assign('result',$result);	}
	
	
	$get_galleries_SQL = "SELECT * FROM `photo_galleries` ORDER BY `Name` ASC";
	$get_galleries = db_select($get_galleries_SQL);
	
	$galleries = $get_galleries['result'];
	$smarty->assign('galleries',$galleries);
	
	$cur_gallery = GET('gallery',0);
	$get_gal_SQL = "SELECT * FROM `photo_galleries` WHERE `ID` = ".$cur_gallery." LIMIT 1";
	$get_gal = db_select($get_gal_SQL);
	
	$images = image_list('../images/'.$folder,array());
	
	$get_images_SQL = "SELECT * FROM `photo_gallery_images` WHERE `Photo_Gallery` = ".$cur_gallery." ORDER BY `Order` ASC" ;
	$get_images = db_select($get_images_SQL);
	
	$images = $get_images['result'];
	
	if(isset($cur_gallery))
		{
	
			for($i=0; $i<count($images); $i++)
				{			
					$images[$i]['name'] = $images[$i]['Image'];
					$images[$i]['path'] = '../images/'.$images[$i]['Folder'].'/';
					$images[$i]['folder_var'] = '&amp;folder='.$images[$i]['Folder'];
					
					$images[$i]['orientation'] = image_orientation($images[$i]['path'].$images[$i]['name']);
					
					if($images[$i]['orientation'] == 'landscape')
						{
							$images[$i]['dimension'] = 's150x113';
						}
					elseif($images[$i]['orientation'] == 'portrait')
						{
							$images[$i]['dimension'] = 's113x150';
						}
					if($images[$i]['orientation'] == 'square')
						{
							$images[$i]['dimension'] = 's150x113';
						}
						
					$images[$i]['dimension_str'] = image_size_WxH($images[$i]['path'].$images[$i]['name']);
					
					if(strlen($images[$i]['name'] > 25))
						{
							$images[$i]['short_name'] = substr($images[$i]['name'],0,10).'...'.substr($images[$i]['name'],-10);
						}
					else
						{
							$images[$i]['short_name'] = $images[$i]['name'];
						}
						
					$img_size = image_size($images[$i]['path'].$images[$i]['name']);
					
					if($img_size['width'] > 1000 || $img_size['height'] > 800)
						{
							$images[$i]['img_url'] = ROOT.'inc/img.php?dimension=h800&amp;folder='.$images[$i]['Folder'].'&amp;image='.$images[$i]['name'];
							
							$img_diff = 800 / $img_size['height'];					
							$images[$i]['dimension_str'] = ($img_size['width'] * $img_diff).'x800';
						}
					else
						{					
							$images[$i]['img_url'] = ROOT.'images/'.$images[$i]['Folder'].'/'.$images[$i]['name'];
						}
					
				}
		}
		
		
	if($get_gal['num_rows'] > 0)
		{
			$cur_gallery = $get_gal['result'][0];
		}
	else
		{
			$cur_gallery = array();
			$cur_gallery['ID'] = GET('gallery',0);
		}
		
	$smarty->assign('cur_gallery',$cur_gallery);
		
		
	$smarty->assign('images',$images);
	$smarty->assign('num_images',count($images));
	
		
	$page_template = 'photo_galleries.html' ;
	
?>