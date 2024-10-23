<?php

	$get_pages_SQL = "SELECT * FROM `pages` WHERE `Trash` = 0 ORDER BY `Name` ASC";
	$get_pages = db_select($get_pages_SQL);
	$pages = $get_pages['result'];

	$smarty->assign('pages',$pages);
		
	$page_template = 'new_section.html' ;
	
?>