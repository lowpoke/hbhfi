<?php

	
	###  PAGE ACTIONS  ###
	
	switch($action)
		{
														
													
			case 'edit_project' :
					// Define POST variables
					
					$project_id           = POST('project_id',NULL);
					$project_name         = addslashes(POST('project_name',''));
					$project_item         = addslashes(POST('project_item',''));
					$project_type         = addslashes(POST('project_type',''));
					$project_description  = addslashes(POST('project_description',''));
					$project_category     = addslashes(POST('project_category',''));
					$project_builder      = addslashes(POST('project_builder',''));
										
					$edit_project_SQL = "UPDATE `projects` SET
																								`project_category` = '".$project_category."',
																								`project_item` = '".$project_item."',
																								`project_name` = '".$project_name."',
																								`project_type` = '".$project_type."',
																								`project_description` = '".$project_description."',
																								`project_builder` = '".$project_builder."'
																						
																						WHERE `project_id` = '".$project_id."'";
																						
					//echo $edit_project_SQL; exit;
					
					$edit_project = db_update($edit_project_SQL);
					
					if($edit_project == true)
						{
							$result = result('success',"Changes to <strong>'".POST('project_name','')."'</strong> saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to <strong>'".POST('project_name','')."'</strong> have been saved.");
						}
					
					break;
					
					
					case 'delete_project' :
					// Define POST variables
					
					$project_ID       = GET('ID',NULL);
					
					$get_project_SQL = "SELECT `project_name` FROM `projects` WHERE `project_id` = ".$project_ID ;
					$get_project = db_select($get_project_SQL);
					
					$project_name = $get_project['result'][0]['project_name'];
										
					$delete_project_SQL = "UPDATE `projects` SET `project_live` = 0 WHERE `project_id` = ".$project_ID ;					
					$delete_project = db_update($delete_project_SQL);
					
					if($delete_project == true)
						{
							$result = result('success',"<strong>'".$project_name."'</strong> deleted successfully.");
						}
					else
						{
							$result = result('warning',"<strong>'".$project_name."'</strong> could not be deleted.");
						}
					
					break;
					
					
																			
		}
	

	// Builders list
	
	$get_builder_list_SQL = "SELECT projects.project_id, builders.builder_id, builders.builder_short_name as project_builder FROM projects INNER JOIN builders on projects.project_builder = builders.builder_id GROUP BY projects.project_builder ORDER BY project_builder ASC";
	$get_builder_list = db_select($get_builder_list_SQL);	
	$builder_list = ($get_builder_list['num_rows'] > 0) ? $get_builder_list['result'] : array() ;
	$smarty->assign('builder_list',$builder_list);		
	
	// Country list
	
	$get_country_list_SQL = "SELECT projects.project_id, builders.builder_id, builders.builder_country as country FROM projects INNER JOIN builders on projects.project_builder = builders.builder_id GROUP BY builders.builder_country ORDER BY builders.builder_country ASC";
	$get_country_list = db_select($get_country_list_SQL);	
	$country_list = ($get_country_list['num_rows'] > 0) ? $get_country_list['result'] : array() ;
	$smarty->assign('country_list',$country_list);		
	
	// Category list
	
	$get_category_list_SQL = "SELECT projects.project_id, project_categories.category_id, project_categories.category_name FROM projects INNER JOIN project_categories on projects.project_category = project_categories.category_id GROUP BY projects.project_category ORDER BY project_categories.category_name ASC";
	$get_category_list = db_select($get_category_list_SQL);	
	$category_list = ($get_category_list['num_rows'] > 0) ? $get_category_list['result'] : array() ;
	$smarty->assign('category_list',$category_list);		
	
	// VIEW BY
	
	$view = mysql_real_escape_string(GET('view',POST('projects_view',SESSION('projects_view',''))));
	$view_by = mysql_real_escape_string(GET('view_by',POST('projects_view_by',SESSION('projects_view_by',''))));
	
	
	if(isset($_GET['view']) OR isset($_POST['view']))
		{
			$_SESSION['projects_view'] = $view ;
			$_SESSION['projects_view_by'] = $view_by ;
		}
		
	//print_r($_GET);
	
	switch($view) :
		
		case 'category' :
		
			$projects_where = "WHERE projects.project_category = '".intval($view_by)."' AND projects.project_live = 1";
		
		break;
		
		case 'builder' :
		
			$projects_where = "WHERE projects.project_builder = '".intval($view_by)."' AND projects.project_live = 1";
		
		break;
		
		case 'country' :
		
			$view_by = urldecode($view_by);
			$projects_where = "WHERE builders.builder_country = '".urldecode($view_by)."' AND projects.project_live = 1";
		
		break;
		
		case 'all' :
		
			$projects_where = "WHERE projects.project_live = 1";
			$_SESSION['projects_view'] = 'all' ;
			$_SESSION['projects_view_by'] = '' ;
		
		break;
		
		default :
		
			$projects_where = "WHERE projects.project_live = 1";
		
		break;
	
	endswitch;
	
	$smarty->assign('view',$view);		
	$smarty->assign('view_by',$view_by);	
	
	//$projects_where = "WHERE projects.project_live = 1";
	
	
	
	$get_projects_SQL = "
	
															SELECT
																projects.project_id,
																projects.project_item,
																projects.project_name,
																projects.project_type,
																projects.project_posted as project_created,
																builders.builder_id,
																builders.builder_short_name as project_builder,
																builders.builder_first_name,
																builders.builder_last_name,
																builders.builder_country,
																project_categories.category_id,
																project_categories.category_name,
																project_categories.category_slug,
																project_images.image_filename AS project_thumbnail,
																(SELECT COUNT(project_comments.comment_id) FROM project_comments WHERE project_comments.comment_project = projects.project_id) AS project_comments
															
															FROM
																projects
															
															LEFT JOIN
																builders on projects.project_builder = builders.builder_id
															
															LEFT JOIN
																project_categories on projects.project_category = project_categories.category_id
															
															LEFT JOIN
																project_images on projects.project_thumbnail = project_images.image_id
															
															LEFT JOIN
																project_comments on projects.project_id = project_comments.comment_project
																
															".$projects_where."	
															
															
															GROUP BY
																projects.project_id
															
																
															ORDER BY projects.project_id ASC
	
	";
	
	//echo $get_projects_SQL;
	
	$get_projects = db_select($get_projects_SQL);
	
	$projects = $get_projects['result'];
	
/*
	for($i=0; $i<count($pages); $i++)
		{
			$pages[$i]['Created'] = parse_date($pages[$i]['Created'],'yyyy-mm-dd h:mmS');
			$pages[$i]['viewURL'] = substr($pages[$i]['URL'],1);
			
			$get_section_SQL = "SELECT * FROM `sections` WHERE `ID` = '".$pages[$i]['Section']."'";
			$get_section = db_select($get_section_SQL);
			$pages[$i]['Section'] = ($get_section['num_rows'] > 0) ? $get_section['result'][0]['Name'] : '' ;
		}
*/
		
	$num_projects = count($projects);
	$num_projects .= ' project'.plural($num_projects);
	
	$smarty->assign('projects',$projects);		
	$smarty->assign('num_projects',$num_projects);
	
	if(isset($result)) { $smarty->assign('result',$result);	}
		
	$page_template = 'projects.html' ;

?>