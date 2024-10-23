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
			$item['Created'] = parse_date($item['Created'],'yyyy-mm-dd h:mmS');
			$item['Type'] = $item['Link Type'];
			$item['Target'] = $item['Link Target'];
			
			$mochaCMS->assign('item',$item);
			$mochaCMS->assign('show_parent',$show_parent);		
			$mochaCMS->assign('show_destination',$show_destination);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
		
	if(isset($mod_path)) { $mochaCMS->assign('show_info',$show_info); }
	$mochaCMS->assign('ROOT',ROOT);
	
	$pages = get_pages();
	$mochaCMS->assign('pages',$pages['result']);
	
	$menu_items = menu_items($_GET['cur_menu']);
	$mochaCMS->assign('menu_items',$menu_items['result']);
	$mochaCMS->assign('cur_menu',$_GET['cur_menu']);
	
	$mochaCMS->display('edit_menu_item.html');

?>