<?php

	$page_template = 'projects.htm';
	$page_type = 'file';
	
	$projects_page = mysql_real_escape_string(GET('projects_page',1));
	$project_count = file_get_contents('inc/PROJECTCOUNT.txt');
	$smarty->assign('project_count',$project_count);
	
	include('inc/get_projects.php');
	
	// Get projects category
	
	$project_category = (isset($project_category)) ? $project_category : 'recent' ;
	
	// Get projects mode
	
	$mode = GET('mode','');
	$q = POST('q',GET('q',''));
	
	// Define projects DB request
	
	if($mode == 'search') :

		$q = trim(mysql_real_escape_string(GET('q',POST('q',''))));
		
		if(strlen($q) > 0) :		
			$projects = get_projects('search:'.$q,'','','html_array');
		else :
			$projects = get_projects($project_category,'','','html_array');
		endif;
		
	else :

		$projects = get_projects($project_category,'','','html_array');
		
	endif;
	
	$smarty->assign('q',$q);
	$smarty->assign('mode',$mode);
	
	
	// Check if view by builder
	
	$view_by = mysql_real_escape_string(GET('view_by',''));
	$show_builders_list = false;
	$builder_list_select = '';
		
	
	if($view_by == 'builder' && isset($_GET['builder'])) :
		$view_builder = mysql_real_escape_string(GET('builder',''));
		
		if(intval($view_builder) > 0) :
			$projects = get_projects('builder:'.$view_builder,'','','html_array');			
			
			include('inc/get_builders.php');
			
			$show_builders_list = true;
			$builders_list = get_builders();
			$builder_list_select = '<select id="builder_list_select">'."\n";
			$builder_list_select .= '	<option value="0">Select Builder...</option>'."\n";
			for($b=0; $b<count($builders_list); $b++)
				{
					$builder_list_select .= '	<option value="'.$builders_list[$b]['builder_id'].'"'.(($view_builder == $builders_list[$b]['builder_id']) ? ' selected="selected"' : '').'>'.$builders_list[$b]['builder_short_name'].'</option>'."\n";
				}	
			$builder_list_select .= '</select>'."\n";
			$view_by = 'builder';		
			
		endif;
		
	elseif($project_category == 'popular') :
	
		$projects = get_projects('recent','','projects.project_views DESC','html_array');
		
	endif;
	
	$smarty->assign('view_by',$view_by);
	$smarty->assign('show_builders_list',$show_builders_list);
	$smarty->assign('builder_list_select',$builder_list_select);
	
	$num_projects = $projects['num_projects'];
	$html_array = $projects['html_array'];
	
	$show_pagination = false;
	$num_pages = ($num_projects > 6) ? ceil($num_projects / 6) + 1 : 1;
	
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
	
	$projects_first = ($projects_page * 6) - 6;
	
	$projects_html = '';
	
	for($p=0; $p<6; $p++)
		{
			$rec_num = $projects_first + $p;
			
			if(array_key_exists($rec_num,$html_array))
				{
					$projects_html .= $html_array[$rec_num];
				}			
		}
	
	$smarty->assign('project_category',$project_category);
	$smarty->assign('projects_html',$projects_html);
	
	$smarty->assign('show_pagination',$show_pagination);
	$smarty->assign('num_pages',$num_pages);
	
	//$num_projects = 0;
	$smarty->assign('num_projects',$num_projects);
			
?>
