<?php /* Smarty version 2.6.22, created on 2019-03-06 02:10:20
         compiled from login_register.htm */ ?>

				<div id="submit_left">
				
					<h2>LOGIN / REGISTER</h2>
					
					<p>While you don't have to submit a project to become a member of Homebuilt Hi-fi, registration does enable you to comment on others work. However, please be respectful when doing so.</p>
					<p>We will not tolerate profanity, obscene, defamatory, libelous, threatening, harassing, hateful, racially or ethnically offensive behavior. Failure to abide by these rules will result in immediate termination of your membership.</p>
				
				</div>
				
				<div id="submit_right">
					
					<h3>Login</h3>
					
					<form action="login_register" id="submit_form" method="post">
					
						<?php if ($this->_tpl_vars['save_action'] == 'login' && $this->_tpl_vars['post_valid'] == false && $this->_tpl_vars['validation_text'] != ''): ?> 
						
						<div id="form_validation">
							
							<ul>
								<li><strong><?php echo $this->_tpl_vars['validation_text']; ?>
</strong></li>
							</ul>						
							
						</div>
						
						<?php endif; ?>
					
						<ul class="form">
							
							<li>
								<label for="login_email">Email address:</label>
								<input type="text" name="login_email" id="login_email" class="text_field" value="<?php echo $_POST['login_email']; ?>
" />
							</li>
							
							<li>
								<label for="login_password">Password:</label>
								<input type="password" name="login_password" id="login_password" class="text_field" />
							</li>
						
						</ul>
						
						<div class="next">							
							<input type="submit" name="login" id="submit_button" value="Login &raquo" />
							<input type="hidden" name="save_action" value="login" />
						</div>
					
					</form>
					
					<h3>...or Become a Member:</h3>
				
					<form action="login_register" method="post" id="sign_up_form">
					
						<?php if ($this->_tpl_vars['save_action'] == 'sign_up' && $this->_tpl_vars['post_valid'] == false && $this->_tpl_vars['validation_text'] != ''): ?> 
						
						<div id="form_validation">
							
							<ul>
								<li><?php echo $this->_tpl_vars['validation_text']; ?>
</li>
								<?php if ($this->_tpl_vars['email_error']): ?><li><strong>Please Note:</strong><p>The email address <strong><em>&quot;<?php echo $_POST['user_email']; ?>
&quot;</em></strong> is already in use by a member of this site.  If this is you, please use the login form above to continue.</p></li><?php endif; ?>
							</ul>						
							
						</div>
						
						<?php endif; ?>
						
						<ul class="form">
							
							<li>
								<label for="user_nickname">Nickname:</label>
								<input type="text" name="user_nickname" id="user_nickname" value="<?php echo $_POST['user_nickname']; ?>
" class="text_field validate['required']<?php if (in_array ( 'user_nickname' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" />
							</li>
							
							<li>
								<label for="user_first_name">First Name:</label>
								<input type="text" name="user_first_name" id="user_first_name" value="<?php echo $_POST['user_first_name']; ?>
" class="text_field validate['required']<?php if (in_array ( 'user_first_name' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" />
							</li>
							
							<li>
								<label for="user_last_name">Last Name:</label>
								<input type="text" name="user_last_name" id="user_last_name" value="<?php echo $_POST['user_last_name']; ?>
" class="text_field validate['required']<?php if (in_array ( 'user_last_name' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" />
							</li>
							
							<li>
								<label for="user_email">Email address:</label>
								<input type="text" name="user_email" id="user_email" value="<?php echo $_POST['user_email']; ?>
" class="text_field validate['required','email']<?php if (in_array ( 'user_email' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" />
							</li>
							
							<li>
								<label for="user_country">Country:</label>
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "country_select_list.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
							</li>
							
							
							<li>
								<label for="user_password">Password</label>
								<input type="password" name="user_password" id="user_password" value="<?php echo $_POST['user_password']; ?>
" class="text_field validate['required']<?php if (in_array ( 'password' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" />
							</li>
							
							<li>
								<label for="user_confirm_password">Confirm Password</label>
								<input type="password" name="user_confirm_password" id="user_confirm_password" value="<?php echo $_POST['user_confirm_password']; ?>
" class="text_field validate['required','confirm[user_password]']<?php if (in_array ( 'password' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" />
							</li>
						
						</ul>
						
						<div class="next">							
							<input type="submit" value="Sign-Up &raquo" />
							<input type="hidden" name="save_action" value="sign_up" />
						</div>
					
					</form>
				
				</div>