<?php

	
	###  PAGE ACTIONS  ###
	
	switch($action)
		{
														
			case 'new_section' :
					// Define POST variables
					
					$section_name     = addslashes(POST('section_name',''));
					$default_page     = POST('default_page',0);
					$section_url      = addslashes(POST('encoded_url',''));
					
					$create_section_SQL = "INSERT INTO `sections` (`ID`,`Name`,`Default_Page`,`URL`,`Created`,`Created_By`) VALUES (NULL,'".$section_name."','".$default_page."','".$section_url."','".returnDate('yyyymmddhhmm')."','".USER."')";
					$create_section = db_insert($create_section_SQL);
					
					if($create_section['result'] == true)
						{
							$result = result('success',"<strong>'".POST('section_name','')."'</strong> created successfully.");
						}
					else
						{
							$result = result('fail',"<strong>'".POST('section_name','')."'</strong> could not be created. <em>".mysql_error()."</em>");
						}
					
					break;
														
			case 'edit_section' :
					// Define POST variables
					
					$section_ID       = POST('section_ID',NULL);
					$section_name     = addslashes(POST('section_name',''));
					$default_page     = POST('default_page',0);
					$section_url      = addslashes(POST('encoded_url',''));
										
					$edit_section_SQL = "UPDATE `sections` SET
																								`Name` = '".$section_name."',
																								`Default_Page` = '".$default_page."',
																								`URL` = '".$section_url."'
																						
																						WHERE `ID` = '".$section_ID."'";
																						
					#echo $edit_section_SQL;
					
					$edit_section = db_update($edit_section_SQL);
					
					if($edit_section == true)
						{
							$result = result('success',"Changes to <strong>'".POST('section_name','')."'</strong> saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to <strong>'".POST('section_name','')."'</strong> have been saved.");
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
														
		}
		



	$get_sections_SQL = "SELECT * FROM `sections` ORDER BY `ID` ASC";
	$get_sections = db_select($get_sections_SQL);
	$sections = $get_sections['result'];
	
	$get_pages_SQL = "SELECT * FROM `pages` WHERE `Trash` = 0";
	$get_pages = db_select($get_pages_SQL);
	$pages = $get_pages['result'];
	
	for($i=0; $i<count($sections); $i++)
		{
			$sections[$i]['Created'] = parse_date($sections[$i]['Created'],'yyyy-mm-dd h:mmS');
			$sections[$i]['viewURL'] = substr($sections[$i]['URL'],1);
			
			$get_page_SQL = "SELECT * FROM `pages` WHERE `ID` = '".$sections[$i]['Default_Page']."'";
			$get_page = db_select($get_page_SQL);
			$sections[$i]['Default_Page'] = ($get_page['num_rows'] > 0) ? $get_page['result'][0]['Name'] : '' ;
		}
		
	$num_sections = count($sections);
	$num_sections .= ' section'.plural($num_sections);
	
	$smarty->assign('sections',$sections);		
	$smarty->assign('num_sections',$num_sections);
	$smarty->assign('pages',$pages);	
	
	if(isset($result)) { $smarty->assign('result',$result);	}
		
	$page_template = 'sections.html' ;

?>