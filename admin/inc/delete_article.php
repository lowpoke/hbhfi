<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['article_ID']))
		{
			$article_ID = $_GET['article_ID'];
			
			$get_article_SQL = "SELECT * FROM `news_articles` WHERE `ID` = ".$article_ID." LIMIT 1";
			$get_article = db_select($get_article_SQL);			
			$article = $get_article['result'][0];			
			$mochaCMS->assign('article',$article);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}

	$mochaCMS->display('delete_article.html');

?>