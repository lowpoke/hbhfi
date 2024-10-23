<?php

	$get_page_SQL = "SELECT * FROM `pages` WHERE `ID` = '".GET('ID',NULL)."'";
	$get_page = db_select($get_page_SQL);
	
	$page = array();
	
	if($get_page['num_rows'] > 0)
		{
			$page = $get_page['result'][0];

			$oFCKeditor = new FCKeditor('page_content') ;
			$oFCKeditor->BasePath	= ROOT.'admin/fckeditor/' ;
			$oFCKeditor->Width = 945;
			$oFCKeditor->Height = 650;
			$oFCKeditor->ToolbarSet = 'Basic';
			$oFCKeditor->Value = stripslashes($page['Content']) ;
			$fck = $oFCKeditor->CreateHtml() ;
			
			$smarty->assign('fck',$fck);			
		}

	$smarty->assign('page',$page);
	
	$get_sections_SQL = "SELECT * FROM `sections` ORDER BY `Name` ASC";
	$get_sections = db_select($get_sections_SQL);
	$sections = $get_sections['result'];
	$smarty->assign('sections',$sections);	
		
	$page_template = 'edit_page.html' ;
	
?>