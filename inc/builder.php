<?php

	$page_template = 'builder.htm';
	$page_type = 'file';
	
	include('inc/get_projects.php');
	include('inc/get_project.php');
		
	$projects_page = mysql_real_escape_string(GET('projects_page',1));
	
	$builder_id = intval(mysql_real_escape_string(GET('builder_id',NULL)));
	
	// Get builder's details
	
	$get_builder_SQL = "SELECT * FROM `builders` WHERE `builder_id` = '".$builder_id."' LIMIT 1";
	$get_builder = db_select($get_builder_SQL);
	
	$builder_exists = false;
	
	if($get_builder['num_rows'] > 0)
		{
			$builder_exists = true;
			$builder = $get_builder['result'][0];
		}
	else
		{
			$builder = array();
		}
		
	$smarty->assign('builder',$builder);
	
	$projects = get_projects('builder:'.$builder_id,'','','html_array');
	
	$num_projects = $projects['num_projects'];
	$html_array = $projects['html_array'];
	
	
	// PAGINATION
	
	$ppp = 4;
	
	$show_pagination = false;
	$num_pages = ($num_projects > $ppp) ? ceil($num_projects / $ppp) : 1;
	
	if($num_pages > 1)
		{
			$show_pagination = true;
			
			$pagination_next = array();
			$pagination_prev = array();
			$pagination_next['show'] = ($projects_page == $num_pages-1) ? false : true ;
			$pagination_prev['show'] = ($projects_page == 1) ? false : true ;
			$pagination_next['page'] = $projects_page + 1;
			$pagination_prev['page'] = $projects_page - 1;
			$smarty->assign('pagination_next',$pagination_next);
			$smarty->assign('pagination_prev',$pagination_prev);
			
			$pagination_links = array();
			
			if ($projects_page > 1) {
				$from = max($projects_page - 3, 1);
				$to = max($projects_page, 1);
				for($i=$from; $i<$to; $i++) {
					$pagination_links[] = array(
						'page' => $i,
						'selected' => false
					);
				}
			}
			
			$pagination_links[] = array(
				'page' => $projects_page,
				'selected' => true
			);
			
			if ($projects_page < $num_pages) {
				$from = min($projects_page, $num_pages-1);
				$to = min($projects_page+5, $num_pages-1);
				for($i=$from; $i<$to; $i++) {
					$pagination_links[] = array(
						'page' => ($i + 1),
						'selected' => false
					);
				}
			}
			
			$smarty->assign('pagination_links',$pagination_links);
		}
		
	$smarty->assign('show_pagination',$show_pagination);
		
		
		
		
	
/*
	$projects_html = '';
	
	for($p=0; $p<$num_projects; $p++)
		{
			if(array_key_exists($p,$html_array))
				{
					$projects_html .= $html_array[$p];
				}			
		}
*/
		
		
	$projects_first = ($projects_page * $ppp) - $ppp;
	$projects_html = '';
	
	for($p=0; $p<$ppp; $p++)
		{
			$rec_num = $projects_first + $p;
			
			if(array_key_exists($rec_num,$html_array))
				{
					$projects_html .= $html_array[$rec_num];
				}			
		}
	
	$smarty->assign('num_projects',$num_projects);
	$smarty->assign('projects_html',$projects_html);
	
	// Get comment count
	
	$count_comments_SQL = "SELECT `comment_id` FROM `project_comments` WHERE `comment_builder` = '".$builder_id."'";
	$count_comments = db_select($count_comments_SQL);
	
	$num_comments = $count_comments['num_rows'];
	$smarty->assign('num_comments',$num_comments);
	
	// Get comments by this builder
			
	$get_comments = get_comments('builder:'.$builder_id,'`comment_posted` DESC','4',true);
	$builder_comments = ($get_comments['num_comments']) ? $get_comments['data'] : array();
	$smarty->assign('builder_comments',$builder_comments);
			
?>
