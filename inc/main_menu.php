						<ul id="main_menu">
<?php

	//include_once('../config.php');
	//include_once('../functions/db_functions.php');
	
	$get_menu_SQL = "SELECT * FROM `menus` WHERE `ID` = '1'";
	$get_menu = db_select($get_menu_SQL);
	
	if($get_menu['num_rows'] > 0)
		{
			$menu = $get_menu['result'][0];
			
			// Get items
			
			$get_items_SQL = "SELECT * FROM `menu_items` WHERE `Menu` = '".$menu['ID']."' AND `Level` = '1' ORDER BY `Order` ASC";
			$get_items = db_select($get_items_SQL);

			for($items=0; $items < $get_items['num_rows']; $items++)
				{
					$menu_item = $get_items['result'][$items];
					
					$show_item = true;
					
					$link_url = link_url($menu_item['Link Type'],$menu_item['Destination']);
					
					echo $menu_item['Destination'];
					
					if(is_int($menu_item['Destination']))
						{
							$page_security = get_page_security($menu_item['Destination']);
							
							if($page_security['result'] == true)
								{
									if($page_security['secure'] == 1)
										{
											if($user_authenticated == true)
												{
													if($user_privilege < $page_security['security_level'])
														{
															$show_item = false;
														}
												}
											else
												{
													$show_item = false;
												}
										}
								}
						}
						
					echo ($show_item == true) ? 'true' : 'false' ;
					
					$link_class = 'class="';
					$link_class .= ($menu_item['Link Target'] == '2') ? 'external ' : '' ;
					$link_class .= (($m + 1) == count($menu_items)) ? 'last ' : '' ;
					$link_class .= '"';
					
					
					$get_sub_items_SQL = "SELECT * FROM `menu_items` WHERE `Menu` = '".$menu['ID']."' AND `Parent` = '".$menu_item['ID']."' ORDER BY `Order` ASC";
					$get_sub_items = db_select($get_sub_items_SQL);
					
					
					if($show_item == true)
						{
					
							if($get_sub_items['num_rows'] == 0)
								{
?>
							<li><a href="<?php echo ($menu_item['Link Target'] == 'New Window') ? ($page == 'Home') ? '' : $page : $destination; ?>"<?php if($menu_item['Link Target'] == 'New Window') { ?> onclick="window.open('http://<?php echo $menu_item['Destination']; ?>','<?php echo $menu_item['Name']; ?>','')"<?php } ?><?php if($destination == $page) { ?> class="selected"<?php } ?>><?php echo stripslashes($menu_item['Name']); ?></a></li>
<?php
								}
							else
								{
?>
							<li>
								
								<a href="<?php echo ($menu_item['Link Target'] == 'New Window') ? ($page == 'Home') ? '' : $page : $destination; ?>"<?php if($menu_item['Link Target'] == 'New Window') { ?> onclick="window.open('http://<?php echo $menu_item['Destination']; ?>','<?php echo $menu_item['Name']; ?>','')"<?php } ?><?php if($destination == $page) { ?> class="selected"<?php } ?>><?php echo stripslashes($menu_item['Name']); ?></a>
								
								<ul>

<?php
													for($sub = 0; $sub < $get_sub_items['num_rows']; $sub++)
														{
															$sub_menu_item = $get_sub_items['result'][$sub];
		
															$sub_link_url = link_url($sub_menu_item['Link Type'],$sub_menu_item['Destination']);
															$sub_link_class = 'class="';
															$sub_link_class .= ($menu_item['Link Target'] == '2') ? 'external ' : '' ;
															$sub_link_class .= (($m + 1) == count($menu_items)) ? 'last ' : '' ;
															$sub_link_class .= '"';
		
?>
									<li><a href="<?php echo $sub_link_url; ?>" <?php echo $sub_link_class; ?>><?php echo stripslashes($sub_menu_item['Name']); ?></a></li>
<?php
														}
?>

								</ul>
							
							</li>
<?php
								}
						}
				}
		}
?>
						</ul>		
						

