<?php

	$oFCKeditor = new FCKeditor('article_content') ;
	$oFCKeditor->BasePath	= ROOT.'admin/fckeditor/' ;
	$oFCKeditor->Width = 945;
	$oFCKeditor->Height = 650;
	$oFCKeditor->ToolbarSet = 'Basic';
	$oFCKeditor->Value = file_get_contents('templates/default_news_article.html') ;
	$fck = $oFCKeditor->CreateHtml() ;
	$smarty->assign('fck',$fck);			
	
	$get_categories_SQL = "SELECT * FROM `news_categories` ORDER BY `Name` ASC";
	$get_categories = db_select($get_categories_SQL);
	$categories = $get_categories['result'];
	$smarty->assign('categories',$categories);	
	
	$smarty->assign('sample_date',returnDate('mysql'));	
		
	$page_template = 'new_article.html' ;
	
?>