<?php

	
	switch($action)
		{
	
			case 'new_folder' :

				
				$folder_path = '../images/'.POST('folder_name','');
				
				if(file_exists($folder_path))
					{
						$result = result('warning','Folder <b>"'.POST('folder_name','').'"</b> already exists.');
					}
				else
					{				
						$create_folder = mkdir($folder_path);
					
						if($create_folder)
							{ $result = result('success','Folder <b>"'.POST('folder_name','').'"</b> created successfully.'); }
						else
							{ $result = result('fail','Folder <b>"'.POST('folder_name','').'"</b> could not be created.'); }
					}
					
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
			
			case 'delete' :

				$file = POST('file','') ;
				$folder = POST('folder','') ;
				$file_path = '../images/'.$folder.'/'.$file;
				
				if(file_exists($file_path))
					{				
						$delete_file = unlink($file_path);
						if($delete_file)
							{ $result = result('success', 'File "<strong>'.$file.'</strong>" deleted.'); }
						else
							{ $result = result('fail', 'File "<strong>'.$file.'</strong>" could not deleted.'); }
					}
				else
					{
						$result = result('warning', 'File "<strong>'.$file.'</strong>" does not exist in this folder.');
					}

			break;
			
			
			case 'delete_folder' :

				$folder = POST('folder','') ;
				$folder_path = '../images/'.$folder;
				
				if(file_exists($folder_path))
					{				
						$delete_folder = deleteDirectory($folder_path,false);
						if($delete_folder)
							{ $result = result('success', 'Folder "<strong>'.$folder.'</strong>" deleted.'); }
						else
							{ $result = result('fail', 'Folder "<strong>'.$folder.'</strong>" could not deleted.'); }
					}
				else
					{
						$result = result('warning', 'Folder "<strong>'.$folder.'</strong>" does not exist.');
					}

			break;
			
			
		}
	
	if(isset($result)) { $smarty->assign('result',$result);	}
	
	
	$folders = folder_list('../images/',array('multi','old','cache','projects','layout'));
	$smarty->assign('folders',$folders);
	
	
	$folder = isset($_GET['folder']) ? $_GET['folder'].'/' : '' ;
	$image_folder = (strlen($folder) > 0) ? '&amp;folder='.$folder : '' ;
	$cur_folder = (strlen($folder) > 0) ? $folder : '' ;
	
	$smarty->assign('image_folder',$image_folder);
	$smarty->assign('cur_folder',$cur_folder);
	
	$images = image_list('../images/'.$folder,array());
	
	if(isset($_GET['folder']))
		{
	
			for($i=0; $i<count($images); $i++)
				{			
					$images[$i]['name'] = $images[$i]['name'];
					
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
							$images[$i]['img_url'] = ROOT.'inc/img.php?dimension=h800&amp;folder='.$cur_folder.'&amp;image='.$images[$i]['name'];
							
							$img_diff = 800 / $img_size['height'];					
							$images[$i]['dimension_str'] = ($img_size['width'] * $img_diff).'x800';
						}
					else
						{					
							$images[$i]['img_url'] = ROOT.'images/'.$cur_folder.$images[$i]['name'];
						}
					
				}
		}
		
		
		
	$smarty->assign('images',$images);
	$smarty->assign('num_images',count($images));
	
		
	$page_template = 'image_manager.html' ;
	
?>