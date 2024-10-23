<?php /* Smarty version 2.6.22, created on 2019-03-06 02:29:44
         compiled from sections.html */ ?>
				<div id="tab_bar">
					<h1>Site Content</h1>
					<ul>
					<!--	<li><a href="content/drafts">Drafts</a></li>-->
						<li><a href="content/pages">Pages</a></li>
						<li class="selected"><a href="content/sections">Sections</a></li>
					</ul>
				</div>
				
				<div class="buttons_bar">
					
					<p><?php echo $this->_tpl_vars['num_sections']; ?>
</p>
					
					<ul class="right">
						<li><span><a href="content/new_section" class="new">New Section</a></span></li>
					</ul>				
				</div>
				
				
				<div id="main">
				
					<?php echo $this->_tpl_vars['result']; ?>

				
					<table class="list" id="section_list">
					
						<tr>
							<th style="width: 15px;">&nbsp;</th>
							<th>Section</th>
							<th>Default Page</th>
							<th style="width: 200px;">Created</th>
							<th style="width: 55px;"></th>
						</tr>

<?php $_from = $this->_tpl_vars['sections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sectionID'] => $this->_tpl_vars['section']):
?>
						
						<tr id="tr_<?php echo $this->_tpl_vars['section']['ID']; ?>
">
							<td><?php echo $this->_tpl_vars['section']['ID']; ?>
</td>
							<td><strong><?php echo $this->_tpl_vars['section']['Name']; ?>
</strong> &nbsp;</td>
							<td><?php echo $this->_tpl_vars['section']['Default_Page']; ?>
 &nbsp;</td>
							<td style="border: none;"><?php echo $this->_tpl_vars['section']['Created']; ?>
<em> by <strong><?php echo $this->_tpl_vars['section']['Created_By']; ?>
</strong></em> &nbsp;</td>
							<td style="border: none;">
								<ul class="lil_buttons">
									<li><a href="content/edit_section/<?php echo $this->_tpl_vars['section']['ID']; ?>
" class="edit" title="Edit '<?php echo $this->_tpl_vars['section']['Name']; ?>
'"></a></li>
									<li><a href="#" class="delete" id="db_<?php echo $this->_tpl_vars['section']['ID']; ?>
" rel="<?php echo $this->_tpl_vars['section']['Name']; ?>
" title="Delete '<?php echo $this->_tpl_vars['section']['Name']; ?>
'"></a></li>
								</ul>
							</td>
						</tr>

<?php endforeach; endif; unset($_from); ?>		
					
					</table>				
				
				
				</div>
				
				<div class="buttons_bar">
					<ul class="right">
						<li><span><a href="content/new_section" class="new" id="new_page">New Section</a></span></li>
					</ul>				
				</div>
				
				
				<script type="text/javascript">
								
<?php echo '
				
					
					$$(\'#section_list .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var section_name = $(db).get(\'rel\');
							var section_id = $(db).get(\'id\').replace(/db_/,\'\');
							
							MochaUI.deleteSection = function(){	
								new MochaUI.Window({
									id: \'deleteSection\',
									title: \'Delete Section\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_section.php?section_ID=\' + section_id,
									width: 300,
									height: 60,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'deleteSection\');
										toolbar2_button([\'ok\',\'Delete\',(\'content/sections/delete_section/\' + section_id),\'\'],\'deleteSection\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'deleteSection\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'deleteSection\');
									}
								});
							}
							
							MochaUI.deleteSection();
							
						});
						
					});
					
				
'; ?>

				
				</script>
				
				