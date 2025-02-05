<?php /* Smarty version 2.6.22, created on 2019-03-06 02:04:11
         compiled from submit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'submit.htm', 443, false),)), $this); ?>

		<?php if ($this->_tpl_vars['step'] == 'start'): ?>
				
				<div id="submit_left">
				
					<h2>SUBMIT A PROJECT</h2>
					
					<p>The aim of Homebuilt Hi-fi is to showcase some of the most outstanding hi-fi projects being built by dedicated enthusiasts from all over the world. Sadly, we will never be able to fully appreciate how good these components actually sound via a website.</p>
					<p>It is for this reason that we've chosen to focus on attributes we can fully appreciate using this media - aesthetics and design. So if you have a project that not only sounds great, but has been thoughtfully designed, skillfully executed and painstakingly assembled, we would love for you to contribute to the gallery.</p>
					<p>Please only upload photographs that are of a high quality. This is all we'll have to assess your work, so try and make it count.</p>
					<p>
						<strong>IMAGE REQUIREMENTS</strong><br />
						<ul>
						<li>Images must be in jpeg format</li>
						<li>Images must be more than 605 pixels wide</li>
						<li>Images must be 72 dpi or higher (maximum 300 dpi)</li>
						<li>Images must not be more than 5 Mb per individual image</li>
						</ul>
					</p>

				</div>
				
				<div id="submit_right">
				
					<h3>You must be a registered member to submit a new project.  Please login:</h3>
				
					<form action="submit" id="submit_form" method="post">
					
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
							<div id="save_spinner"><img src="images/layout/loader.gif" alt="" style="vertical-align: middle;" /> &nbsp;</div>
							<input type="submit" name="login" id="submit_button" value="Login &raquo" />
							<input type="hidden" name="save_action" value="login" />
						</div>
					
					</form>
					
					<h3>...or Become a Member:</h3>
				
					<form action="submit" method="post" id="sign_up_form">
					
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
		
		
		<?php elseif ($this->_tpl_vars['step'] == 'details'): ?>
				
				<div id="submit_left">
				
					<h2>PLEASE READ PRIOR TO SUBMITTING A PROJECT</h2>
					
					<p>The aim of Homebuilt Hi-fi is to showcase some of the most outstanding hi-fi projects being built by dedicated enthusiasts from all over the world. Sadly, we will never be able to fully appreciate how good these components actually sound.</p>
					<p>It is for this reason that we've chosen to focus on attributes we can fully appreciate using this media � aesthetics and design. So if you have a project that not only sounds great, but has been thoughtfully designed, skillfully executed and painstakingly assembled, we would love for you to contribute to the gallery.</p>
				
				</div>
				
				<div id="submit_right">
				
					<h3>Enter project details...</h3>
				
					<form id="submit_form" action="submit/details" method="post">
					
						<?php if ($this->_tpl_vars['post_valid'] == false && $this->_tpl_vars['validation_text'] != ''): ?> 
						
						<div id="form_validation">
							
							<ul>
								<li><?php echo $this->_tpl_vars['validation_text']; ?>
</li>
							</ul>						
							
						</div>
						
						<?php endif; ?>
					
						<ul class="form">
						
							<li>
								<label for="project_type">Category:</label>
								<select name="project_category" id="project_category" class="select_field validate['required','select']<?php if (in_array ( 'project_category' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>">
									<option value="NULL">Select...</option>
									<option value="1"<?php if ($this->_tpl_vars['project']['project_category'] == 1 || $_POST['project_category'] == 1): ?> selected="selected"<?php endif; ?>>Vinyl</option>
									<option value="2"<?php if ($this->_tpl_vars['project']['project_category'] == 2 || $_POST['project_category'] == 2): ?> selected="selected"<?php endif; ?>>Amps</option>
									<option value="3"<?php if ($this->_tpl_vars['project']['project_category'] == 3 || $_POST['project_category'] == 3): ?> selected="selected"<?php endif; ?>>Speakers</option>
									<option value="4"<?php if ($this->_tpl_vars['project']['project_category'] == 4 || $_POST['project_category'] == 4): ?> selected="selected"<?php endif; ?>>Digital</option>
									<option value="5"<?php if ($this->_tpl_vars['project']['project_category'] == 5 || $_POST['project_category'] == 5): ?> selected="selected"<?php endif; ?>>Analog</option>
									<option value="6"<?php if ($this->_tpl_vars['project']['project_category'] == 6 || $_POST['project_category'] == 6): ?> selected="selected"<?php endif; ?>>Mods</option>
								</select>
							</li>
							
							<li>
								<label for="project_item">Item:</label>
								<input type="text" name="project_item" id="project_item" class="text_field validate['required']<?php if (in_array ( 'project_item' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" value="<?php if (isset ( $_POST['project_item'] )): ?><?php echo $_POST['project_item']; ?>
<?php else: ?><?php echo $this->_tpl_vars['project']['project_item']; ?>
<?php endif; ?>" />
							</li>
							
							<li>
								<label for="project_type">Type/Model:</label>
								<input type="text" name="project_type" id="project_type" class="text_field<?php if (in_array ( 'project_type' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" value="<?php if (isset ( $_POST['project_type'] )): ?><?php echo $_POST['project_type']; ?>
<?php else: ?><?php echo $this->_tpl_vars['project']['project_type']; ?>
<?php endif; ?>" />
							</li>
							
							<li>
								<label for="project_name">Project Name:</label>
								<input type="text" name="project_name" id="project_name" class="text_field<?php if (in_array ( 'project_name' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" value="<?php if (isset ( $_POST['project_name'] )): ?><?php echo $_POST['project_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['project']['project_name']; ?>
<?php endif; ?>" />
							</li>
							
							<li>
								<label for="project_description">Description:</label>
								<textarea name="project_description" id="project_description" class="text_field<?php if (in_array ( 'project_description' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" cols="50" rows="10"><?php if (isset ( $_POST['project_description'] )): ?><?php echo $_POST['project_description']; ?>
<?php else: ?><?php echo $this->_tpl_vars['project']['project_description']; ?>
<?php endif; ?></textarea>
							</li>
						
						</ul>
						
						<div class="steps">
							
							<span class="step current">01. Details</span>
							<span class="step">02. Upload</span>
							<span class="step">03. Thumbnail</span>							
							<span class="step">04. Preview</span>														
							<span class="step">05. Submit</span>
							
							<div id="save_spinner"><img src="images/layout/loader.gif" alt="" style="vertical-align: middle;" /> &nbsp;</div>
							
							<input id="submit_button" type="submit" value="Next &raquo" />
							<input type="hidden" name="save_action" value="details" />
						</div>
					
					</form>
				
				</div>
				
		<?php elseif ($this->_tpl_vars['step'] == 'upload'): ?>
		
				<div id="submit_left">
				
					<h2>PLEASE ENSURE YOUR PHOTOGRAPHY DOES YOUR PROJECT JUSTICE</h2>
					
					<p>Please take the time prior to uploading your images to ensure they are of a reasonable standard. You can upload up to five images;</p>
					<ul>
						<li>Have you photographed your project on a clean, uncluttered surface?</li>
						<li>Are your photographs in focus?</li>
						<li>Does your image set portray all the key features of your project?</li>
					</ul>
					
					<p>The layout used on our project pages lends itself to images that are in a landscape format (wide). That's not to say you can't include any images in portrait format (long), but it may make your project page very long. </p>
					<p>Try to include at least one photograph of the project in its entirety, along with a few close ups so we can appreciate the detail.</p>

				</div>
								
				<div id="submit_right">
				
					<h3>Upload your photos...</h3>
				
					<form id="submit_form" action="submit/upload" enctype="multipart/form-data" method="post">
					
						<?php if ($this->_tpl_vars['post_valid'] == false && $this->_tpl_vars['error_text'] != ''): ?> 
						
						<div id="form_validation">
							
							<ul>
								<?php echo $this->_tpl_vars['error_text']; ?>

							</ul>						
							
						</div>
						
						<?php endif; ?>
						
						<ul class="form" class="upload_ul">
													
							<li>
								<label for="image_one" class="upload_label">01</label>
								<input type="file" name="image_one" id="image_one" class="text_field" />
							</li>
							
							<li>
								<label for="image_two" class="upload_label">02</label>
								<input type="file" name="image_two" id="image_two" class="text_field" />
							</li>
							
							<li>
								<label for="image_three" class="upload_label">03</label>
								<input type="file" name="image_three" id="image_three" class="text_field" />
							</li>
							
							<li>
								<label for="image_four" class="upload_label">04</label>
								<input type="file" name="image_four" id="image_four" class="text_field" />
							</li>
							
							<li>
								<label for="image_five" class="upload_label">05</label>
								<input type="file" name="image_five" id="image_five" class="text_field" />
							</li>
						
						</ul>
						
						<div class="steps">
							
							<span class="step">01. <a href="submit/details">Details</a></span>
							<span class="step current">02. Upload</span>
							<span class="step">03. Thumbnail</span>								
							<span class="step">04. Preview</span>														
							<span class="step">05. Submit</span>
							
							<div id="save_spinner"><img src="images/layout/loader.gif" alt="" style="vertical-align: middle;" /> &nbsp;</div>
							
							<input type="submit" id="submit_button" value="Next &raquo" />
							<input type="hidden" name="save_action" value="upload" />
						</div>
					
					</form>
				
				</div>
		
		<?php elseif ($this->_tpl_vars['step'] == 'thumbnail'): ?>
		
				<div id="submit_left">
				
					<h2>Thumbnail preview:</h2>
					
					<div style="width: 290px; float: left; position: relative;"><div id="thumb_preview"></div></div>
					
					<h3>Select image:</h3>
					
					<div id="image_thumbnails" class="image_thumbnails">
					
					<?php $_from = $this->_tpl_vars['image_thumbnails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thumbnail']):
?>
					
						<img src="inc/img.php?dimension=c143&image=<?php echo $this->_tpl_vars['thumbnail']['image_filename']; ?>
&folder=projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/" alt="" title="<?php echo $this->_tpl_vars['thumbnail']['image_filename']; ?>
" />
					
					<?php endforeach; endif; unset($_from); ?>
					
					</div>
									
				</div>
				
				<div id="submit_right">
				
					<h3>Define your projects thumbnail...</h3>
				
					<form action="submit/thumbnail" id="thumb_form" method="post">
					
						<div class="thumb_crop_container"><img id="thumb_crop" src="images/projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/<?php echo $this->_tpl_vars['first_image']['image_filename']; ?>
" alt=""/></div>
						
						<h3>How to choose your thumbnail:</h3>
						
						<p>To the right are the images you uploaded in the previous step.  Please choose your most prized photograph from the list by clicking on its thumbnail. The large image above will be replaced by your choice and a selection box will be overlaid.  You can click and drag around as well as resize the selection box using the handles in the corners.  A preview of your thumbnail appears in the top left.  When you're happy with the selection, click next below.</p>
												
						<div class="steps">
							
							<span class="step">01. <a href="submit/details">Details</a></span>
							<span class="step">02. <a href="submit/upload">Upload</a></span>
							<span class="step current">03. Thumbnail</span>								
							<span class="step">04. Preview</span>														
							<span class="step">05. Submit</span>
							
							<div id="save_spinner"><img src="images/layout/loader.gif" alt="" style="vertical-align: middle;" /> &nbsp;</div>
							
							<input type="submit" value="Next &raquo" id="save_thumb" />
							<input type="hidden" name="save_action" value="thumbnail" />
							<input type="hidden" name="thumbnail_file" id="thumbnail_file" value="<?php echo $this->_tpl_vars['first_image']['image_filename']; ?>
" />
						</div>
					
					</form>
				
				</div>
				
				<script type="text/javascript">
				
					var images_path = 'images/projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/';
				
				<?php echo '
					
					$$(\'#image_thumbnails img\').each(function(t) {
					
						t.addEvent(\'click\',function() {
						
							var img_url = t.get(\'title\');
							
							//console.log(\'thumbCrop.changeImage: \\\'\' + images_path + img_url + \'\\\'\');
							
							thumbCrop.changeImage(images_path + img_url);
							$(\'thumbnail_file\').value = img_url;
						
						});
					
					});
					
					$(\'save_thumb\').addEvent(\'click\',function(e) {
					
						new Event(e).stop();
						
						$(\'save_thumb\').disabled = 1;
						$(\'save_thumb\').set(\'value\',\'Please wait...\');
						var save_spinner = $(\'save_spinner\');
						save_spinner.fade(\'show\');
											
						thumbCrop.cropSave({images_path: images_path},function(){ $(\'thumb_form\').submit(); });
						
					});
					
					
				'; ?>

				</script>
				
				
		
		<?php elseif ($this->_tpl_vars['step'] == 'preview'): ?>
		
				<div id="submit_left">
				
					<h2>Preview:</h2>
					
					<p>Below is a preview of your project submission.  Click next to submit your project.</p>
									
				</div>
				
				<div id="submit_right">
								
					<form action="submit/preview" id="thumb_form" method="post">
					
												
						<div class="steps">
							
							<span class="step">01. <a href="submit/details">Details</a></span>
							<span class="step">02. <a href="submit/upload">Upload</a></span>
							<span class="step">03. <a href="submit/thumbnail">Thumbnail</a></span>								
							<span class="step current">04. Preview</span>														
							<span class="step">05. Submit</span>
							
							<div id="save_spinner"><img src="images/layout/uploadspinner.gif" alt="" style="vertical-align: middle;" /> &nbsp; Please wait...</div>
							
							<input type="submit" value="Next &raquo" id="approve_preview" title="Please accept our terms before continuing." />
							<input type="hidden" name="save_action" value="preview" />
						</div>
						
						<div class="accept_terms"><input type="checkbox" name="accept_terms" id="accept_terms" value="1" /> I have read and agree to the Terms &amp; Conditions <a href="terms" id="show_terms">View Terms</a></div>
						
						<div id="terms_slider" style="float: left;">
						
							<div class="terms_conditions" id="terms_conditions">
							
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "terms_conditions.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							
							</div>
						
						</div>
					
					</form>
				
				</div>
				
				
				<div style="width: 945px; float: left; padding-top: 25px; border-top: 3px solid #ccc;">
				
				<div id="project_details">	
		
					<ul>
						<li><em>Item:</em> <strong style="text-transform: uppercase;"><?php echo $this->_tpl_vars['project']['project_item']; ?>
</strong></li>
						<li><em>Type:</em> <?php echo $this->_tpl_vars['project']['project_type']; ?>
</li>
						<li><em>Posted:</em> <?php echo ((is_array($_tmp=$this->_tpl_vars['project']['project_posted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %B %Y") : smarty_modifier_date_format($_tmp, "%e %B %Y")); ?>
</li>
						<li><em>Builder:</em> <a href="builder/<?php echo $this->_tpl_vars['project']['builder_short_name']; ?>
"><?php echo $this->_tpl_vars['project']['builder_short_name']; ?>
</a></li>
						<li><em>Country:</em> <?php echo $this->_tpl_vars['project']['builder_country']; ?>
</li>
						<li><em>Comments:</em> <?php echo $this->_tpl_vars['project']['project_comments']; ?>
</li>
					</ul>
					
					<h2><?php echo $this->_tpl_vars['project']['project_name']; ?>
</h2>
					
					<div id="project_description">
						<?php echo $this->_tpl_vars['project']['project_description']; ?>

					</div>
					
				</div>
				
				<div id="project_images">
				
				<?php $_from = $this->_tpl_vars['project_images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>	
					<?php if ($this->_tpl_vars['image']['image_type'] == 'full'): ?> 
				 		<img src="images/projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/<?php echo $this->_tpl_vars['image']['image_filename']; ?>
" alt="" /><br /> 
					<?php endif; ?> 
				<?php endforeach; endif; unset($_from); ?> 
				
				</div>
	
			</div>
								
				
		
		<?php elseif ($this->_tpl_vars['step'] == 'finish'): ?>
		
				<div id="submit_left">
				
					<div class="panel <?php echo $this->_tpl_vars['project']['category_slug']; ?>
" id="preview_panel">
					
						<a href="project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
"><?php echo $this->_tpl_vars['project']['project_type']; ?>
</a>
					
						<div class="hover_overlay <?php echo $this->_tpl_vars['project']['category_slug']; ?>
" id="preview_overlay"></div>
						<div class="overlay_icon <?php echo $this->_tpl_vars['project']['category_slug']; ?>
"></div>
					
						<img src="images/projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/<?php echo $this->_tpl_vars['project']['project_thumbnail']; ?>
" alt="<?php echo $this->_tpl_vars['project']['project_type']; ?>
" />
						<ul>
							<li><em>Item:</em> <strong><?php echo $this->_tpl_vars['project']['project_item']; ?>
</strong></li>
							<li><em>Type:</em> <?php echo $this->_tpl_vars['project']['project_type']; ?>
</li>
							<li><em>Posted:</em> <?php echo ((is_array($_tmp=$this->_tpl_vars['project']['project_posted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %B %Y") : smarty_modifier_date_format($_tmp, "%e %B %Y")); ?>
</li>					
							<li><em>Builder:</em> <?php echo $this->_tpl_vars['project']['builder_short_name']; ?>
</li>
							<li><em>Country:</em> <?php echo $this->_tpl_vars['project']['builder_country']; ?>
</li>
							<li><em>Comments:</em> <?php echo $this->_tpl_vars['project']['project_comments']; ?>
</li>
						</ul>
					
					</div>

									
				</div>
				
				<div id="submit_right" style="height: 325px;">
								
					<h3>Your project has been submitted!...</h3>
					
					<ul class="submittion_complete">
						<li>&gt; <a href="project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">View Project</a></li>					
					</ul>
					
				</div>
				
				<script type="text/javascript">
			<?php echo '
								
				var preview_overlay = $(\'preview_overlay\');
					var preview_panel = $(\'preview_panel\');
					
					preview_panel.addEvent(\'mouseover\', function() { preview_overlay.fade(\'in\'); });
					
					preview_overlay.fade(\'hide\');
					
					preview_panel.addEvents({
					
						\'mouseover\': function() { preview_overlay.fade(\'in\'); },
						\'mouseout\': function() { preview_overlay.fade(\'out\'); }					
					});
				
			'; ?>

		</script>
								
				
		
		<?php endif; ?>
				
		
				