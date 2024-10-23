<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	$destination = GET('destination','');
	$folder = substr(GET('folder',''),0,-1);
	
	if($destination == 'images')
		{
			$post_url = 'image_manager/'.$folder;
		}
	elseif($destination == 'files')
		{
			$post_url = 'file_manager/'.$folder;
		}
	
	$file = GET('file','');
	
	$mochaCMS->assign('post_url',$post_url);
	$mochaCMS->assign('file',$file);
	$mochaCMS->assign('folder',$folder);
	$mochaCMS->display('delete_file.html');

?>