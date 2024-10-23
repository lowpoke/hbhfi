<?php /* Smarty version 2.6.22, created on 2019-03-06 02:28:41
         compiled from edit_page.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'edit_page.html', 46, false),)), $this); ?>
				<div id="tab_bar">
					<h1>Edit Page</h1>
					<ul>
						<li id="show_details_li"><a href="#" id="show_details">Page Details</a></li>
						<li id="show_content_li"><a href="#" id="show_content">Page Content</a></li>
					</ul>
				</div>
				
				<div id="main">

						<form id="edit_page" action="content/pages" method="post">
							<input type="hidden" name="action" value="edit_page" />
							<input type="hidden" name="page_ID" value="<?php echo $this->_tpl_vars['page']['ID']; ?>
" />
							
							<div id="page_details" style="height: 650px;">
							
								<h3>Page Name</h3>
								<p>Enter a name for this page.</p>
								<p>
									<input type="text" name="page_name" id="page_name" class="text_field medium_textbox validate['required']" value="<?php echo $this->_tpl_vars['page']['Name']; ?>
" />
								</p>
								
								<h3>Section</h3>
								<p>
									<select name="page_section" id="page_section" class="text_field medium_textbox">
										<option value="0">None</option>
<?php $_from = $this->_tpl_vars['sections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sectionID'] => $this->_tpl_vars['section']):
?>
										<option value="<?php echo $this->_tpl_vars['section']['ID']; ?>
"<?php if ($this->_tpl_vars['page']['Section'] == $this->_tpl_vars['section']['ID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['section']['Name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>				
									</select>
								</p>
																
								<h3>Page Title</h3>
								<p>Enter the title for this page.  The page title appears in the web browsers title bar.</p>
								<p>
									<input type="text" name="page_title" id="page_title" class="text_field large_textbox" value="<?php echo $this->_tpl_vars['page']['Title']; ?>
" />
								</p>
								
								<h3>Page URL</h3>
								
								<p>Enter a URL for this page.  The URL is used to access this page from the web browser. Acceptable characters include A-Z, a-z, 0-9, underscores and spaces.</p>
								<p>
									<input type="text" name="page_url" id="page_url" class="text_field medium_textbox" value="<?php echo $this->_tpl_vars['page']['URL']; ?>
" />
									<input type="hidden" name="encoded_url" id="encoded_url" value="<?php echo $this->_tpl_vars['page']['URL']; ?>
" />
								</p>
								<p><em><strong>Sample URL: </strong><span id="sample_url"><?php echo ((is_array($_tmp=$this->_tpl_vars['ROOT'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, -1) : substr($_tmp, 0, -1)); ?>
<?php echo $this->_tpl_vars['page']['URL']; ?>
</span></em></p>
							
							</div>
							
							<div id="page_content">
							
								<?php echo $this->_tpl_vars['fck']; ?>

							
							</div>
							
						</form>
						
						
				</div>
						
						
				<div class="buttons_bar">
					<div class="loader"></div>
					<ul class="right">
						<li><span><a href="#" class="accept submit" id="save_page">Save</a></span></li>
						<li><span><a href="content/pages" class="cancel">Cancel</a></span></li>
					</ul>				
				</div>
				
				<script type="text/javascript">
				
					var root_url = '<?php echo ((is_array($_tmp=$this->_tpl_vars['ROOT'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, -1) : substr($_tmp, 0, -1)); ?>
';
				
<?php echo '
				
					var page_details = $(\'page_details\');
					var page_content = $(\'page_content\');
					
					var show_details_li = $(\'show_details_li\');
					var show_content_li = $(\'show_content_li\');
					
					page_content.setStyle(\'display\',\'none\');
					show_details_li.addClass(\'selected\');
					
					$(\'show_content\').addEvent(\'click\',function(e) {
						
						new Event(e).stop();
						page_content.setStyle(\'display\',\'\');
						page_details.setStyle(\'display\',\'none\');
						
						show_content_li.addClass(\'selected\');
						show_details_li.removeClass(\'selected\');
					
					});
					
					$(\'show_details\').addEvent(\'click\',function(e) {
						
						new Event(e).stop();
						page_content.setStyle(\'display\',\'none\');
						page_details.setStyle(\'display\',\'\');
						
						show_details_li.addClass(\'selected\');
						show_content_li.removeClass(\'selected\');
					
					});
					
					
					
					$(\'save_page\').addEvent(\'click\',function(e) {
						
						new Event(e).stop();
						$$(\'.loader\').each(function(loader) {
						
							$(loader).fade(\'in\');
														
							$(\'edit_page\').submit();
						
						});
					
					});
					
					var page_url = $(\'page_url\');
					var sample_url = $(\'sample_url\');
					
					page_url.addEvent(\'keyup\',function() {
					
						var sample = page_url.value;
						
						sample = sample.replace(/ /g,\'_\');
						sample = encodeURI(sample);
						sample = escape(sample);
						
						if(sample.substr(1,1) != \'/\')
							{
								sample = \'/\' + sample;
							}
												
						sample_url.set(\'text\',root_url + sample);
						$(\'encoded_url\').value = sample;
					
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
				
				
				
				
						