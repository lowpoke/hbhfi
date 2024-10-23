<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['image']))
		{
			$image = $_GET['image'];			
			
			$get_image_SQL = "SELECT * FROM `photo_gallery_images` WHERE `ID` = ".$image." LIMIT 1" ;
			//echo $get_image_SQL;
			$get_image = db_select($get_image_SQL);
			
			$image = array();
			
			if($get_image['num_rows'] > 0)
				{
					$image = $get_image['result'][0];
				}
						
			$mochaCMS->assign('image',$image);
			$mochaCMS->assign('cur_gallery',$image['Photo_Gallery']);
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
		
	if(isset($mod_path)) { $mochaCMS->assign('show_info',$show_info); }
	$mochaCMS->assign('ROOT',ROOT);
	
	$mochaCMS->display('edit_photo_gal_image.html');

?>