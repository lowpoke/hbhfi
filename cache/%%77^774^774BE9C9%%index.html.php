<?php /* Smarty version 2.6.22, created on 2019-03-06 02:27:43
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		
		<title>Homebuilt Hi-Fi | Site Administration</title>
		
		
		<base href="<?php echo $this->_tpl_vars['ROOT']; ?>
admin/" />
		
		
		<style type="text/css" media="screen"> @import "css/screen_styles.css"; </style>
		<style type="text/css" media="screen"> @import "css/site_content.css"; </style>
		
		<link rel="stylesheet" href="ui/css/content.css" type="text/css" />
		<link rel="stylesheet" href="ui/css/ui.css" type="text/css" />
				
		<script type="text/javascript" src="ui/scripts/mootools-1.2-core.js"></script>
		<script type="text/javascript" src="ui/scripts/mootools-1.2-more.js"></script>
		<script type="text/javascript" src="js/ondomready.js"></script>
		<script type="text/javascript" src="js/mochaCMS.js"></script>

		
		<!--
			mocha.js.php is for development. It is not recommended for production.
			For production it is recommended that you used a compressed version of either
			the output from mocha.js.php or mocha.js. You could also list the
			necessary source files individually here in the header though that will
			create a lot more http requests than a single concatenated file.
				
		<script type="text/javascript" src="scripts/mocha.js"></script>
		
		-->
		<script type="text/javascript" src="ui/scripts/source/Utilities/mocha.js.php"></script>
		<script type="text/javascript" src="ui/scripts/mocha-init.js"></script>

	</head>

	<body>
		
		<div id="wrapper_outer">
			<div id="wrapper_inner">
			
				<div id="header">
				
<?php if ($this->_tpl_vars['logged_in']): ?>
				
					<div id="current_user">
						<p>
							<strong>Logged in as:</strong><br />
							<?php echo $this->_tpl_vars['cur_user']['First_Name']; ?>
 <?php echo $this->_tpl_vars['cur_user']['Last_Name']; ?>

						</p>
						<p><a href="#" id="logout_button">Logout</a></p>
					</div>
					
<?php endif; ?>
				
				</div>
				
<?php if ($this->_tpl_vars['show_menu']): ?>
				
				<div id="main_menu">				
					<ul>
						<li<?php if ($this->_tpl_vars['selected'] == 'admin_home'): ?> class="selected"<?php endif; ?>><a href="home" class="admin_home">Admin<br />Home</a></li>
						<li<?php if ($this->_tpl_vars['selected'] == 'site_content'): ?> class="selected"<?php endif; ?>><a href="content/pages" class="site_content">Site<br />Content</a></li>
						<!-- <li<?php if ($this->_tpl_vars['selected'] == 'news_articles'): ?> class="selected"<?php endif; ?>><a href="news_articles" class="news_articles">News &amp;<br />Articles</a></li> -->
						<li<?php if ($this->_tpl_vars['selected'] == 'image_manager'): ?> class="selected"<?php endif; ?>><a href="image_manager" class="image_manager">Image<br />Manager</a></li>
						<li<?php if ($this->_tpl_vars['selected'] == 'file_manager'): ?> class="selected"<?php endif; ?>><a href="file_manager" class="file_manager">File<br />Manager</a></li>
						<li<?php if ($this->_tpl_vars['selected'] == 'projects'): ?> class="selected"<?php endif; ?>><a href="projects" class="projects">Projects</a></li>
						<li<?php if ($this->_tpl_vars['selected'] == 'builders'): ?> class="selected"<?php endif; ?>><a href="builders" class="builders">Builders</a></li>
						<li<?php if ($this->_tpl_vars['selected'] == 'comments'): ?> class="selected"<?php endif; ?>><a href="comments" class="comments">Comments</a></li>		
						<!-- <li<?php if ($this->_tpl_vars['selected'] == 'project_images'): ?> class="selected"<?php endif; ?>><a href="project_images" class="project_images">Project<br />Images</a></li> -->
						<!-- <li<?php if ($this->_tpl_vars['selected'] == 'photo_galleries'): ?> class="selected"<?php endif; ?>><a href="photo_galleries" class="photo_galleries">Photo<br />Galleries</a></li> -->
						<!-- <li<?php if ($this->_tpl_vars['selected'] == 'menu_editor'): ?> class="selected"<?php endif; ?>><a href="menu_editor" class="menu_editor">Menu<br />Editor</a></li> -->
						<li<?php if ($this->_tpl_vars['selected'] == 'user_accounts'): ?> class="selected"<?php endif; ?>><a href="user_accounts" class="user_accounts">User<br />Accounts</a></li>
						<!-- <li<?php if ($this->_tpl_vars['selected'] == 'statistics'): ?> class="selected"<?php endif; ?>><a href="statistics" class="statistics">Site<br />Statistics</a></li> -->
					</ul>				
				</div>
				
<?php endif; ?>
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			</div>
		</div>

	</body>

</html>