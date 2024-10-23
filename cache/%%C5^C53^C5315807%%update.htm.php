<?php /* Smarty version 2.6.22, created on 2019-03-13 12:17:32
         compiled from update.htm */ ?>
		<?php if ($this->_tpl_vars['section'] == 'details'): ?>
				
				<div id="submit_left">
				
					<h2>UPDATE PROJECT</h2>
					
					<p>The aim of Homebuilt Hi-fi is to showcase some of the most outstanding hi-fi projects being built by dedicated enthusiasts from all over the world. Sadly, we will never be able to fully appreciate how good these components actually sound.</p>
					<p>It is for this reason that we've chosen to focus on attributes we can fully appreciate using this media Ñ aesthetics and design. So if you have a project that not only sounds great, but has been thoughtfully designed, skillfully executed and painstakingly assembled, we would love for you to contribute to the gallery.</p>
				
				</div>
				
				<ul id="update_nav">
					<li class="on"><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Details</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/images">Images</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/thumbnail">Thumbnail</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/youtube">YouTube</a></li>
				</ul>
				
				<div id="submit_right">
				
					<h3>Project details...</h3>
				
					<form action="update/save" method="post">
						<input type="hidden" name="section" value="details" />
						<input type="hidden" name="project_id" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" />
						
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
							<input id="submit_button" type="submit" value="Save &raquo;" />
						</div>
					
					</form>
				
				</div>
				
		
		<?php elseif ($this->_tpl_vars['section'] == 'images'): ?>
				
				<ul id="update_nav">
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Details</a></li>
					<li class="on"><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/images">Images</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/thumbnail">Thumbnail</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/youtube">YouTube</a></li>
				</ul>
				
				<div id="submit_left">
				
					<h2>UPDATE PROJECT</h2>
					
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
					
					<h3>Current images...</h3>
					
					<?php if ($this->_tpl_vars['post_valid'] == false && $this->_tpl_vars['error_text'] != ''): ?> 
						
						<div id="form_validation">
							
							<ul>
								<?php echo $this->_tpl_vars['error_text']; ?>

							</ul>						
							
						</div>
						
					<?php endif; ?>
					
					
					<?php if ($this->_tpl_vars['num_images'] == 0): ?>
						<p><i>This project doesn't have any images.</i></p>
						
					<?php else: ?>
					<div id="image_edit_list">
						
						<?php $_from = $this->_tpl_vars['project_images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
							<?php if ($this->_tpl_vars['image']['image_type'] == 'full'): ?>
								<div class="img">
									<img src="inc/img.php?dimension=c143&image=<?php echo $this->_tpl_vars['image']['image_filename']; ?>
&folder=projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/" alt="" title="<?php echo $this->_tpl_vars['image']['image_filename']; ?>
"/>
									<ul id="project_tools">
										<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/image_delete/<?php echo $this->_tpl_vars['image']['image_id']; ?>
">Delete Image</a></li>
									</ul>
		 						</div>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						
						<div style="clear: both;"></div>
					</div>
					<?php endif; ?>
					
					
					<?php if ($this->_tpl_vars['num_images'] < 5): ?>
					
					<h3>Upload <?php if ($this->_tpl_vars['num_images'] > 0): ?>another<?php endif; ?> image...</h3>
					
					<form action="update/save" method="post" enctype="multipart/form-data">
						<input type="hidden" name="section" value="image_upload" />
						<input type="hidden" name="project_id" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" />
						
						<ul class="form">
							<li>
								<input type="file" name="new_image" class="text_field" />
							</li>
							<li>
								<input id="submit_button" type="submit" value="Upload Image" />
							</li>
						</ul>
						
						<p>&nbsp;</p>
					</form>
					
					<?php endif; ?>
				</div>
				
				
		<?php elseif ($this->_tpl_vars['section'] == 'image_delete'): ?>
				
				<div id="submit_left">
				
					<h2>UPDATE PROJECT</h2>
					
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
					
					<h3>Delete image...</h3>
					
					<img src="images/projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/<?php echo $this->_tpl_vars['image']['image_filename']; ?>
">
					
					<form action="update/save" method="post" enctype="multipart/form-data">
						<input type="hidden" name="section" value="image_delete" />
						<input type="hidden" name="project_id" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" />
						<input type="hidden" name="image_id" value="<?php echo $this->_tpl_vars['image']['image_id']; ?>
" />
						
						<div class="steps">
							<a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/images">Cancel</a>
							<input id="submit_button" type="submit" value="Delete image" />
						</div>
						
					</form>
					
				</div>
				
				
		<?php elseif ($this->_tpl_vars['section'] == 'thumbnail'): ?>
				
				<ul id="update_nav">
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Details</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/images">Images</a></li>
					<li class="on"><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/thumbnail">Thumbnail</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/youtube">YouTube</a></li>
				</ul>
				
				<div id="submit_left">
					
					<h2>UPDATE PROJECT</h2>
					
					<div style="min-height: 279px;">
						<p>To the right are your current project images.</p>
						<p>Please choose your most prized photograph from the list by clicking on it. The large image will be replaced by your choice and a selection box will be overlaid.</p>
						<p>You can click and drag around as well as resize the selection box using the handles in the corners.	A preview of your thumbnail appears on the left.</p>
					</div>
					
					<h2>Thumbnail preview:</h2>
					
					<div style="width: 290px; float: left; position: relative;"><div id="thumb_preview"></div></div>
					
				</div>
				
				<div id="submit_right">
					
					<h3>Select image...</h3>
					
					<div id="image_thumbnails" class="image_thumbnails" style="min-height: 250px;">
					
					<?php $_from = $this->_tpl_vars['image_thumbnails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thumbnail']):
?>
					
						<img src="inc/img.php?dimension=c143&image=<?php echo $this->_tpl_vars['thumbnail']['image_filename']; ?>
&folder=projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/" alt="" title="<?php echo $this->_tpl_vars['thumbnail']['image_filename']; ?>
" style="cursor:pointer" />
					
					<?php endforeach; endif; unset($_from); ?>
						<div style="clear:both;"></div>
					</div>
					
					<h3>Choose thumbnail area...</h3>
				
					<form action="update/save" method="post" id="thumb_form">
						<input type="hidden" name="section" value="thumbnail" />
						<input type="hidden" name="project_id" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" />
						<input type="hidden" name="thumbnail_file" id="thumbnail_file" value="<?php echo $this->_tpl_vars['first_image']['image_filename']; ?>
" />
						
						<div class="thumb_crop_container"><img id="thumb_crop" src="images/projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/<?php echo $this->_tpl_vars['first_image']['image_filename']; ?>
" alt=""/></div>
						
						<div class="steps">
							<div id="save_spinner"><img src="images/layout/loader.gif" alt="" style="vertical-align: middle;" /> &nbsp;</div>
							
							<input id="save_thumb" type="submit" value="Save &raquo;" />
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
				
				
		<?php elseif ($this->_tpl_vars['section'] == 'youtube'): ?>
				
				<div id="submit_left">
				
					<h2>UPDATE PROJECT</h2>
					
					<p>The aim of Homebuilt Hi-fi is to showcase some of the most outstanding hi-fi projects being built by dedicated enthusiasts from all over the world. Sadly, we will never be able to fully appreciate how good these components actually sound.</p>
					<p>It is for this reason that we've chosen to focus on attributes we can fully appreciate using this media - aesthetics and design. So if you have a project that not only sounds great, but has been thoughtfully designed, skillfully executed and painstakingly assembled, we would love for you to contribute to the gallery.</p>
				
				</div>
				
				<ul id="update_nav">
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Details</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/images">Images</a></li>
					<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/thumbnail">Thumbnail</a></li>
					<li class="on"><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/youtube">YouTube</a></li>
				</ul>
				
				<div id="submit_right">
				
					<h3>YouTube video...</h3>
				
					<form action="update/save" method="post">
						<input type="hidden" name="section" value="youtube" />
						<input type="hidden" name="project_id" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" />
						
						<?php if ($this->_tpl_vars['post_valid'] == false && $this->_tpl_vars['validation_text'] != ''): ?> 
						
						<div id="form_validation">
							
							<ul>
								<li><?php echo $this->_tpl_vars['validation_text']; ?>
</li>
							</ul>
							
						</div>
						
						<?php endif; ?>
						
						<p>To attach a YouTube video to your project, you need to copy-and-paste the Share URL into the field below.</p>
						
						<p>
							To get the Share URL for a video, click on the <i>Share</i> button when viewing the video.
							The URL will be shown in the text box.
							Share URLs look like <code>http://youtu.be/KbrkSeuhSxw</code>
						</p>
						
						<p>Your video will be displayed in a widescreen (16:9) format. Other sizes are supported, but they will be letterboxed.</p>
						
						<ul class="form">
						
							<li>
								<label for="project_item">Video URL:</label>
								<input type="text" name="project_youtube" id="project_youtube" class="text_field validate['required']<?php if (in_array ( 'project_item' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?>" value="<?php if (isset ( $_POST['project_youtube'] )): ?><?php echo $_POST['project_youtube']; ?>
<?php else: ?><?php echo $this->_tpl_vars['project']['project_youtube']; ?>
<?php endif; ?>" />
							</li>
						
						</ul>
						
						<div class="steps">
							<input id="submit_button" type="submit" value="Save &raquo;" />
						</div>
					
					</form>
				
				</div>
				
		<?php elseif ($this->_tpl_vars['section'] == 'invalid'): ?>
		
				<div id="submit_left">
				
					<h2>ACCESS DENIED</h2>
					
					<p>This isn't your project. You can't edit it.</p>
					
					<ul id="nextstep_links">
						<li><a href="project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Return to project</a></li>
						<li><a href="submit">Submit your own project</a></li>
					</ul>
				</div>
				
		
		<?php elseif ($this->_tpl_vars['section'] == 'confirm'): ?>
		
				<div id="submit_left">
				
					<h2>UPDATE SUCCESSFUL</h2>
					
					<p>Your project has been updated successfully.</p>
					
					<ul id="nextstep_links">
						<li><a href="project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Return to project</a></li>
						<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Continue editing</a></li>
						<li><a href="submit">Submit another project</a></li>
					</ul>
					
				</div>
				
		<?php endif; ?>
		
		