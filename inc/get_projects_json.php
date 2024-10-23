<?php

	include_once('../../config.php');
	include_once('../functions/db_functions.php');
	include_once('../functions/main_functions.php');
	
	$where = '';
	$sql_limit = '';
	
	// Incoming variables
	
	$category = GET('category','');
	$limit = GET('limit','');
	$order = GET('order','');
	
	if(strlen(trim($category)) > 0)
		{
			$where = "WHERE project_categories.category_slug = '".$category."'";
		}
		
	if(strlen(trim($limit)) > 0)
		{
			$limit = explode(':',$limit);
			
			$sql_limit = "LIMIT ".$limit[0].", ".$limit[1] ;
		
			$where = "WHERE project_categories.category_slug = '".$category."'";
		}
	
	
	
	$get_projects_SQL = "
select
projects.project_id,
projects.project_item,
projects.project_type,
projects.project_posted,
projects.project_thumbnail,
builders.builder_short_name,
project_categories.category_name,
project_categories.category_slug,
project_images.image_filename as thumbnail
from projects
join builders on projects.project_builder = builders.builder_id
join project_categories on projects.project_category = project_categories.category_id
left join project_images on projects.project_thumbnail = project_images.image_id
".$where."
".$sql_limit."
";

	$get_projects = db_select($get_projects_SQL);
	
	$projects = $get_projects['result'];
	
	echo json_encode($projects);

?>