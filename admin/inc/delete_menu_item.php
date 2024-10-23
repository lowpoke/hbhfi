<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['item_ID']))
		{
			$item_ID = $_GET['item_ID'];			
			$item = menu_item($item_ID);
		}
	
	$mochaCMS->assign('item',$item);
	
	$mochaCMS->display('delete_menu_item.html');

?>