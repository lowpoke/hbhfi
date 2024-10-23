<?php /* Smarty version 2.6.22, created on 2024-02-02 08:57:07
         compiled from edit_project_images.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'edit_project_images.html', 63, false),)), $this); ?>
				<div id="tab_bar">
					<h1>Edit Project</h1>
					<ul>
						<li><a href="edit_project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Project</a></li>
						<li class="selected"><a href="edit_project_images/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Images</a></li>
					</ul>
				</div>
				
				<div id="main">

						<form id="edit_page" action="edit_project_images/<?php echo $this->_tpl_vars['project']['project_id']; ?>
" method="post">
							<input type="hidden" name="action" value="edit_project" />
							<input type="hidden" name="project_ID" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" />
							
							<div id="page_details">
															
								<h3>Project Images</h3>
								
								<table class="images_list">
								
									<tr>
										<th style="width: 100px;">Image</th>
										<th>Filename</th>
										<th>Options</th>
									</tr>

									<tr>
										<td style="height: 110px;"><img src="../inc/img.php?dimension=c100&amp;folder=projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
&amp;image=<?php echo $this->_tpl_vars['thumbnail']['image_filename']; ?>
" alt="" /></td>
										<td><strong>Thumbnail:</strong> <?php echo $this->_tpl_vars['thumbnail']['image_filename']; ?>
</td>
										<td style="text-align: right; border-right: none;">&nbsp;</td>
									</tr>
								
<?php $_from = $this->_tpl_vars['full_images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fullID'] => $this->_tpl_vars['image']):
?>

									<tr>
										<td style="height: 110px;"><img src="../inc/img.php?dimension=c100&amp;folder=projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
&amp;image=<?php echo $this->_tpl_vars['image']['image_filename']; ?>
" alt="" /></td>
										<td><?php echo $this->_tpl_vars['image']['image_filename']; ?>
</td>
										<td style="text-align: right; border-right: none;"><?php echo $this->_tpl_vars['image']['original_link']; ?>
</td>
									</tr>

<?php endforeach; endif; unset($_from); ?>
	
								</table>
																							
							</div>
							
						</form>
						
						
				</div>
						
						
				<div class="buttons_bar">
					<div class="loader"></div>
					<ul class="right">
						<li><span><a href="#" class="accept submit" id="save_page">Save</a></span></li>
						<li><span><a href="projects" class="cancel">Cancel</a></span></li>
					</ul>				
				</div>
				
				<script type="text/javascript">
				
					var root_url = '<?php echo ((is_array($_tmp=$this->_tpl_vars['ROOT'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, -1) : substr($_tmp, 0, -1)); ?>
';
				
<?php echo '
				
									
					
					$(\'save_page\').addEvent(\'click\',function(e) {
						
						new Event(e).stop();
						$$(\'.loader\').each(function(loader) {
						
							$(loader).fade(\'in\');
														
							$(\'edit_page\').submit();
						
						});
					
					});
									
					
					$$(\'.text_field\').each(function(tf) {
					
						$(tf).addEvent(\'focus\',function() {
							$(tf).addClass(\'focus\');
						});
						
						$(tf).addEvent(\'blur\',function() {
							$(tf).removeClass(\'focus\');
						});
					
					});
					
					
'; ?>

				
				</script>
				
				
				
				
						