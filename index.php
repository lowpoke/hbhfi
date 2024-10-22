
<?php

	#### INITIATION ####
	
	require_once('functions/initiation.php');
	
	#### AUTHENTICATION ####
	
	require_once('functions/authentication.php');
	

	#### LOAD PAGE CONTENT ####

	$page_title = '';	
	
	$show_submit_button = SESSION('show_submit_button',true);
	
	$project_pages = array('vinyl','amps','speakers','digital','analog','mods','recent','popular');

	if(in_array($page,$project_pages))
		{
			$project_category = $page;
			$page = 'projects';
		}
	
	if($page == 'news')
		{
			include('inc/news.php');
		}	
	elseif(file_exists('inc/'.$page.'.php'))
		{
			include('inc/'.$page.'.php');
			$page_title = $page;
			$page_type = 'file';
			$main_class = $page;
		}
	elseif(file_exists('pages/'.$page.'.htm'))
		{
			$page_template = $page.'.htm' ;
			$page_title = $page;
			$page_type = 'file';
			$main_class = $page;
		}
	else
		{
			$get_page_SQL = "SELECT * FROM `pages` WHERE `URL` = '/".$page."' LIMIT 1";	
			$get_page = db_select($get_page_SQL);	
			
			if($get_page['num_rows'] > 0)
				{
					$page_data = $get_page['result'][0];
					$page_content = stripslashes($page_data['Content']);
					$page_title = stripslashes($page_data['Title']);
					
					$get_section_SQL = "SELECT * FROM `sections` WHERE `ID` = '".$page_data['Section']."'";
					$get_section = db_select($get_section_SQL);
					
					if(count($get_section['result']))
						{
							$page_section = $get_section['result'][0];			
							$main_class = strtolower(str_replace(' ','_',$page_section['Name']));
						}
					else
						{
							$page_section = array();			
						}
					
					// Check if page contains a photo gallery and build if necessary
					$page_content = build_gallery($page_content);
					
					
					$page_type = 'db';
					
					$smarty->assign('page_content',$page_content);
					
					if(substr($page_data['URL'],0,1) == '/')
						{
							$page_data['URL'] = substr($page_data['URL'],1);
						}
					
					$smarty->assign('page_url',$page_data['URL']);
					
				}
			else
				{
					$page_template = '404.htm';
					$page_title = 'Page Not Found';
					$page_type = 'file';
					$main_class = 'page_not_found';
				}
		}
		
	if($page == 'home')
		{
			$latest_news = sidebar_news();
			$page_content = str_replace('{$latest_news}',$latest_news,$page_content);
			//$smarty->assign('latest_news',$latest_news);
			$smarty->assign('page_content',$page_content);
		}
		
		

		
		
	// IF SUBMISSION IS IN PROGRESS, SHOW MESSAGE AT TOP OF PAGE
	
	if(SESSION('sub_in_progress',false) && $page != 'submit')
		{
			$submission_message = 'You have a submission in progress.  <a href="submit">Continue &raquo;</a>';
		}
	else
		{
			$submission_message = '';
		}
	$smarty->assign('submission_message',$submission_message);
	
	
	// SET PAGE TITLE
	
	$page_title = str_replace('_',' ',$page_title);
	$page_title = ($page != 'home' || strlen($page_title) == 0) ? ucwords($page_title).' | ' : '' ;
	
	if($page == 'projects') { $page_title = ''; }
		
	//  Assign default smarty variables
	
	$smarty->assign('page',$page);
	$smarty->assign('page_title',$page_title);
	
	if($page_type == 'file')
		{
			$smarty->assign('page_template',$page_template);
		}
	
	$smarty->assign('page_type',$page_type);
	if(isset($main_class)) $smarty->assign('main_class',$main_class);
	
	
	

	if(isset($login_status))
		{
			$smarty->assign('login_status',$login_status);
		}
		
	if(isset($submitted_username))
		{
			$smarty->assign('submitted_username',$submitted_username);
		}
	
	$smarty->assign('show_submit_button',$show_submit_button); 
		
	$user_authenticated = $Auth->User_Authenticated() ;
	$smarty->assign('user_authenticated',$user_authenticated);
	
	$smarty->assign('thumbnail_js', $thumbnail_js);
	
	//$main_menu = output_menu(1,'first','last');
	//$smarty->assign('main_menu',$main_menu);

	
	//  Load main "index" template
	
	$smarty->display('index.htm');


	
	
?>
