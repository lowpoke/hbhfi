<?php

			$page_template = 'news.html';
			$page_type = 'file';
			$show_article = false;
			$main_class = 'news_back';
			
			$get_categories_SQL = "SELECT * FROM `news_categories` ORDER BY `Name` ASC";
			$get_categories = db_select($get_categories_SQL);
			$categories = $get_categories['result'];			
			$smarty->assign('categories',$categories);
			
			$get_article = array('num_rows'=>0,'result'=>array());
			
			if(isset($_GET['article_url']))
				{
					$article_url = mysql_real_escape_string(GET('article_url',''));
			
					$get_article_SQL = "SELECT * FROM `news_articles` WHERE `URL` = '".$article_url."' LIMIT 1";
					$get_article = db_select($get_article_SQL);
				}
			
			if($get_article['num_rows'] > 0)
				{
					$show_article = true;
					$article = $get_article['result'][0];
					
					$article['Day'] = parse_mysql_date($article['Date_Time'],'day_str');
					$article['Month'] = parse_mysql_date($article['Date_Time'],'month_str');
					$article['Date'] = parse_mysql_date($article['Date_Time'],'day_suffix');
					$article['Year'] = parse_mysql_date($article['Date_Time'],'year');
					$article['Time'] = parse_mysql_date($article['Date_Time'],'h:mmS');					
					
					$smarty->assign('article',$article);
					
					$page_title = $article['Headline'].' | News ';
				}
			else
				{
					$page_title = 'Latest News ';
					$current_page = GET('page_num',1);
					$ppp = 5;
					$first_rec = ($current_page > 1) ? (($current_page - 1) * $ppp) : 0;
										
					$num_articles = 0;
					
					if(isset($_GET['category']))
						{
							$get_cat_SQL = "SELECT * FROM `news_categories` WHERE `Name` = '".$_GET['category']."' LIMIT 1";
							$get_cat = db_select($get_cat_SQL);
							
							if($get_cat['num_rows'] > 0)
								{
									$news_cat = $get_cat['result'][0];
									$show_cat = true;
									
									$smarty->assign('news_cat',$news_cat);
									
									$get_all_articles_SQL = "SELECT * FROM `news_articles` WHERE `Categories` LIKE '%".$news_cat['ID']."%' AND `Trash` = 0 ORDER BY `Date_Time` DESC";
									$get_all_articles = db_select($get_all_articles_SQL);
									
									$get_articles_SQL = "SELECT * FROM `news_articles` WHERE `Categories` LIKE '%".$news_cat['ID']."%' AND `Trash` = 0 ORDER BY `Date_Time` DESC LIMIT ".$first_rec.", ".$ppp;	
									$get_articles = db_select($get_articles_SQL);
									
									$num_articles = $get_all_articles['num_rows'];
								}
							else
								{
									$show_cat = false;
									
									$get_all_articles_SQL = "SELECT * FROM `news_articles` WHERE `Trash` = 0 ORDER BY `Date_Time` DESC";
									$get_all_articles = db_select($get_all_articles_SQL);
									
									$get_articles_SQL = "SELECT * FROM `news_articles` WHERE `Trash` = 0 ORDER BY `Date_Time` DESC LIMIT ".$first_rec.", ".$ppp;	
									$get_articles = db_select($get_articles_SQL);
								}
						}
					else
						{
							$show_cat = false;
						
							$get_all_articles_SQL = "SELECT * FROM `news_articles` WHERE `Trash` = 0 ORDER BY `Date_Time` DESC";
							$get_all_articles = db_select($get_all_articles_SQL);
							
							$get_articles_SQL = "SELECT * FROM `news_articles` WHERE `Trash` = 0 ORDER BY `Date_Time` DESC LIMIT ".$first_rec.", ".$ppp;	
							$get_articles = db_select($get_articles_SQL);
						}
						
					$smarty->assign('num_articles',$num_articles);
					$smarty->assign('num_articles_plural',plural($num_articles));
					$smarty->assign('show_cat',$show_cat);
					
					$num_pages = (intval($get_all_articles['num_rows'] / $ppp) + 1);
					
					if($get_articles['num_rows'] > 0)
						{
							$articles = $get_articles['result'];
							for($a=0; $a<$get_articles['num_rows']; $a++)
								{
									$articles[$a]['Day'] = parse_mysql_date($articles[$a]['Date_Time'],'day_str');
									$articles[$a]['Month'] = parse_mysql_date($articles[$a]['Date_Time'],'month_str');
									$articles[$a]['Date'] = parse_mysql_date($articles[$a]['Date_Time'],'day_suffix');
									$articles[$a]['Year'] = parse_mysql_date($articles[$a]['Date_Time'],'year');
									$articles[$a]['Time'] = parse_mysql_date($articles[$a]['Date_Time'],'h:mmS');	
								}
						}
					else
						{
							$articles = array();
						}
						
						
					if($num_pages > 1)
						{
							if($current_page == $num_pages)
								{
									$show_older = false;
								}
							else
								{
									$show_older = true;
									$older_page = $current_page + 1;
								}
								
																
							if($current_page > 1)
								{
									$show_newer = true;
									$newer_page = $current_page - 1;
								}
							else
								{
									$show_newer = false;
								}
						}
						
					if(isset($show_newer)) $smarty->assign('show_newer',$show_newer);
					if(isset($show_older)) $smarty->assign('show_older',$show_older);
					if(isset($older_page)) $smarty->assign('older_page',$older_page);
					if(isset($newer_page)) $smarty->assign('newer_page',$newer_page);						
						
					$smarty->assign('articles',$articles);
				}
				
			$get_latest_SQL = "SELECT * FROM `news_articles` WHERE `Trash` = 0 ORDER BY `Date_Time` DESC LIMIT 0,3";
			$get_latest = db_select($get_latest_SQL);
			$latest_news = ($get_latest['num_rows'] > 0) ? $get_latest['result'] : array();
			$smarty->assign('latest_news',$latest_news);
				
			$smarty->assign('show_article',$show_article);		
			
?>