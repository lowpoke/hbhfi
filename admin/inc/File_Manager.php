<?php

	
	switch($action)
		{
	
			case 'new_folder' :

				
				$folder_path = '../files/'.POST('folder_name','');
				
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
				$my_upload = new file_upload;
				$upload_directory = '../files/'.POST('file_destination','').'/';
				
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
				$file_path = '../files/'.$folder.'/'.$file;
				
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
				$folder_path = '../files/'.$folder;
				
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
	
	
	$folders = folder_list('../files/',array('multi','old','cache'));
	$smarty->assign('folders',$folders);
	
	
	$folder = isset($_GET['folder']) ? $_GET['folder'].'/' : '' ;
	$cur_folder = (strlen($folder) > 0) ? $folder : '' ;
	
	if(strlen($folder) > 0)
		{
			$show_contents = true;
		}
	else
		{
			$show_contents = false;
		}
	
	$smarty->assign('cur_folder',$cur_folder);
	$smarty->assign('show_contents',$show_contents);
	
	if(isset($_GET['folder']))
		{
			$files = files_list('../files/'.$folder,array(),array());
			for($f=0; $f<count($files); $f++)
				{
					$files[$f]['size'] = file_size($files[$f]['path'].$files[$f]['name']);
					
					$file = $files[$f]['name'];
					
					if(strlen($file) > 35)
						{
							$file_str = substr($file,0,15).'...'.substr($file,-15);
							$files[$f]['short_name'] = '<abbr title="'.$files[$f]['name'].'">'.$file_str.'</abbr>';
						}
					else
						{
							$files[$f]['short_name'] = $file;
						}
				}
		}
	else
		{
			$files = array();
		}
		
		
		
	$smarty->assign('files',$files);
	$smarty->assign('num_files',count($files));
	
		
	$page_template = 'file_manager.html' ;
	
?>