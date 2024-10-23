<?php

	switch($action)
		{
	
			case 'new_menu_item' :
			
				$item_ID = POST('item_ID','');
				
				$link_menu = POST('link_menu','');
				$link_level = POST('link_level','');
				$link_name = addslashes(POST('link_name',''));
				$link_type = POST('link_type','Internal');
				$link_dest_int = POST('link_dest_int',0);
				$link_dest_ext = addslashes(POST('link_dest_ext',''));
				$link_parent = POST('link_parent',0);				
				$link_target = POST('link_target',1);
				
				$link_dest = ($link_type == 'Internal') ? $link_dest_int : $link_dest_ext ;
				
				$created = returnDate('yyyymmddhhmm');
				$created_by = USER;
				
				$new_item_SQL = "INSERT INTO `menu_items` 
				
					(`ID`,
					`Menu`,
					`Name`,
					`Level`,
					`Parent`,
					`Link Type`,
					`Link Target`,
					`Destination`,
					`Created`,
					`Created_By`)
					
					VALUES
					
					(NULL,
					".$link_menu.",
					'".$link_name."',
					".$link_level.",
					".$link_parent.",
					'".$link_type."',
					".$link_target.",
					'".$link_dest."',
					'".$created."',
					'".$created_by."')" ;
				
				//echo $new_item_SQL;
				$new_item = db_update($new_item_SQL);
				
				if($new_item)
					{ $result = result('success', 'New menu item "<strong>'.$link_name.'</strong>" saved.'); }
				else
					{ $result = result('warning', 'New menu item "<strong>'.$link_name.'</strong>" could not be saved.'); }
			
			break;
			
			
			case 'edit_menu_item' :
			
				$item_ID = POST('item_ID','');
				
				$link_name = addslashes(POST('link_name',''));
				$link_type = POST('link_type','Internal');
				$link_dest_int = POST('link_dest_int',0);
				$link_dest_ext = addslashes(POST('link_dest_ext',''));
				$link_parent = POST('link_parent',0);				
				$link_target = POST('link_target',1);
				
				$link_dest = ($link_type == 'Internal') ? $link_dest_int : $link_dest_ext ;
				
				$update_item_SQL = "UPDATE `menu_items` SET `Name` = '".$link_name."', `Link Type` = '".$link_type."', `Destination` = '".$link_dest."', `Parent` = ".$link_parent.", `Link Target` = ".$link_target." WHERE `ID` = ".$item_ID ;
				$update_item = db_update($update_item_SQL);
				
				if($update_item)
					{ $result = result('success', 'Changes to "<strong>'.$link_name.'</strong>" saved.'); }
				else
					{ $result = result('warning', 'No changes made to "<strong>'.$link_name.'</strong>".'); }
				
				//echo $update_item_SQL;
			
			break;
			
			case 'delete' :

				$item_ID = GET('item_ID',0);
				$item = menu_item($item_ID);
				
				$delete_item_SQL = "DELETE FROM `menu_items` WHERE `ID` = ".$item_ID ;
				//echo $delete_item_SQL;
				$delete_item = db_delete($delete_item_SQL);
				
				if($delete_item)
					{ $result = result('success', 'Menu item "<strong>'.$item['Name'].'</strong>" deleted.'); }
				else
					{ $result = result('fail', 'Menu item "<strong>'.$item['Name'].'</strong>" could not be deleted.'); }

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
											$items[$cnt]['Level'] = $item[1];
											$items[$cnt]['Parent'] = $item[2];
											$items[$cnt]['Order'] = $item[3];
											$cnt++;
										}
								}
								
							if(count($items) > 	0)
								{
									$success = 0;
									$menu_id = GET('menu_id','');
									foreach($items as $item)
										{
											$save_item_SQL = "UPDATE `menu_items` SET `Level` = ".$item['Level'].", `Parent` = ".$item['Parent'].", `Order` = ".$item['Order']." WHERE `ID` = ".$item['ID'] ;
											//echo $save_item_SQL.'<br />';
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
	
	if(isset($result)) { $smarty->assign('result',$result);	}
	
	
	$get_menus_SQL = "SELECT * FROM `menus` ORDER BY `Name`";
	$get_menus = db_select($get_menus_SQL);
	$menus = $get_menus['result'];
	
	// Define menu variables
	
	$show_items = true;
	$cur_menu = array();
	$menu_items = array();
	$num_items = 0;
	
	if(isset($_GET['menu_id']))
		{
			$show_items = true;
			$menu_id = GET('menu_id','');
			
			$get_menu_SQL = "SELECT * FROM `menus` WHERE `ID` = ".$menu_id." LIMIT 1";
			$get_menu = db_select($get_menu_SQL);
			$cur_menu = $get_menu['result'][0];
			
			//  Menu items for current menu
	
			$get_items_SQL = "SELECT * FROM `menu_items` WHERE `menu` = ".$menu_id." AND `Level` = 1 ORDER BY `Order` ASC";
			$get_items = db_select($get_items_SQL);
			$num_items = $get_items['num_rows'];
			
			//  Get sub-menu items for each main item
			
			for($i=0; $i<$num_items; $i++)
				{
					$main_item = $get_items['result'][$i];
					$main_item['Created'] = parse_date($main_item['Created'],'yyyy-mm-dd h:mmS');
					if($main_item['Link Type'] == 'Internal')
						{
							$main_item['Destination'] = get_page($main_item['Destination']);
							$main_item['Destination'] = ($main_item['Destination']['result']) ? $main_item['Destination']['data']['URL'] : '';
						}
					
					$menu_items[$main_item['ID']]['item'] = $main_item;
					$get_sub_items_SQL = "SELECT * FROM `menu_items` WHERE `menu` = ".$menu_id." AND `Level` = 2 AND `Parent` = ".$main_item['ID']." ORDER BY `Order` ASC";
					$get_sub_items = db_select($get_sub_items_SQL);
					
					$menu_items[$main_item['ID']]['num_sub'] = $get_sub_items['num_rows'];
					
					if($get_sub_items['num_rows'] > 0)
						{
							$sub_items = $get_sub_items['result'];
							for($s=0; $s<$get_sub_items['num_rows']; $s++)
								{
									$sub_items[$s]['Created'] = parse_date($sub_items[$s]['Created'],'yyyy-mm-dd h:mmS');
									$sub_items[$s]['Destination'] = get_page($sub_items[$s]['Destination']);
									$sub_items[$s]['Destination'] = ($sub_items[$s]['Destination']['result']) ? $sub_items[$s]['Destination']['data']['URL'] : '';
									$menu_items[$main_item['ID']]['sub_items'] = $sub_items;
								}
						}
				}
		}
	else
		{
			$show_items = false;
		}
		
	// Assign smarty vars
	
	$smarty->assign('menus',$menus);
	$smarty->assign('cur_menu',$cur_menu);
	$smarty->assign('menu_items',$menu_items);
	$smarty->assign('num_items',$num_items);
	$smarty->assign('show_items',$show_items);
	
		
	$page_template = 'menu_editor.html' ;
	
?>