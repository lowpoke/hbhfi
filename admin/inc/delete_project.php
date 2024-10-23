<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['project_ID']))
		{
			$project_ID = $_GET['project_ID'];
			
			$get_project_SQL = "SELECT * FROM `projects` WHERE `project_id` = ".$project_ID." LIMIT 1";
			$get_project = db_select($get_project_SQL);
			
			$page = $get_project['result'][0];
			$page['Name'] = $page['project_name'];
			
						
			$mochaCMS->assign('page',$page);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
	
	$mochaCMS->display('delete_page.html');

?>