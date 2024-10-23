<?php

	$get_builder_SQL = "SELECT * FROM `builders` WHERE `builder_id` = '".GET('ID',NULL)."'";
	$get_builder = db_select($get_builder_SQL);
	
	$builder = array();
	
	if($get_builder['num_rows'] > 0)
		{
			$builder = $get_builder['result'][0];
		}

	$smarty->assign('builder',$builder);
	
	$get_sections_SQL = "SELECT * FROM `sections` ORDER BY `Name` ASC";
	$get_sections = db_select($get_sections_SQL);
	$sections = $get_sections['result'];
	$smarty->assign('sections',$sections);	
		
	$builder_template = 'edit_builder.html' ;
	
?>