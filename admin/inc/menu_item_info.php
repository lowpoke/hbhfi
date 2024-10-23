<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['item_ID']))
		{
			$item_ID = $_GET['item_ID'];
			
			$item = menu_item($item_ID);
			$item['Created'] = parse_date($item['Created'],'yyyy-mm-dd h:mmS');
			
			$show_destination = true;
			if($item['Link Type'] == 'Internal')
				{
					$dest_page = get_page($item['Destination']);
					if($dest_page['result'])
						{
							$item['Destination'] = '<abbr title="'.ROOT.substr($dest_page['data']['URL'],1).'">'.$dest_page['data']['URL'].'</abbr>';
						}
					else
						{
							$item['Destination'] = '' ;
							$show_destination = false;
						}
				}
				
			$item['Parent'] = menu_item($item['Parent']);
			if($item['Parent'])
				{
					$show_parent = true;			
					$item['Parent'] = $item['Parent']['Name'];
				}
			else
				{
					$show_parent = false;		
				}
				
			$item['Type'] = $item['Link Type'];
			
			$mochaCMS->assign('item',$item);
			$mochaCMS->assign('show_parent',$show_parent);		
			$mochaCMS->assign('show_destination',$show_destination);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
		
	if(isset($mod_path)) { $mochaCMS->assign('show_info',$show_info); }
	$mochaCMS->assign('ROOT',ROOT);
	
	$mochaCMS->display('menu_item_info.html');

?>