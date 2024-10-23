<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['comment_ID']))
		{
			$comment_ID = $_GET['comment_ID'];
			
			$get_comment_SQL = "SELECT * FROM `project_comments` WHERE `comment_id` = ".$comment_ID." LIMIT 1";
			$get_comment = db_select($get_comment_SQL);
			
			$comment = $get_comment['result'][0];
			$page['Name'] = '"'. ((strlen($comment['comment_comment']) > 25) ? substr($comment['comment_comment'],0,25).'...' : $comment['comment_comment']) . '"';
			
						
			$mochaCMS->assign('page',$page);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
	
	$mochaCMS->display('delete_page.html');

?>