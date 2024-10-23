<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	$gallery_ID = $_GET['gallery_ID'];
	
	$get_gallery_SQL = "SELECT * FROM `photo_galleries` WHERE `ID` = ".$gallery_ID." LIMIT 1";
	$get_gallery = db_select($get_gallery_SQL);
	
	$gallery = $get_gallery['result'][0];
	$mochaCMS->assign('gallery',$gallery);		

	$mochaCMS->display('edit_gallery.html');

?>