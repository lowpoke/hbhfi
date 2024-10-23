<?php

	function initiate_project()
		{
					
			$project_created = SESSION('project_created',false);
	
			if($project_created == false)
				{			
					$create_project_SQL = "INSERT INTO `projects` (`project_id`,`project_live`,`project_posted`) VALUES (NULL, 0, CURDATE())";
					$create_project = db_insert($create_project_SQL);		
					
					$new_project_id = $create_project['insert_ID'];
					
					// Create project image directories
					
					mkdir('images/projects/'.$new_project_id,0755);
					mkdir('images/projects/'.$new_project_id.'/originals',0755);
					
					$_SESSION['new_project_id'] = $new_project_id;
					$_SESSION['project_created'] = true;
				}
			elseif($project_created == true)
				{
					include_once('inc/get_project.php');
					$get_project = get_project($new_project_id);
		
					if($get_project['exists'])
						{
							$project = $get_project['data'];
						}				
				}
				
			return $_SESSION['new_project_id'];
		
		}
						
?>