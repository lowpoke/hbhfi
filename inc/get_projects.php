<?php

	function get_projects($category,$limit,$order,$return = 'html')
		{
	
			$where = '';
			$sql_order = '';
			$sql_limit = '';
							
			if(substr($category,0,8) == 'builder:')
				{
					$get_builder = intval(str_replace('builder:','',$category));
					$where = "WHERE projects.project_builder = ".$get_builder." AND projects.project_live = 1";
				}
			elseif(substr($category,0,7) == 'search:')
				{
					$search_q = str_replace('search:','',$category);
					$where = "WHERE MATCH(`project_item`,`project_name`,`project_type`,`project_description`) AGAINST ('".$search_q."') AND projects.project_live = 1";
				}
			elseif($category == 'recent')
				{
					$where = "WHERE projects.project_live = 1";
					$sql_limit = "" ;
				}
			else
				{
					if(strlen(trim($category)) > 0)
						{
							$where = "WHERE project_categories.category_slug = '".$category."' AND projects.project_live = 1";
						}
				
					if(strlen(trim($limit)) > 0)
						{
							$limit = explode(':',$limit);
							
							$sql_limit = "LIMIT ".$limit[0].", ".$limit[1] ;
						
							$where = "WHERE project_categories.category_slug = '".$category."' AND projects.project_live = 1";
						}
				}
	
			
			if(strlen(trim($order)) > 0)
				{
					$sql_order = "ORDER BY ".$order;					
				}
			else
				{
					$sql_order = "ORDER BY projects.project_posted DESC";
				}
				
			$get_projects_SQL = "
															SELECT
																projects.project_id,
																projects.project_item,
																projects.project_type,
																projects.project_posted,
																builders.builder_short_name,
																builders.builder_first_name,
																builders.builder_last_name,
																builders.builder_country,
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
																
															".$where."
															
															GROUP BY
																projects.project_id
																
															".$sql_order."
															
															".$sql_limit."
															
			";
			
			//echo '<p>'.$get_projects_SQL.'</p>';//exit;
			
			$panel_template = '
			
<div class="panel {$category_slug}">
	<a href="project/{$project_id}">{$project_type}</a>
	<img src="images/projects/{$project_id}/{$project_thumbnail}" alt="{$project_type}" />
	<ul>
		<li><em>Item:</em> <strong>{$project_item}</strong></li>
		<li><em>Type:</em> {$project_type}</li>
		<li><em>Posted:</em> {$project_posted}</li>
		<li><em>Builder:</em> {$builder_short_name}</li>
		<li><em>Country:</em> {$builder_country}</li>
		<li><em>Comments:</em> {$project_comments}</li>
	</ul>
</div>
			
			';
			
			$template_vars = array('project_id','project_type','project_item','project_thumbnail','project_posted','builder_short_name','builder_country','project_comments','category_slug');
			
			$get_projects = db_select($get_projects_SQL);
			
			$projects = $get_projects['result'];
			
			$project_html = array();
			
			for($p=0; $p<$get_projects['num_rows']; $p++)
				{
					$project = $projects[$p];
					$project['project_posted'] = date('j F Y',strtotime($project['project_posted']));
					
					
					$project_html[$p] = $panel_template;
					
					foreach($template_vars as $temp_var)
						{
							$project_html[$p] = str_replace('{$'.$temp_var.'}',$project[$temp_var],$project_html[$p]);
						}
				}
				
			switch($return)
				{
					case 'html' :
					
						$return_html = '';
						foreach($project_html as $html)
							{
								$return_html .= $html;
							}
							
						return $return_html;
					
					break;
					
					case 'html_array' :
					
						$return = array();
						
						$return['num_projects'] = $get_projects['num_rows'];
						$return['html_array'] = $project_html;
						
						return $return;
					
					break;	
					
					case 'output' :
					
						$output_html = '';
						foreach($project_html as $html)
							{
								$output_html .= $html;
							}
							
						echo $output_html;
						
						return true;
					
					break;
					
					case 'array' :
					
						return $projects;
					
					break;				
				}
				
		}
		
	function refresh_project_count()
		{
			$count_file = "inc/PROJECTCOUNT.txt";
			$fh = fopen($count_file, 'w');
			
			$get_count_SQL = "SELECT `project_id` FROM `projects` WHERE `project_live` = 1";
			$get_count = db_select($get_count_SQL);
			$project_count = $get_count['num_rows'];
			
			fwrite($fh,$project_count);
			fclose($fh);
		}
	

?>