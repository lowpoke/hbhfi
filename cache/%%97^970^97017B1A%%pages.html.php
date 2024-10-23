<?php /* Smarty version 2.6.22, created on 2019-03-06 02:28:37
         compiled from pages.html */ ?>
				<div id="tab_bar">
					<h1>Site Content</h1>
					<ul>
					<!--	<li><a href="content/drafts">Drafts</a></li>-->
						<li class="selected"><a href="content/pages">Pages</a></li>
						<li><a href="content/sections">Sections</a></li>
					<!--	<li><a href="content/trash"<?php if ($this->_tpl_vars['trash'] > 0): ?> title="<?php echo $this->_tpl_vars['trash']; ?>
 item in trash"<?php endif; ?>><img src="images/icons/trash.png" alt="" /></a> <?php if ($this->_tpl_vars['trash'] > 0): ?><div class="badge"><?php echo $this->_tpl_vars['trash']; ?>
</div><?php endif; ?> </li>-->
					</ul>
				</div>
				
				<div class="buttons_bar">
					
					<p><?php echo $this->_tpl_vars['num_pages']; ?>
</p>
					
					<ul class="right" id="new_page_btn1">
						<li><span><a href="content/new_page" class="new">New Page</a></span></li>
					</ul>				
				</div>
				
				
				<div id="main">
				
					<?php echo $this->_tpl_vars['result']; ?>

				
					<table class="list" id="page_list">
					
						<thead>
						
						<tr>
							<th class="handle_th">&nbsp;</th>
							<th>Page</th>
							<th>Section</th>
							<th style="width: 230px;">Created</th>
							<th style="width: 105px;"></th>
						</tr>
						
						</thead>
						
						<tbody>

<?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pageID'] => $this->_tpl_vars['page']):
?>
						
						<tr id="tr_<?php echo $this->_tpl_vars['page']['ID']; ?>
">
							<td class="handle">&nbsp;</td>
							<td><strong><?php echo $this->_tpl_vars['page']['Name']; ?>
</strong> &nbsp;</td>
							<td><?php echo $this->_tpl_vars['page']['Section']; ?>
 &nbsp;</td>
							<td style="border: none;"><?php echo $this->_tpl_vars['page']['Created']; ?>
<em> by <strong><?php echo $this->_tpl_vars['page']['Created_By']; ?>
</strong></em> &nbsp;</td>
							<td style="border: none;">
								<ul class="lil_buttons">
									<li><a href="#" class="info" id="ib_<?php echo $this->_tpl_vars['page']['ID']; ?>
" rel="<?php echo $this->_tpl_vars['page']['Name']; ?>
"></a></li>
									<li><a href="content/edit_page/<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="edit" title="Edit '<?php echo $this->_tpl_vars['page']['Name']; ?>
'"></a></li>
									<li><a href="#" class="delete" id="db_<?php echo $this->_tpl_vars['page']['ID']; ?>
" rel="<?php echo $this->_tpl_vars['page']['Name']; ?>
" title="Delete '<?php echo $this->_tpl_vars['page']['Name']; ?>
'"></a></li>
									<li><a href="<?php echo $this->_tpl_vars['ROOT']; ?>
<?php echo $this->_tpl_vars['page']['viewURL']; ?>
" class="view" id="vb_<?php echo $this->_tpl_vars['page']['ID']; ?>
" rel="<?php echo $this->_tpl_vars['page']['Name']; ?>
" title="View '<?php echo $this->_tpl_vars['page']['Name']; ?>
'"></a></li>
								</ul>
							</td>
						</tr>

<?php endforeach; endif; unset($_from); ?>		

					</tbody>
					
					</table>				
				
				
				</div>
				
				<form id="save_order" action="content/pages" method="post">
				
				<div class="buttons_bar">
					
					<ul class="left" id="reorder_btn">
						<li><span><a href="#" class="re_order" id="re_order">Re-Order</a></span></li>
					</ul>
					
					<ul class="left" id="reorder_save_btn" style="visibility: hidden;">
						<li><span><a href="#" class="accept" id="re_order_save">Save Order</a></span></li>
						<li><span><a href="content/pages" class="cancel">Cancel</a></span></li>
					</ul>
					
					<ul class="right" id="new_page_btn2">
						<li><span><a href="content/new_page" class="new" id="new_page">New Page</a></span></li>
					</ul>				
				
					<input type="hidden" name="action" value="save_order" />
					<input type="hidden" name="new_order" id="new_order" value="" />
				
				</div>
				
				</form>
				
				
				<script type="text/javascript">
								
<?php echo '
				
					$$(\'#page_list .info\').each(function(ib) {
					
						$(ib).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var page_name = $(ib).get(\'rel\');
							var page_id = $(ib).get(\'id\').replace(/ib_/,\'\');
							
							MochaUI.pageInfo = function(){	
								new MochaUI.Window({
									id: \'pageInfo\',
									title: \'Page Information\',
									loadMethod: \'xhr\',
									contentURL: \'inc/page_info.php?page_ID=\' + page_id,
									width: 300,
									height: 400,
									toolbar2: true,
									type: \'modal\',
									onContentLoaded: function() {
										reset_toolbar2(\'pageInfo\');
										toolbar2_button([\'ok\',\'Close\',\'#\',function(e){ new Event(e).stop(); $(\'pageInfo\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'pageInfo\');
									}
								});
							}
							
							MochaUI.pageInfo();
							
						});
						
					});
					
					
					
					$$(\'#page_list .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var page_name = $(db).get(\'rel\');
							var page_id = $(db).get(\'id\').replace(/db_/,\'\');
							
							MochaUI.deletePage = function(){	
								new MochaUI.Window({
									id: \'deletePage\',
									title: \'Delete Page\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_page.php?page_ID=\' + page_id,
									width: 300,
									height: 60,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'deletePage\');
										toolbar2_button([\'ok\',\'Delete\',(\'content/pages/delete_page/\' + page_id),\'\'],\'deletePage\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'deletePage\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'deletePage\');
									}
								});
							}
							
							MochaUI.deletePage();
							
						});
						
					});
					
					
					
					
					$$(\'#page_list .view\').each(function(vb) {
					
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
					
					
					
				$$(\'#page_list tbody tr td.handle\').each(function(handle) {			
					$(handle).setStyle(\'display\',\'none\');			
				});
				
				$$(\'#page_list thead tr th.handle_th\').setStyle(\'display\',\'none\');
				
				
				$(\'re_order\').addEvent(\'click\',function(e){
				
					new Event(e).stop();
					
					var order = \'\';
					
					$(\'new_page_btn1\').fade(\'hide\');
					$(\'new_page_btn2\').fade(\'hide\');
												 
					$(\'reorder_btn\').fade(\'hide\');
					$(\'reorder_save_btn\').fade(\'show\'); 
						
					$$(\'#page_list tbody tr td.handle\').each(function(handle) {			
						$(handle).setStyle(\'display\',\'\');			
					});
					
					$$(\'#page_list thead tr th.handle_th\').setStyle(\'display\',\'\');
					
					var sortPages = new Sortables(\'#page_list tbody\', {
					opacity: 0.6,
					handle: \'.handle\',
					onStart: function(el){
						el.setStyle(\'color\',\'red\');
					},
					onComplete: function(el){
						order = \'\';
						var cnt = 0;
						var serial = sortPages.serialize();
						$each(serial, function() { order = order + serial[cnt].replace(/tr_/,\'\') + \':\' + cnt + \',\'; cnt++; });
						//console.log(serial)
						el.setStyle(\'color\',\'green\');
						$(\'new_order\').value = order;
					}						
					
					});
					
					$$(\'#page_list tbody tr .page_id\').each(function(page_id) {
						$(page_id).setStyle(\'background-image\',\'url(images/sort_handle.png)\');
						$(page_id).setStyle(\'text-indent\',\'-9999px\');
						$(page_id).setStyle(\'cursor\',\'move\');
					});
				
				});
				
				
				$(\'re_order_save\').addEvent(\'click\',function(e){
					new Event(e).stop();
					$(\'save_order\').submit();
				});
				
			
					
					

					
				
'; ?>

				
				</script>
				
				