<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	$level = GET('level',1);
	$parent = GET('parent','');
		
	$mochaCMS->assign('level',$level);
	$mochaCMS->assign('parent',$parent);
	$mochaCMS->assign('ROOT',ROOT);
	
	$pages = get_pages();
	$mochaCMS->assign('pages',$pages['result']);
	
	$menu_items = menu_items($_GET['cur_menu']);
	$mochaCMS->assign('menu_items',$menu_items['result']);
	$mochaCMS->assign('cur_menu',$_GET['cur_menu']);
	
	$mochaCMS->display('new_menu_item.html');

?>