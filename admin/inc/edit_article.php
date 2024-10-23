<?php

	$get_article_SQL = "SELECT * FROM `news_articles` WHERE `ID` = '".GET('ID',NULL)."'";
	$get_article = db_select($get_article_SQL);
	
	$article = array();
	
	if($get_article['num_rows'] > 0)
		{
			$article = $get_article['result'][0];

			$oFCKeditor = new FCKeditor('article_content') ;
			$oFCKeditor->BasePath	= ROOT.'admin/fckeditor/' ;
			$oFCKeditor->Width = 945;
			$oFCKeditor->Height = 650;
			$oFCKeditor->ToolbarSet = 'Basic';
			$oFCKeditor->Value = stripslashes($article['Content']) ;
			$fck = $oFCKeditor->CreateHtml() ;
			
			$smarty->assign('fck',$fck);			
		}

	$article['Categories'] = explode(',',$article['Categories']);

	$smarty->assign('article',$article);
	
	$get_categories_SQL = "SELECT * FROM `news_categories` ORDER BY `Name` ASC";
	$get_categories = db_select($get_categories_SQL);
	$categories = $get_categories['result'];
	$smarty->assign('categories',$categories);	
	
	$smarty->assign('sample_date',returnDate('mysql'));	
		
	$page_template = 'edit_article.html' ;
	
?>