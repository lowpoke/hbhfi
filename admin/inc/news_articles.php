<?php

	
	###  PAGE ACTIONS  ###
	
	switch($action)
		{
														
			case 'new_article' :
					// Define POST variables
					
					$headline     = addslashes(POST('headline',''));
					$date_time    = addslashes(POST('date_time',returnDate('yyyymmddhhmm')));
					$summary      = addslashes(POST('summary',''));
					$article_url  = addslashes(POST('encoded_url',''));
					$categories   = POST('categories',array());
					$article_content  = addslashes(POST('article_content',''));
					
					$categories_str = '';
					
					foreach($categories as $category)
						{
							$categories_str .= $category.',' ;
						}
						
					$categories_str = substr($categories_str,0,-1);
					
					$create_article_SQL = "INSERT INTO `news_articles` (`ID`,`Date_Time`,`Categories`,`Headline`,`URL`,`Summary`,`Content`,`Created`,`Created_By`) VALUES (NULL,'".$date_time."','".$categories_str."','".$headline."','".$article_url."','".$summary."','".$article_content."','".returnDate('yyyymmddhhmm')."','".USER."')";
					
					#echo $create_article_SQL;
					
					$create_article = db_insert($create_article_SQL);
					
					if($create_article['result'] == true)
						{
							$result = result('success',"<strong>'".$headline."'</strong> created successfully.");
						}
					else
						{
							$result = result('fail',"<strong>'".$headline."'</strong> could not be created. <em>".mysql_error()."</em>");
						}
					
					break;
														
			case 'edit_article' :
					// Define POST variables
					
					$article_ID   = POST('article_ID',0);
					
					$headline     = addslashes(POST('headline',''));
					$date_time    = addslashes(POST('date_time',''));
					$summary      = addslashes(POST('summary',''));
					$article_url  = addslashes(POST('encoded_url',''));
					$categories   = POST('categories',array());
					$article_content  = addslashes(POST('article_content',''));
					
					$categories_str = '';
					
					foreach($categories as $category)
						{
							$categories_str .= $category.',' ;
						}
						
					$categories_str = substr($categories_str,0,-1);
										
					$edit_article_SQL = "UPDATE `news_articles` SET
																								`Headline` = '".$headline."',
																								`Date_Time` = '".$date_time."',
																								`Categories` = '".$categories_str."',
																								`URL` = '".$article_url."',
																								`Summary` = '".$summary."',
																								`Content` = '".$article_content."'
																						
																						WHERE `ID` = '".$article_ID."'";
																						
					//echo $edit_article_SQL;
					
					$edit_article = db_update($edit_article_SQL);
					
					if($edit_article == true)
						{
							$result = result('success',"Changes to <strong>'".POST('headline','')."'</strong> saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to <strong>'".POST('headline','')."'</strong> have been saved.");
						}
					
					break;
					
					
					case 'delete_article' :
					// Define POST variables
					
					$article_ID       = GET('ID',NULL);
					
					$get_article_SQL = "SELECT `Headline` FROM `news_articles` WHERE `ID` = ".$article_ID ;
					$get_article = db_select($get_article_SQL);
					
					$article_name = $get_article['result'][0]['Headline'];
					
					
					$delete_article_SQL = "UPDATE `news_articles` SET `Trash` = 1 WHERE `ID` = ".$article_ID ;
																						
					#echo $delete_article_SQL;
					
					$delete_article = db_update($delete_article_SQL);
					
					if($delete_article == true)
						{
							$result = result('success',"<strong>'".$article_name."'</strong> deleted successfully.");
						}
					else
						{
							$result = result('warning',"<strong>'".$article_name."'</strong> could not be deleted.");
						}
					
					break;
					
					
					case 'save_order' :
					// Define POST variables
					
					$new_order = POST('new_order','');
					$items = array();

					if(strlen(trim($new_order)) > 0)
						{
							$new_order = substr($new_order,0,-1);
							$new_order = explode(',',$new_order);
							
							if(count($new_order) > 0)
								{
									$cnt = 0;
									foreach($new_order as $item)
										{
											$item = explode(':',$item);
											$items[$cnt]['ID'] = $item[0];
											$items[$cnt]['order'] = $item[1];
											$cnt++;
										}
								}
								
							if(count($items) > 	0)
								{
									$success = 0;
									foreach($items as $item)
										{
											$save_item_SQL = "UPDATE `pages` SET `Order` = ".$item['order']." WHERE `ID` = ".$item['ID'] ;
											$save_item = db_update($save_item_SQL);
											
											if($save_item) $success++;
										}
										
									$result = result('success','<strong>'.$success.'</strong> item'.plural($success).' re-ordered successfully.');
								}
						
						}
					else
						{
							$result = result('warning','<strong>No items re-ordered.</strong>');
						}
					
					break;
														
		}
	
	$get_articles_SQL = "SELECT * FROM `news_articles` WHERE `Trash` = 0 ORDER BY `Date_Time` DESC";
	$get_articles = db_select($get_articles_SQL);
	
	$articles = $get_articles['result'];
	
	for($i=0; $i<count($articles); $i++)
		{
			$articles[$i]['Date_Time'] = parse_mysql_date($articles[$i]['Date_Time'],'yyyy-mm-dd h:mmS');
			$articles[$i]['Created'] = parse_date($articles[$i]['Created'],'yyyy-mm-dd h:mmS');
			$articles[$i]['Headline'] = (strlen($articles[$i]['Headline']) > 35) ? substr($articles[$i]['Headline'],0,35).'...' : $articles[$i]['Headline'];
			$articles[$i]['URL'] = (strlen($articles[$i]['URL']) > 35) ? substr($articles[$i]['URL'],0,35).'...' : $articles[$i]['URL'];
		}
		
	$num_articles = count($articles);
	$num_articles .= ' article'.plural($num_articles);
	
	$smarty->assign('articles',$articles);		
	$smarty->assign('num_articles',$num_articles);
	
	$smarty->assign('result',$result);

	$page_template = 'news_articles.html' ;

?>