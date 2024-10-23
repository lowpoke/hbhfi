<?php

	
	###  PAGE ACTIONS  ###
	
	switch($action)
		{
														
			case 'new_page' :
					// Define POST variables
					
					$page_name     = addslashes(POST('page_name',''));
					$page_title    = addslashes(POST('page_title',''));
					$page_url      = addslashes(POST('encoded_url',''));
					$page_section  = POST('page_section','');
					$page_content  = addslashes(POST('page_content',''));
					
					$get_max_order_SQL = "SELECT MAX(`Order`) FROM `pages`";
					$get_max_order = db_select($get_max_order_SQL);
					$max_order = ($get_max_order['num_rows'] > 0) ? intval($get_max_order['result'][0]['MAX(`Order`)']) : 0 ;
					
					$max_order = (intval($max_order) > 0) ? intval($max_order + 1) : 0 ;
					
					$create_page_SQL = "INSERT INTO `pages` (`ID`,`Name`,`Section`,`Title`,`URL`,`Content`,`Order`,`Created`,`Created_By`) VALUES (NULL,'".$page_name."','".$page_section."','".$page_title."','".$page_url."','".$page_content."',".$max_order.",'".returnDate('yyyymmddhhmm')."','".USER."')";
					
					#echo $create_page_SQL;
					
					$create_page = db_insert($create_page_SQL);
					
					if($create_page['result'] == true)
						{
							$result = result('success',"<strong>'".POST('page_name','')."'</strong> created successfully.");
						}
					else
						{
							$result = result('fail',"<strong>'".POST('page_name','')."'</strong> could not be created. <em>".mysql_error()."</em>");
						}
					
					break;
														
			case 'edit_page' :
					// Define POST variables
					
					$page_ID       = POST('page_ID',NULL);
					$page_name     = addslashes(POST('page_name',''));
					$page_title    = addslashes(POST('page_title',''));
					$page_url      = addslashes(POST('encoded_url',''));
					$page_section  = POST('page_section','');
					$page_content  = addslashes(POST('page_content',''));
										
					$edit_page_SQL = "UPDATE `pages` SET
																								`Name` = '".$page_name."',
																								`Section` = '".$page_section."',
																								`Title` = '".$page_title."',
																								`URL` = '".$page_url."',
																								`Content` = '".$page_content."'
																						
																						WHERE `ID` = '".$page_ID."'";
																						
					#echo $edit_page_SQL;
					
					$edit_page = db_update($edit_page_SQL);
					
					if($edit_page == true)
						{
							$result = result('success',"Changes to <strong>'".POST('page_name','')."'</strong> saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to <strong>'".POST('page_name','')."'</strong> have been saved.");
						}
					
					break;
					
					
					case 'delete_page' :
					// Define POST variables
					
					$page_ID       = GET('ID',NULL);
					
					$get_page_SQL = "SELECT `Name` FROM `pages` WHERE `ID` = ".$page_ID ;
					$get_page = db_select($get_page_SQL);
					
					$page_name = $get_page['result'][0]['Name'];
					
					
					$delete_page_SQL = "UPDATE `pages` SET `Trash` = 1 WHERE `ID` = ".$page_ID ;
																						
					#echo $delete_page_SQL;
					
					$delete_page = db_update($delete_page_SQL);
					
					if($delete_page == true)
						{
							$result = result('success',"<strong>'".$page_name."'</strong> deleted successfully.  <a href=\"content/pages\" class=\"close\">Close</a>");
						}
					else
						{
							$result = result('warning',"<strong>'".$page_name."'</strong> could not be deleted.  <a href=\"content/pages\" class=\"close\">Close</a>");
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
	
	
	
	
	
	
	
	$get_trash_SQL = "SELECT * FROM `pages` WHERE `Trash` = 1";
	$get_trash = db_select($get_trash_SQL);
	
	$trash = $get_trash['num_rows'];
	
	
	
	
	
	
	
	
	$get_pages_SQL = "SELECT * FROM `pages` WHERE `Trash` = 0 ORDER BY `Order` ASC";
	$get_pages = db_select($get_pages_SQL);
	
	$pages = $get_pages['result'];
	
	for($i=0; $i<count($pages); $i++)
		{
			$pages[$i]['Created'] = parse_date($pages[$i]['Created'],'yyyy-mm-dd h:mmS');
			$pages[$i]['viewURL'] = substr($pages[$i]['URL'],1);
			
			$get_section_SQL = "SELECT * FROM `sections` WHERE `ID` = '".$pages[$i]['Section']."'";
			$get_section = db_select($get_section_SQL);
			$pages[$i]['Section'] = ($get_section['num_rows'] > 0) ? $get_section['result'][0]['Name'] : '' ;
		}
		
	$num_pages = count($pages);
	$num_pages .= ' page'.plural($num_pages);
	
	$smarty->assign('pages',$pages);		
	$smarty->assign('num_pages',$num_pages);
	
	if(isset($result)) { $smarty->assign('result',$result);	}
	$smarty->assign('trash',$trash);	
		
	$page_template = 'pages.html' ;

?>