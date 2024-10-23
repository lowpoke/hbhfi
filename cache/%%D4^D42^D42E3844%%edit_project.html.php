<?php /* Smarty version 2.6.22, created on 2024-02-02 08:57:03
         compiled from edit_project.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'edit_project.html', 79, false),)), $this); ?>
				<div id="tab_bar">
					<h1>Edit Project</h1>
					<ul>
						<li class="selected"><a href="edit_project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Project</a></li>
						<li><a href="edit_project_images/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Images</a></li>
					</ul>
				</div>
				
				<div id="main">

						<form id="edit_page" action="projects" method="post">
							<input type="hidden" name="action" value="edit_project" />
							<input type="hidden" name="project_id" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" />
							
							<div id="page_details">
							
								<h3>Category</h3>
								<p>
									<select name="project_category" id="project_category" class="text_field ">
										<option value="0">None</option>
										<option value="1"<?php if ($this->_tpl_vars['project']['project_category'] == 1): ?> selected="selected"<?php endif; ?>>Vinyl</option>	
										<option value="2"<?php if ($this->_tpl_vars['project']['project_category'] == 2): ?> selected="selected"<?php endif; ?>>Amps</option>	
										<option value="3"<?php if ($this->_tpl_vars['project']['project_category'] == 3): ?> selected="selected"<?php endif; ?>>Speakers</option>	
										<option value="4"<?php if ($this->_tpl_vars['project']['project_category'] == 4): ?> selected="selected"<?php endif; ?>>Digital</option>	
										<option value="5"<?php if ($this->_tpl_vars['project']['project_category'] == 5): ?> selected="selected"<?php endif; ?>>Analog</option>	
										<option value="6"<?php if ($this->_tpl_vars['project']['project_category'] == 6): ?> selected="selected"<?php endif; ?>>Mods</option>	
									</select>
								</p>
								
								<h3>Builder</h3>
								<p>
									<select name="project_builder" id="project_builder" class="text_field ">
										<option value="0">None</option>
<?php $_from = $this->_tpl_vars['builders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['builderID'] => $this->_tpl_vars['builder']):
?> 
										<option value="<?php echo $this->_tpl_vars['builder']['builder_id']; ?>
"<?php if ($this->_tpl_vars['project']['project_builder'] == $this->_tpl_vars['builder']['builder_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['builder']['builder_short_name']; ?>
</option>	
<?php endforeach; endif; unset($_from); ?>
									</select>
								</p>

								
								<h3>Project Item</h3>
								<p>
									<input type="text" name="project_item" id="project_item" class="text_field medium_textbox" value="<?php echo $this->_tpl_vars['project']['project_item']; ?>
" />
								</p>
								
								<h3>Project Name</h3>
								<p>
									<input type="text" name="project_name" id="project_name" class="text_field medium_textbox" value="<?php echo $this->_tpl_vars['project']['project_name']; ?>
" />
								</p>
								
								<h3>Project Type</h3>
								<p>
									<input type="text" name="project_type" id="project_type" class="text_field medium_textbox" value="<?php echo $this->_tpl_vars['project']['project_type']; ?>
" />
								</p>
								
								<h3>Project Description</h3>
								<p>
									<textarea name="project_description" rows="6" id="project_description" class="text_field medium_textbox"><?php echo $this->_tpl_vars['project']['project_description']; ?>
</textarea>
								</p>								
															
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
				
				
				
				
						