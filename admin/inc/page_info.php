<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['page_ID']))
		{
			$page_ID = $_GET['page_ID'];
			
			$get_page_SQL = "SELECT * FROM `pages` WHERE `ID` = ".$page_ID." LIMIT 1";
			$get_page = db_select($get_page_SQL);
			
			$page = $get_page['result'][0];
			$page['Created'] = parse_date($page['Created'],'yyyy-mm-dd h:mmS');
			$page['viewURL'] = substr($page['URL'],1);
			
			$mochaCMS->assign('page',$page);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
	
	if(isset($mod_path)) { $mochaCMS->assign('show_info',$show_info); }
	if(isset($mod_path)) { $mochaCMS->assign('mod_path',$mod_path); }
	
	$mochaCMS->assign('ROOT',ROOT);
	
	$mochaCMS->display('page_info.html');

?>