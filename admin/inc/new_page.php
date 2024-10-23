<?php

	$oFCKeditor = new FCKeditor('page_content') ;
	$oFCKeditor->BasePath	= ROOT.'admin/fckeditor/' ;
	$oFCKeditor->Width = 945;
	$oFCKeditor->Height = 650;
	$oFCKeditor->ToolbarSet = 'Basic';
	$oFCKeditor->Value = file_get_contents('templates/default_content.html') ;
	$fck = $oFCKeditor->CreateHtml() ;
	
	$get_sections_SQL = "SELECT * FROM `sections` ORDER BY `Name` ASC";
	$get_sections = db_select($get_sections_SQL);
	$sections = $get_sections['result'];
	$smarty->assign('sections',$sections);	
		
	$smarty->assign('fck',$fck);			
	$page_template = 'new_page.html' ;
	
?>