<?php

	$get_comment_SQL = "SELECT * FROM `project_comments` WHERE `comment_id` = '".GET('ID',NULL)."'";
	$get_comment = db_select($get_comment_SQL);
	
	$comment = array();
	
	if($get_comment['num_rows'] > 0)
		{
			$comment = $get_comment['result'][0];
		}

	$smarty->assign('comment',$comment);
	
	$page_template = 'edit_comment.html' ;
	
?>