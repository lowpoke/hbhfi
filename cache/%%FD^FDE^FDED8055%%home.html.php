<?php /* Smarty version 2.6.22, created on 2019-03-06 02:28:33
         compiled from home.html */ ?>

				<div id="tab_bar">
					<h1>Site Administration</h1>
				</div>
				
				<div id="home_menu">
				
					<ul>
					
						<li><a href="content/pages" class="site_content">Site Content</a></li>
						<!-- <li><a href="news_articles" class="news">News &amp; Articles</a></li> -->
						<li><a href="image_manager" class="image_manager">Image Manager</a></li>
						<li><a href="file_manager" class="file_manager">File Manager</a></li>
						<li><a href="projects" class="projects">Projects</a></li>
						<li><a href="builders" class="builders">Builders</a></li>
						<!-- <li><a href="comments" class="comments">Comments</a></li> -->
						<!-- <li><a href="photo_galleries" class="photo_galleries">Photo Galleries</a></li> -->
						<!-- <li><a href="menu_editor" class="menu_editor">Menu Editor</a></li> -->
						<li><a href="user_accounts" class="user_accounts">User Accounts</a></li>
						<!-- <li><a href="statistics" class="statistics">Statistics</a></li> -->
					
					</ul>
				
				</div>
				
				<script type="text/javascript">
								
<?php echo '

					$$(\'#home_menu li\').each(function(li){
					
						li.addEvents({
						
							mouseover: function(){ li.morph({\'background-color\':\'#ccc\'}); li.getElement(\'a\').morph({\'color\':\'#000\'}); },
							mouseout: function(){ li.morph({\'background-color\':\'#f7f7f7\'}); li.getElement(\'a\').morph({\'color\':\'#666\'}); }
						
						});
					
					
					});

'; ?>


				</script>