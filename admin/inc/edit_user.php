<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['user_ID']))
		{
			$user_ID = $_GET['user_ID'];
			
			$get_user_SQL = "SELECT * FROM `user_accounts` WHERE `ID` = ".$user_ID." LIMIT 1";
			$get_user = db_select($get_user_SQL);
			
			$user = $get_user['result'][0];
			$user['Created'] = parse_date($user['Created'],'yyyy-mm-dd h:mmS');
			
			$mochaCMS->assign('user',$user);	
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}

	$mochaCMS->assign('ROOT',ROOT);
	
	$mochaCMS->display('edit_user.html');

?>