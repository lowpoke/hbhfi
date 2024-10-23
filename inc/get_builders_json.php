<?php

	include_once('../../config.php');
	include_once('../functions/db_functions.php');
	include_once('../functions/main_functions.php');
	
	$where = '';
	$sql_limit = '';
	
	// Incoming variables
	
	$scope = GET('scope','active');
	$limit = GET('limit','');
	$order = GET('order','');
	
	/*
switch($scope) :
	
		case 'active' :
			$where = "WHERE (SELECT COUNT(`project_id`) WHERE `project_builder` = 'builder_id') > 0";
		break;
	
	endswitch;
	
	if(strlen(trim($category)) > 0)
		{
			$where = "WHERE project_categories.category_slug = '".$category."'";
		}
*/
		
	if(strlen(trim($limit)) > 0)
		{
			$limit = explode(':',$limit);			
			$sql_limit = "LIMIT ".$limit[0].", ".$limit[1] ;
		}
	
	
	
	$get_builders_SQL = "
	
		SELECT 
			builders.builder_id,
			builders.builder_short_name,
			(SELECT COUNT(projects.project_id) FROM projects WHERE projects.project_builder = builders.builder_id AND projects.project_live = 1) AS num_projects
		FROM `builders` 
		
		JOIN projects ON projects.project_builder = builders.builder_id AND projects.project_live = 1
				
		GROUP BY builders.builder_id
		
		".$sql_limit."
		
		ORDER BY builders.builder_short_name ASC
		
";

	$get_builders = db_select($get_builders_SQL);
	
	$builders = array();
	$builders['builders'] = $get_builders['result'];
	
	echo json_encode($builders);

?>