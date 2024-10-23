<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	$folder_type = $_GET['type'];
	if($folder_type == 'image')
		{
			$post_url = 'image_manager/new_folder';
		}
	elseif($folder_type == 'file')
		{
			$post_url = 'file_manager/new_folder';
		}
	
	//$mochaCMS->assign('upload_type',$show_info);
	//$mochaCMS->assign('post_url',$mod_path);
	
	$mochaCMS->display('new_folder.html');

?>