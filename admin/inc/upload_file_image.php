<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	$file_destination = substr($_GET['file_destination'],0,-1);
	
	$upload_type = $_GET['type'];
	if($upload_type == 'image')
		{
			$post_url = 'image_manager/'.$file_destination;
		}
	elseif($upload_type == 'file')
		{
			$post_url = 'file_manager/'.$file_destination;
		}
	
	$mochaCMS->assign('file_destination',$file_destination);
	//$mochaCMS->assign('upload_type',$show_info);
	//$mochaCMS->assign('post_url',$mod_path);
	
	$mochaCMS->display('upload_file_image.html');

?>