<?php

	
	###  PAGE ACTIONS  ###
	
	switch($action)
		{
														
													
			case 'edit_comment' :
					// Define POST variables
					
					$comment_id           = POST('comment_id',NULL);
					$comment        			= mysql_real_escape_string(POST('comment',''));
										
					$edit_comment_SQL = "UPDATE `project_comments` SET
																								`comment_comment` = '".$comment."'
																						
																						WHERE `comment_id` = '".$comment_id."'";
																						
					//echo $edit_comment_SQL; exit;
					
					$edit_comment = db_update($edit_comment_SQL);
					
					if($edit_comment == true)
						{
							$result = result('success',"Changes to comment saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to comment have been saved.");
						}
					
					break;
					
					
					case 'delete_comment' :
					// Define POST variables
					
					$comment_ID       = GET('ID',NULL);
					
					$get_comment_SQL = "SELECT `comment_comment` FROM `project_comments` WHERE `comment_id` = ".$comment_ID ;
					$get_comment = db_select($get_comment_SQL);
					
					$comment = $get_comment['result'][0]['comment_comment'];					
					$comment = (strlen($comment) > 50) ? substr($comment,0,50).'...' : $comment ;
										
					$delete_comment_SQL = "DELETE FROM `project_comments` WHERE `comment_id` = ".$comment_ID ;					
					
					//echo $delete_comment_SQL; exit;
					
					$delete_comment = db_update($delete_comment_SQL);
					
					if($delete_comment == true)
						{
							$result = result('success',"<strong>'".$comment."'</strong> deleted successfully.");
						}
					else
						{
							$result = result('warning',"<strong>'".$comment."'</strong> could not be deleted.");
						}
					
					break;
					
					
																			
		}
		
		
		

	// Builders list
	
	$get_builder_list_SQL = "SELECT project_comments.comment_id, builders.builder_id, builders.builder_short_name FROM project_comments INNER JOIN builders on project_comments.comment_builder = builders.builder_id GROUP BY project_comments.comment_builder ORDER BY project_comments.comment_builder ASC";
	$get_builder_list = db_select($get_builder_list_SQL);	
	$builder_list = ($get_builder_list['num_rows'] > 0) ? $get_builder_list['result'] : array() ;
	$smarty->assign('builder_list',$builder_list);		
	
	// Project list
	
	$get_projects_list_SQL = "SELECT project_comments.comment_id, projects.project_id, projects.project_name FROM project_comments INNER JOIN projects on project_comments.comment_project = projects.project_id GROUP BY project_comments.comment_project ORDER BY projects.project_name ASC";
	$get_projects_list = db_select($get_projects_list_SQL);	
	$projects_list = ($get_projects_list['num_rows'] > 0) ? $get_projects_list['result'] : array() ;
	$smarty->assign('projects_list',$projects_list);		
	
	// VIEW BY
	
	$view = mysql_real_escape_string(GET('view',POST('comments_view',SESSION('comments_view',''))));
	$view_by = mysql_real_escape_string(GET('view_by',POST('comments_view_by',SESSION('comments_view_by',''))));
	
	
	if(isset($_GET['view']) OR isset($_POST['view']))
		{
			$_SESSION['projects_view'] = $view ;
			$_SESSION['projects_view_by'] = $view_by ;
		}
		
	//print_r($_GET);
	
	switch($view) :
		
		case 'builder' :

			$comments_where = "WHERE project_comments.comment_builder = '".$view_by."'";
			
		break;
		
		case 'project' :
		
			$view_by = urldecode($view_by);
			$comments_where = "WHERE project_comments.comment_project = '".$view_by."'";
		
		break;
		
		case 'all' :
		
			$comments_where = "";
			$_SESSION['comments_view'] = 'all' ;
			$_SESSION['comments_view_by'] = '' ;
		
		break;
		
		default :
		
			$comments_where = "";
		
		break;
	
	endswitch;
	
	$smarty->assign('view',$view);		
	$smarty->assign('view_by',$view_by);	
		
		
		
		
		
		
		
	

	
	$get_comments_SQL = "
	
			SELECT
				project_comments.comment_id,
				project_comments.comment_posted,
				project_comments.comment_builder,
				project_comments.comment_project,
				project_comments.comment_comment,
				projects.project_id,
				projects.project_item,
				projects.project_name,
				projects.project_type,
				builders.builder_short_name,
				builders.builder_first_name,
				builders.builder_last_name,
				builders.builder_country
			
			FROM
				project_comments
			
			LEFT JOIN
				projects on project_comments.comment_project = projects.project_id
			
			LEFT JOIN
				builders on project_comments.comment_builder = builders.builder_id
				
			".$comments_where."
						
			GROUP BY
				project_comments.comment_id
			
				
			ORDER BY project_comments.comment_posted DESC
	
	";
	
	$get_comments = db_select($get_comments_SQL);
	
	$comments = $get_comments['result'];
	
	$num_comments = count($comments);
	$num_comments .= ' comment'.plural($num_comments);
	
	for($c=0; $c<count($comments); $c++)
		{
			$comments[$c]['short_comment'] = (strlen($comments[$c]['comment_comment']) > 50) ? substr($comments[$c]['comment_comment'],0,50).'...' : $comments[$c]['comment_comment'] ;
		}
	
	$smarty->assign('comments',$comments);		
	$smarty->assign('num_comments',$num_comments);
	
	if(isset($result)) { $smarty->assign('result',$result);	}
		
	$page_template = 'comments.html' ;

?>