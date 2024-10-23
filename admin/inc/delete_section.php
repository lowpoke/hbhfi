<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	if(isset($_GET['section_ID']))
		{
			$section_ID = $_GET['section_ID'];
			
			$get_section_SQL = "SELECT * FROM `sections` WHERE `ID` = ".$section_ID." LIMIT 1";
			$get_section = db_select($get_section_SQL);
			
			$section = $get_section['result'][0];
			$section['Created'] = parse_date($section['Created'],'yyyy-mm-dd h:mmS');
			$section['Short_URL'] = substr($section['URL'],1);
			
			$mochaCMS->assign('section',$section);			
			
			$show_info = true;
		}
	else
		{
			$show_info = false;
		}
	
	$mochaCMS->display('delete_section.html');

?>