<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['category_ID']))
		{
			$category_ID = $_GET['category_ID'];
			
			$get_category_SQL = "SELECT * FROM `news_categories` WHERE `ID` = ".$category_ID." LIMIT 1";
			$get_category = db_select($get_category_SQL);
			
			$category = $get_category['result'][0];
			
			$mochaCMS->assign('category',$category);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
	
	$mochaCMS->display('delete_news_category.html');

?>