<?php /* Smarty version 2.6.22, created on 2024-02-02 09:02:24
         compiled from edit_comment.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'edit_comment.html', 38, false),)), $this); ?>
				<div id="tab_bar">
					<h1>Edit Comment</h1>
				</div>
				
				<div id="main">

						<form id="edit_comment" action="comments" method="post">
							<input type="hidden" name="action" value="edit_comment" />
							<input type="hidden" name="comment_id" value="<?php echo $this->_tpl_vars['comment']['comment_id']; ?>
" />
							
							<div id="page_details">
															
								<p>&nbsp;</p>
								
								<h3>Comment</h3>
								<p>
									<textarea name="comment" rows="6" id="comment" class="text_field medium_textbox"><?php echo $this->_tpl_vars['comment']['comment_comment']; ?>
</textarea>
								</p>								
															
							</div>
							
						</form>
						
						
				</div>
						
						
				<div class="buttons_bar">
					<div class="loader"></div>
					<ul class="right">
						<li><span><a href="#" class="accept submit" id="save_comment">Save</a></span></li>
						<li><span><a href="comments" class="cancel">Cancel</a></span></li>
					</ul>				
				</div>
				
				<script type="text/javascript">
				
					var root_url = '<?php echo ((is_array($_tmp=$this->_tpl_vars['ROOT'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, -1) : substr($_tmp, 0, -1)); ?>
';
				
<?php echo '
				
									
					
					$(\'save_comment\').addEvent(\'click\',function(e) {
						
						new Event(e).stop();
						$$(\'.loader\').each(function(loader) {
						
							$(loader).fade(\'in\');
														
							$(\'edit_comment\').submit();
						
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
				
				
				
				
						