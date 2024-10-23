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
		
		
	
	
	// Country list
	
	$get_country_list_SQL = "SELECT builders.builder_id, builders.builder_country as country FROM builders GROUP BY builders.builder_country ORDER BY builders.builder_country ASC";
	$get_country_list = db_select($get_country_list_SQL);	
	$country_list = ($get_country_list['num_rows'] > 0) ? $get_country_list['result'] : array() ;
	$smarty->assign('country_list',$country_list);		
	
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
		
		case 'country' :
		
			$view_by = urldecode($view_by);
			$builders_where = "WHERE builders.builder_country = '".urldecode($view_by)."'";
		
		break;
		
		case 'all' :
		
			$builders_where = "";
			$_SESSION['projects_view'] = 'all' ;
			$_SESSION['projects_view_by'] = '' ;
		
		break;
		
		default :
		
			$builders_where = "";
		
		break;
	
	endswitch;
	
	$smarty->assign('view',$view);		
	$smarty->assign('view_by',$view_by);	

		
		
		
		
		
		
		
		
		
		
	

	
	$get_builders_SQL = "
												SELECT *,
												(SELECT COUNT(project_comments.comment_id) FROM project_comments WHERE project_comments.comment_builder = builders.builder_id) AS builder_comments ,
												(SELECT COUNT(projects.project_id) FROM projects WHERE projects.project_builder = builders.builder_id) AS builder_projects
												FROM `builders` 
												
												".$builders_where."
												
												ORDER BY `builder_id`";
	$get_builders = db_select($get_builders_SQL);
	
	$builders = $get_builders['result'];
	
			
	$num_builders = count($builders);
	$num_builders .= ' builder'.plural($num_builders);
	
	$smarty->assign('builders',$builders);		
	$smarty->assign('num_builders',$num_builders);
	
	if(isset($result)) { $smarty->assign('result',$result);	}
		
	$page_template = 'builders.html' ;

?>