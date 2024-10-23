<?php

	include_once('../../config.php');
	include_once('../functions/db_functions.php');
	include_once('../functions/main_functions.php');
	
	session_start();
	//session_destroy();
	
	$action = GET('action','');
	
	if(!isset($_SESSION['ui']))
		{
			$_SESSION['ui'] = array('set'=>false,'state'=>array());
			$ui = $_SESSION['ui'];
			$ui_set = $ui['set'];
			$ui_state = $ui['state'];
		}
	else
		{
			$ui = $_SESSION['ui'];
			$ui_set = $ui['set'];
			$ui_state = $ui['state'];
		}
	
	
	// UI state variables
	
	$page = GET('page',1);
	$category = GET('category','');
	$order = GET('order','most_recent');
	
	if($action == 'save')
		{
			$ui_state['page'] = $page;
			$ui_state['category'] = $category;
			$ui_state['order'] = $order;
			
			$_SESSION['ui']['set'] = true;
			$_SESSION['ui']['state'] = $ui_state;
		}
	
		
	echo json_encode($_SESSION['ui']);

?>