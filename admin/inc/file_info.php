<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	$exif = false;
	
	$file_data = array();
	
	$file = GET('file','');
	$folder = GET('folder','');

	$file_data['name'] = $file;	
	$file_data['path'] = 'files/'.$folder.'/';
	$file_data['size'] = file_size('../../files/'.$folder.'/'.$file);	
	$ext = strtolower(substr($file, strrpos($file, '.')+1));
	$file_data['ext'] = $ext;
	$file_data['icon'] = file_icon($ext);
	$file_data['type'] = file_type_str($ext);	
	$file_data['url'] = ROOT.$file_data['path'].$file;
		
	$mochaCMS->assign('file',$file_data);
	
	$mochaCMS->assign('ROOT',ROOT);
	
	$mochaCMS->display('file_info.html');
	

?>