<?php
	
	require('functions/admin_initiation.php');
	
	$selected = selected($page);
	
	//$page = 'pages';
	
	function selected($page='')
		{
			$selected_item = '';
			
			if(is_string($page))
				{			
					$selected = array();
					$selected['home'] = '';
					$selected['pages'] = 'site_content';
					$selected['sections'] = 'site_content';
					$selected['new_page'] = 'site_content';
					$selected['edit_page'] = 'site_content';
					$selected['new_section'] = 'site_content';
					$selected['edit_section'] = 'site_content';
					$selected['photo_galleries'] = 'photo_galleries';
					$selected['menu_editor'] = 'menu_editor';	
					$selected['image_manager'] = 'image_manager';
					$selected['file_manager'] = 'file_manager';
					$selected['news_articles'] = 'news_articles';
					$selected['news_categories'] = 'news_articles';
					$selected['edit_article'] = 'news_articles';
					$selected['new_article'] = 'news_articles';
					$selected['user_accounts'] = 'user_accounts';			
					$selected['projects'] = 'projects';		
					$selected['edit_project'] = 'projects';
					$selected['edit_project_images'] = 'projects';
					$selected['builders'] = 'builders';
					$selected['comments'] = 'comments';
					
					if(array_key_exists($page,$selected))
						{
							$selected_item = $selected[$page];
						}
				}
				
			return $selected_item;
			
		}	

	if($page != 'login')
		{
	
			if(file_exists('inc/'.$page.'.php'))
				{
					include('inc/'.$page.'.php');
				}
			elseif(file_exists('templates/'.$page.'.html'))
				{
					$page_template = $page.'.html' ;
				}
			else
				{
					$page_template = '404.html';
				}		
	
			
		}
	else
		{
			include('inc/login.php');
		}
		
	if($page == 'logout')
		{
			include('inc/logout.php');
		}
		
	$show_menu = true;
		
	require('inc/auth.php');
		
	if($logged_in == false)
		{
			$page_template = 'login.html';
			$show_menu = false;
		}
		
	if($page == 'home')
		{
			$show_menu = false;
		}

	//  Assign default smarty variables
	
	$smarty->assign('page',$page);
	$smarty->assign('page_template',$page_template);
	
	$smarty->assign('selected',$selected);
	$smarty->assign('show_menu',$show_menu);
	
	$smarty->assign('ROOT',ROOT);
	$smarty->assign('USER',USER);	
	$smarty->assign('cur_user',$cur_user);

	//  Load necessary template
	$smarty->display('index.html');
	
?>
