<?php /* Smarty version 2.6.22, created on 2019-03-06 02:29:32
         compiled from comments.html */ ?>
				<div id="tab_bar">
					<h1>Comments</h1>
					<ul>
						<li class="selected"><a href="comments">Comments</a></li>
					</ul>
				</div>
				
				<div class="buttons_bar">
					
					<p><?php echo $this->_tpl_vars['num_comments']; ?>
</p>
					
					<div style="position: absolute; top: 10px; right: 10px; width: 50%; text-align: right;">
						<strong>View By: </strong>
						
						<select onchange="<?php echo 'if(this.value != 0) { window.location = \'/admin/comments/builder/\' + this.value }'; ?>
">
							<option value="0">Builder...</option>
							<?php $_from = $this->_tpl_vars['builder_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['builderID'] => $this->_tpl_vars['builder']):
?>
							<option value="<?php echo $this->_tpl_vars['builder']['builder_id']; ?>
"<?php if ($this->_tpl_vars['view_by'] == $this->_tpl_vars['builder']['builder_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['builder']['builder_short_name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
					
						<select onchange="<?php echo 'if(this.value != 0) { window.location = \'/admin/comments/project/\' + this.value }'; ?>
">
							<option value="0">Project...</option>
							<?php $_from = $this->_tpl_vars['projects_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['projectID'] => $this->_tpl_vars['project']):
?>
							<option value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
"<?php if ($this->_tpl_vars['view_by'] == $this->_tpl_vars['project']['project_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['project']['project_name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
						
						<input type="button" value="Show All" onclick="window.location = '/admin/comments/all'" />
					
					</div>
						
				</div>
				
				
				<div id="main">
				
					<?php echo $this->_tpl_vars['result']; ?>

				
					<table class="list" id="comments_list">
					
						<thead>
						
						<tr>
							<th>Builder</th>
							<th>Project</th>							
							<th>Comment</th>
							<th style="width: 130px;">Posted</th>
							<th style="width: 105px;"></th>
						</tr>
						
						</thead>
						
						<tbody>

<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['commentID'] => $this->_tpl_vars['comment']):
?>
						
						<tr id="tr_<?php echo $this->_tpl_vars['comment']['comment_id']; ?>
">
							<td><strong><a href="comments/builder/<?php echo $this->_tpl_vars['comment']['comment_builder']; ?>
"><?php echo $this->_tpl_vars['comment']['builder_short_name']; ?>
</a></strong> &nbsp;</td>
							<td><a href="comments/project/<?php echo $this->_tpl_vars['comment']['comment_project']; ?>
"><?php echo $this->_tpl_vars['comment']['project_name']; ?>
</a> &nbsp;</td>
							<td><?php echo $this->_tpl_vars['comment']['short_comment']; ?>
 &nbsp;</td>
							<td style="border: none;"><?php echo $this->_tpl_vars['comment']['comment_posted']; ?>
 &nbsp;</td>
							<td style="border: none;">
								<ul class="lil_buttons">
									<li><a href="edit_comment/<?php echo $this->_tpl_vars['comment']['comment_id']; ?>
" class="edit" title="Edit this comment."></a></li>
									<li><a href="#" class="delete" id="db_<?php echo $this->_tpl_vars['comment']['comment_id']; ?>
" rel="<?php echo $this->_tpl_vars['comment']['comment_id']; ?>
" title="Delete this comment."></a></li>
								</ul>
							</td>
						</tr>

<?php endforeach; endif; unset($_from); ?>		

					</tbody>
					
					</table>				
				
				
				</div>
				
						
				
				<script type="text/javascript">
								
<?php echo '
				
							
					
					
					$$(\'#comments_list .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var comment_id = $(db).get(\'id\').replace(/db_/,\'\');
							
							MochaUI.deleteComment = function(){	
								new MochaUI.Window({
									id: \'deleteComment\',
									title: \'Delete Comment\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_comment.php?comment_ID=\' + comment_id,
									width: 300,
									height: 60,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'deleteComment\');
										toolbar2_button([\'ok\',\'Delete\',(\'delete_comment/\' + comment_id),\'\'],\'deleteComment\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'deleteComment\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'deleteComment\');
									}
								});
							}
							
							MochaUI.deleteComment();
							
						});
						
					});
										
				
'; ?>

				
				</script>
				
				