<?php /* Smarty version 2.6.22, created on 2019-03-06 02:27:43
         compiled from login.html */ ?>

				<div id="tab_bar">
					<h1>Site Administration</h1>
				</div>
				
				<div id="login">
				
					<h2>Please Login</h2>
					
					<form id="login_post" action="login" method="post">
					
						<p class="login_result"><?php echo $this->_tpl_vars['login_result']; ?>
&nbsp;</p>
						
						<p>
							<strong>Username</strong><br />
							<input type="text" name="user" />
						</p>
						
						<p>
							<strong>Password</strong><br />
							<input type="password" name="pass" />
							<input type="hidden" name="action" value="login" />
						</p>
					
					</form>
				
				</div>
				
				<div class="buttons_bar">
					<div class="loader"></div>
					<ul class="right">
						<li><span><a href="#" class="accept submit" id="login_submit">Login</a></span></li>
					</ul>				
				</div>
				
				<script type="text/javascript">
								
<?php echo '

					$(\'login_submit\').addEvent(\'click\',function(e) {
					
						new Event(e).stop();
						
						$$(\'.loader\').each(function(loader) {
							$(loader).fade(\'in\');
						});
						
						$(\'login_post\').submit();
					
					});

'; ?>


				</script>