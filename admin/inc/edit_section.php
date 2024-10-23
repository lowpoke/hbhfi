<?php

	$get_section_SQL = "SELECT * FROM `sections` WHERE `ID` = '".GET('ID',NULL)."'";
	$get_section = db_select($get_section_SQL);
	$section = array();
	
	$get_pages_SQL = "SELECT * FROM `pages` WHERE `Trash` = 0 ORDER BY `Name` ASC";
	$get_pages = db_select($get_pages_SQL);
	$pages = $get_pages['result'];
	
	if($get_section['num_rows'] > 0)
		{
			$section = $get_section['result'][0];
		}

	$smarty->assign('section',$section);
	$smarty->assign('pages',$pages);
		
	$page_template = 'edit_section.html' ;
	
?>