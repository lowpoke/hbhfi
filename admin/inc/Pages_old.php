
<?php

	
	switch($action)
		{
														
			case 'create_page' :
														// Define POST variables
														
														$section       = POST('section','');
														$page_name     = addslashes(POST('page_name',''));
														$page_title    = addslashes(POST('page_title',''));
														$page_url      = str_replace(' ','_',addslashes(POST('page_url','')));
														$section1_content  = addslashes(POST('section1_content',''));
														$in_menu       = POST('in_menu',0);
														$created       = date("U");
														
														// Clear relative dir location
														
														$page_content = str_replace($dir_to_clear,'',$page_content);
														
														$create_page_SQL = "INSERT INTO `pages` (`ID`,`Type`,`Section`,`Name`,`Title`,`URL`,`Content1`,`Created`) VALUES (NULL,'Standard','".$section."','".$page_name."','".$page_title."','".$page_url."','".$section1_content."','".$created."')";
														$create_page = db_insert($create_page_SQL);
														
														if($create_page['result'] == true)
															{
																$result = result('success',"<strong>'".POST('page_name','')."'</strong> created successfully.");
															}
														else
															{
																$result = result('fail',"<strong>'".POST('page_name','')."'</strong> could not be created.");
															}
															
														if($in_menu = 1)
															{
																$menu_id = get_section_id($section);
																$create_item_SQL = "INSERT INTO `menu_items` VALUES ('','1','".$page_name."','2','".$menu_id."','".$section."','Internal','/".$page_url."','Same Window','".(max_item_order($menu_id) + 1)."','".date("U")."')";
																$create_item = db_insert($create_item_SQL);
																
																#echo $create_item_SQL;
															}
														
														break;
														
			case 'edit_page' :
														// Define POST variables
														
														$page_ID       = POST('page_ID',NULL);
														$page_name     = addslashes(POST('page_name',''));
														$page_title    = addslashes(POST('page_title',''));
														$page_url      = addslashes(POST('page_url',''));
														$section       = POST('section','');
														$section1_content  = addslashes(POST('section1_content',''));
														$header_image      = addslashes(POST('header_image',''));
														
														// Clear relative dir location
														
														$page_content = str_replace($dir_to_clear,'',$page_content);
														
														$edit_page_SQL = "UPDATE `pages` SET
																																	`Name` = '".$page_name."',
																																	`Section` = '".$section."',
																																	`Title` = '".$page_title."',
																																	`URL` = '".$page_url."',
																																	`Content1` = '".$section1_content."'
																															
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
														
		}
		
	if(isset($result))
		{
			echo $result;
		}

?>
						
						<h1>Pages</h1>
						
						<div class="admin_buttons">
							<div class="button"><a href="Content/Create Page" class="new_page">New Page</a></div>
						</div>
						
						<p>
							<strong>Sort:</strong> &nbsp;
							<a href="Content/Pages/ASC" title="Sort Ascending"><img src="../images/admin/sort_incr.png" alt="" /></a>
							<a href="Content/Pages/DESC" title="Sort Descending"><img src="../images/admin/sort_decrease.png" alt="" /></a>	
							<a href="Content/Pages/Created" title="Sort Created"><img src="../images/admin/unsortedList.png" alt="" /></a>						
						</p>

<?php
	
	$sort = GET('sort','Created');
	$sort = ($sort == 'Created') ? " `ID` DESC" : " `Name` ".$sort ;
	
?>						
						
						<div id="pages">
							<ul>
							
								<li style="background-color: #333333; color: #FFFFFF; margin-bottom: 10px;">
									<div class="page_name">Page Name</div>
									<div class="page_title"><strong>Page Title</strong></div>
									<div class="page_options" style="text-align: right;">
											<strong>Tasks</strong> &nbsp;
									</div>
								</li>

<?php

					
			$get_pages_SQL = "SELECT * FROM `pages` WHERE `Type` = 'Standard'";
			$get_pages = db_select($get_pages_SQL);
					
			if($get_pages['num_rows'] > 0)
				{


					for($pages = 0; $pages < $get_pages['num_rows']; $pages++)
						{
							$page = $get_pages['result'][$pages];

?>
										<li>
											<div class="page_name"><?php echo $page['Name']; ?></div>
											<div class="page_title"><?php echo (strlen($page['Title']) > 50) ? substr($page['Title'],0,45).' <em>...</em>' : $page['Title'] ; ?>&nbsp;</div>
											<div class="page_options">
												<div class="mini_button"><a href="../<?php echo $page['URL']; ?>" class="info" rel="moodalbox 600 450" title="<?php echo $page['Name']; ?> - <?php echo $page['Title']; ?> Created <?php echo returnDateFromUNIX('D, M Ds Y h:mmS',$page['Created']); ?>"></a></div>
												<div class="mini_button"><a href="Content/Delete Page/<?php echo $page['ID']; ?>" class="delete" title="Delete <?php echo $page['Name']; ?>"></a></div>
												<div class="mini_button"><a href="Content/Edit Page/<?php echo $page['ID']; ?>" class="edit" title="Edit <?php echo $page['Name']; ?>"></a></div>
											</div>
										</li>
<?php

						}

				
?>
							</ul>
						</div>
<?php

		}
	else
		{

?>
						<p>No pages currently in database.</p>
<?php

		}

?>