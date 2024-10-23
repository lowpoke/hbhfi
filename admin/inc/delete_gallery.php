<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['gallery_ID']))
		{
			$gallery_ID = $_GET['gallery_ID'];
			
			$get_gallery_SQL = "SELECT * FROM `photo_galleries` WHERE `ID` = ".$gallery_ID." LIMIT 1";
			$get_gallery = db_select($get_gallery_SQL);
			
			$gallery = $get_gallery['result'][0];
			$mochaCMS->assign('gallery',$gallery);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}

	$mochaCMS->display('delete_gallery.html');

?>