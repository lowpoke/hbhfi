<?php /* Smarty version 2.6.22, created on 2019-03-06 02:29:06
         compiled from builders.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'builders.html', 18, false),array('modifier', 'plural', 'builders.html', 60, false),)), $this); ?>
				<div id="tab_bar">
					<h1>Builders</h1>
					<ul>
						<li class="selected"><a href="builders">Builders</a></li>
					</ul>
				</div>
				
				<div class="buttons_bar">
					
					<p><?php echo $this->_tpl_vars['num_builders']; ?>
</p>
					
					<div style="position: absolute; top: 10px; right: 10px; width: 50%; text-align: right;">
						<strong>View By: </strong> &nbsp;
						
						<select onchange="<?php echo 'if(this.value != 0) { window.location = \'/admin/builders/country/\' + this.value }'; ?>
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
						
						<input type="button" value="Show All" onclick="window.location = '/admin/builders/all'" />
						<input type="button" value="Download CSV" onclick="window.location = '/admin/builders_csv'" />
					
					</div>
						
				</div>
				
				
				<div id="main">
				
					<?php echo $this->_tpl_vars['result']; ?>

				
					<table class="list" id="builders_list">
					
						<thead>
						
						<tr>
							<th>Builder</th>
							<th>Name</th>							
							<th>Country</th>
							<th>Email</th>
							<th>Projects</th>
							<th>Comments</th>
						</tr>
						
						</thead>
						
						<tbody>

<?php if ($this->_tpl_vars['num_builders'] > 0): ?>

<?php $_from = $this->_tpl_vars['builders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['builderID'] => $this->_tpl_vars['builder']):
?>
						
						<tr id="tr_<?php echo $this->_tpl_vars['builder']['builder_id']; ?>
">
							<td><strong><?php echo $this->_tpl_vars['builder']['builder_short_name']; ?>
</strong> &nbsp;</td>
							<td><?php echo $this->_tpl_vars['builder']['builder_first_name']; ?>
 <?php echo $this->_tpl_vars['builder']['builder_last_name']; ?>
 &nbsp;</td>
							<td><?php echo $this->_tpl_vars['builder']['builder_country']; ?>
 &nbsp;</td>
							<td><?php echo $this->_tpl_vars['builder']['builder_email']; ?>
 &nbsp;</td>
							<td><a href="projects/builder/<?php echo $this->_tpl_vars['builder']['builder_id']; ?>
"><?php echo $this->_tpl_vars['builder']['builder_projects']; ?>
 project<?php echo ((is_array($_tmp=$this->_tpl_vars['builder']['builder_projects'])) ? $this->_run_mod_handler('plural', true, $_tmp) : plural($_tmp)); ?>
</a> &nbsp;</td>
							<td><a href="comments/builder/<?php echo $this->_tpl_vars['builder']['builder_id']; ?>
"><?php echo $this->_tpl_vars['builder']['builder_comments']; ?>
 comment<?php echo ((is_array($_tmp=$this->_tpl_vars['builder']['builder_comments'])) ? $this->_run_mod_handler('plural', true, $_tmp) : plural($_tmp)); ?>
</a> &nbsp;</td>
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
								
				<script type="text/javascript">
								
<?php echo '
				
							
					
					
					$$(\'#builders_list .delete\').each(function(db) {
					
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
					
					
					
					
					$$(\'#builders_list .view\').each(function(vb) {
					
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
				
				