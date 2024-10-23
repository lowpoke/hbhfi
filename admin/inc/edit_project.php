<?php

	$get_project_SQL = "SELECT * FROM `projects` WHERE `project_id` = '".GET('ID',NULL)."'";
	$get_project = db_select($get_project_SQL);
	
	$project = array();
	
	if($get_project['num_rows'] > 0)
		{
			$project = $get_project['result'][0];
		}

	$smarty->assign('project',$project);
	
	
	// Get builders list
	
	$builders = array();
	$get_builders_SQL = "SELECT * FROM `builders` ORDER BY `builder_short_name` ASC";
	$get_builders = db_select($get_builders_SQL);
	
	if($get_builders['num_rows'] > 0)
		{
			$builders = $get_builders['result'];
		}
	$smarty->assign('builders',$builders);
	
			
	$page_template = 'edit_project.html' ;
	
?>