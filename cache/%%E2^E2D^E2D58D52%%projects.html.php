<?php /* Smarty version 2.6.22, created on 2019-03-06 02:29:10
         compiled from projects.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'projects.html', 32, false),array('modifier', 'plural', 'projects.html', 76, false),)), $this); ?>
				<div id="tab_bar">
					<h1>Projects</h1>
					<ul>
						<li class="selected"><a href="projects">Projects</a></li>
					</ul>
				</div>
				
				<div class="buttons_bar" style="position: relative;">
					
					<p><?php echo $this->_tpl_vars['num_projects']; ?>
</p>
					
					<div style="position: absolute; top: 10px; right: 10px; width: 70%; text-align: right;">
						<strong>View By: </strong> &nbsp;
						
						<select onchange="<?php echo 'if(this.value != 0) { window.location = \'/admin/projects/builder/\' + this.value }'; ?>
">
							<option value="0">Builder...</option>
							<?php $_from = $this->_tpl_vars['builder_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['builderID'] => $this->_tpl_vars['builder']):
?>
							<option value="<?php echo $this->_tpl_vars['builder']['builder_id']; ?>
"<?php if ($this->_tpl_vars['view_by'] == $this->_tpl_vars['builder']['builder_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['builder']['project_builder']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
					
						<select onchange="<?php echo 'if(this.value != 0) { window.location = \'/admin/projects/category/\' + this.value }'; ?>
">
							<option value="0">Category...</option>
							<?php $_from = $this->_tpl_vars['category_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categoryID'] => $this->_tpl_vars['category']):
?>
							<option value="<?php echo $this->_tpl_vars['category']['category_id']; ?>
"<?php if ($this->_tpl_vars['view_by'] == $this->_tpl_vars['category']['category_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['category']['category_name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
						
						<select onchange="<?php echo 'if(this.value != 0) { window.location = \'/admin/projects/country/\' + this.value }'; ?>
">
							<option value="0">Country...</option>
							<?php $_from = $this->_tpl_vars['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['countryID'] => $this->_tpl_vars['country']):
?>
							<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['country']['country'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"<?php if ($this->_tpl_vars['view_by'] == $this->_tpl_vars['country']['country']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['country']['country']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
						
						<input type="button" value="Show All" onclick="window.location = '/admin/projects/all'" />
					
					</div>
						
				</div>
				
				
				<div id="main">
				
					<?php echo $this->_tpl_vars['result']; ?>

				
					<table class="list" id="project_list">
					
						<thead>
						
						<tr>
							<th style="overflow: hidden;">Project</th>
							<th style="overflow: hidden;">Name</th>		
							<th style="width: 80px;">Category</th>							
							<th style="width: 120px;">Builder</th>							
							<th style="width: 120px;">Country</th>						
							<th style="width: 75px;">Comments</th>
							<th style="width: 70px;">Created</th>
							<th style="width: 105px;"></th>
						</tr>
						
						</thead>
						
						<tbody>

<?php if ($this->_tpl_vars['num_projects'] > 0): ?>

<?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['projectID'] => $this->_tpl_vars['project']):
?>
						
						<tr id="tr_<?php echo $this->_tpl_vars['project']['project_id']; ?>
">
							<td><strong><?php echo $this->_tpl_vars['project']['project_item']; ?>
</strong> &nbsp;</td>
							<td><?php echo $this->_tpl_vars['project']['project_name']; ?>
 &nbsp;</td>
							<td><a href="projects/category/<?php echo $this->_tpl_vars['project']['category_id']; ?>
"><?php echo $this->_tpl_vars['project']['category_name']; ?>
</a> &nbsp;</td>
							<td><a href="projects/builder/<?php echo $this->_tpl_vars['project']['builder_id']; ?>
"><?php echo $this->_tpl_vars['project']['project_builder']; ?>
</a> &nbsp;</td>
							<td><a href="projects/country/<?php echo ((is_array($_tmp=$this->_tpl_vars['project']['builder_country'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo $this->_tpl_vars['project']['builder_country']; ?>
</a> &nbsp;</td>
							<td><a href="comments/project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
"><?php echo $this->_tpl_vars['project']['project_comments']; ?>
 comment<?php echo ((is_array($_tmp=$this->_tpl_vars['project']['project_comments'])) ? $this->_run_mod_handler('plural', true, $_tmp) : plural($_tmp)); ?>
</a> &nbsp;</td>
							<td style="border: none;"><?php echo $this->_tpl_vars['project']['project_created']; ?>
 &nbsp;</td>
							<td style="border: none;">
								<ul class="lil_buttons">
									<li><a href="edit_project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
" class="edit" title="Edit '<?php echo $this->_tpl_vars['project']['project_name']; ?>
'"></a></li>
									<li><a href="#" class="delete" id="db_<?php echo $this->_tpl_vars['project']['project_id']; ?>
" rel="<?php echo $this->_tpl_vars['project']['project_name']; ?>
" title="Delete '<?php echo $this->_tpl_vars['project']['project_name']; ?>
'"></a></li>
									<li><a href="<?php echo $this->_tpl_vars['ROOT']; ?>
project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
" class="view" id="vb_<?php echo $this->_tpl_vars['project']['project_id']; ?>
" rel="<?php echo $this->_tpl_vars['project']['project_name']; ?>
" title="View '<?php echo $this->_tpl_vars['project']['project_name']; ?>
'"></a></li>
								</ul>
							</td>
						</tr>

<?php endforeach; endif; unset($_from); ?>

<?php else: ?>

						<tr id="tr_<?php echo $this->_tpl_vars['project']['project_id']; ?>
">
							<td colspan="7" style="text-align: center;"><strong>No projects found.</strong> &nbsp;</td>
						</tr>

<?php endif; ?>	

					</tbody>
					
					</table>				
				
				
				</div>
				
				<form id="save_order" action="content/pages" method="post">
				
				<div class="buttons_bar">
					
									
				</div>
				
				</form>
				
				
				<script type="text/javascript">
								
<?php echo '
				
							
					
					
					$$(\'#project_list .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var project_id = $(db).get(\'id\').replace(/db_/,\'\');
							
							MochaUI.deletePage = function(){	
								new MochaUI.Window({
									id: \'deleteProject\',
									title: \'Delete Project\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_project.php?project_ID=\' + project_id,
									width: 300,
									height: 60,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'deleteProject\');
										toolbar2_button([\'ok\',\'Delete\',(\'content/projects/delete_project/\' + project_id),\'\'],\'deleteProject\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'deleteProject\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'deleteProject\');
									}
								});
							}
							
							MochaUI.deletePage();
							
						});
						
					});
					
					
					
					
					$$(\'#project_list .view\').each(function(vb) {
					
						$(vb).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var page_name = $(vb).get(\'rel\');
							var page_id = $(vb).get(\'id\').replace(/vb_/,\'\');
							var page_URL = $(vb).get(\'href\');
							
							MochaUI.viewPageWindow = function(){
								new MochaUI.Window({
									id: \'viewPage\',
									title: \'View Page\',
									loadMethod: \'iframe\',
									contentURL: page_URL,
									width: 1100,
									height: 700,
									toolbar2: false,
									type: \'modal\',
									closable: true,
									toolbar2: true,
									onContentLoaded: function() {
										reset_toolbar2(\'viewPage\');
										toolbar2_button([\'ok\',\'Close\',\'#\',function(e){ new Event(e).stop(); $(\'viewPage\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'viewPage\');
									}
								});
							}
							
							MochaUI.viewPageWindow();
							
						});
						
					});
					
					
					

					
				
'; ?>

				
				</script>
				
				