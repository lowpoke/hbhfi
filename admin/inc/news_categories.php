<?php

	
	###  PAGE ACTIONS  ###
	
	switch($action)
		{
														
			case 'new_category' :
					// Define POST variables
					
					$category_name     = addslashes(POST('category_name',''));
					$create_category_SQL = "INSERT INTO `news_categories` (`ID`,`Name`,`Created`,`Created_By`) VALUES (NULL,'".$category_name."','".returnDate('yyyymmddhhmm')."','".USER."')";
					$create_category = db_insert($create_category_SQL);
					
					#echo $create_category_SQL;
					
					if($create_category['result'] == true)
						{
							$result = result('success',"<strong>'".$category_name."'</strong> created successfully.");
						}
					else
						{
							$result = result('fail',"<strong>'".$category_name."'</strong> could not be created. <em>".mysql_error()."</em>");
						}
					
					break;
														
			case 'edit_category' :
					// Define POST variables
					
					$category_ID       = POST('category_id','');
					$category_name     = addslashes(POST('category_name',''));
										
					$edit_category_SQL = "UPDATE `news_categories` SET
																								`Name` = '".$category_name."'
																						
																						WHERE `ID` = '".$category_ID."'";
																						
					#echo $edit_category_SQL;
					
					$edit_category = db_update($edit_category_SQL);
					
					if($edit_category == true)
						{
							$result = result('success',"Changes to <strong>'".$category_name."'</strong> saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to <strong>'".$category_name."'</strong> have been saved.");
						}
					
					break;
					
					
					case 'delete_category' :
					
					$category_ID       = GET('category_ID','');
					
					$get_category_SQL = "SELECT `Name` FROM `news_categories` WHERE `ID` = ".$category_ID." LIMIT 1" ;
					$get_category = db_select($get_category_SQL);
					
					$category_name = $get_category['result'][0]['Name'];
					
					
					$delete_category_SQL = "DELETE FROM `news_categories` WHERE `ID` = ".$category_ID ;
																						
					#echo $delete_category_SQL;
					
					$delete_category = db_delete($delete_category_SQL);
					
					if($delete_category == true)
						{
							$result = result('success',"<strong>'".$category_name."'</strong> deleted successfully.");
						}
					else
						{
							$result = result('warning',"<strong>'".$category_name."'</strong> could not be deleted.");
						}
					
					break;
														
		}
		



	$get_categories_SQL = "SELECT * FROM `news_categories` ORDER BY `Name` ASC";
	$get_categories = db_select($get_categories_SQL);
	$categories = $get_categories['result'];
	
	for($i=0; $i<count($categories); $i++)
		{
			$categories[$i]['Created'] = parse_date($categories[$i]['Created'],'yyyy-mm-dd h:mmS');
		}
		
	$num_categories = count($categories);
	$num_categories .= (plural($num_categories) == 's') ? ' categories' : ' category';
	
	$smarty->assign('categories',$categories);		
	$smarty->assign('num_categories',$num_categories);
	
	if(isset($result)) { $smarty->assign('result',$result);	}
		
	$page_template = 'news_categories.html' ;

?>