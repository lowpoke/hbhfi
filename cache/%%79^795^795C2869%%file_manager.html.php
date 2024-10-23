<?php /* Smarty version 2.6.22, created on 2024-02-02 08:56:31
         compiled from file_manager.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'file_manager.html', 29, false),)), $this); ?>
				<div id="tab_bar">
					<h1>File Manager</h1>
					<ul>
						<li class="selected"><a href="file_manager">Files</a></li>
					</ul>
				</div>
				
				<div class="buttons_bar">		
				
				<?php if ($this->_tpl_vars['show_contents'] == true): ?>
				
					<p><strong><?php echo $this->_tpl_vars['num_files']; ?>
 files in</strong> "files/<?php echo $this->_tpl_vars['cur_folder']; ?>
"</p>
					
				<?php endif; ?>
					
				</div>
				
				<?php echo $this->_tpl_vars['result']; ?>

				
				<div id="left_column">
				
					<h2>Folders</h2>
					
					<ul>
					
<?php $_from = $this->_tpl_vars['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['folderID'] => $this->_tpl_vars['folder']):
?>
					
						<li id="folder_<?php echo $this->_tpl_vars['folderID']; ?>
">
							<a href="file_manager/<?php echo $this->_tpl_vars['folder']['name']; ?>
" class="folder"<?php if (((is_array($_tmp=$this->_tpl_vars['cur_folder'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, -1) : substr($_tmp, 0, -1)) == $this->_tpl_vars['folder']['name']): ?> style="font-weight: bold;"<?php endif; ?>><?php echo $this->_tpl_vars['folder']['name']; ?>
</a>
							<ul class="lil_buttons">
								<li><a href="#" class="delete" rel="<?php echo $this->_tpl_vars['folder']['name']; ?>
" title="Delete '<?php echo $this->_tpl_vars['folder']['name']; ?>
'"></a></li>
							</ul>
						</li>
						
<?php endforeach; endif; unset($_from); ?>
					
					</ul>
				
				</div>
				
				<div id="right_column">
				
	<?php if ($this->_tpl_vars['num_files'] > 0 && $this->_tpl_vars['cur_folder'] != ''): ?>					
					
					<table class="list" id="files_list">
					
						<thead>
						
						<tr>
							<th style="width: 250px;">File</th>
							<th style="width: 70px;">Size</th>
							<th style="width: 230px;">Type</th>
							<th></th>
						</tr>
						
						</thead>
					
						<tbody>

		<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fileID'] => $this->_tpl_vars['file']):
?>

						
						<tr id="tr_<?php echo $this->_tpl_vars['fileID']; ?>
">
							<td>
								<img src="images/file_types/<?php echo $this->_tpl_vars['file']['icon']; ?>
" alt="<?php echo $this->_tpl_vars['file']['type']; ?>
" style="vertical-align: middle; float: left;" /> &nbsp; 
								<strong><?php echo $this->_tpl_vars['file']['short_name']; ?>
</strong> &nbsp;
							</td>
							<td><?php echo $this->_tpl_vars['file']['size']; ?>
 &nbsp;</td>
							<td style="border: none;"><?php echo $this->_tpl_vars['file']['type']; ?>
 &nbsp;</td>
							<td style="border: none;">
								<ul class="lil_buttons">
									<li style="margin-left: 15px;"><a href="#" class="info" id="ib_<?php echo $this->_tpl_vars['fileID']; ?>
" rel="<?php echo $this->_tpl_vars['file']['name']; ?>
"></a></li>
									<li><a href="#" class="delete" id="db_<?php echo $this->_tpl_vars['fileID']; ?>
" rel="<?php echo $this->_tpl_vars['file']['name']; ?>
" title="Delete '<?php echo $this->_tpl_vars['file']['name']; ?>
'"></a></li>
									<li><a href="<?php echo $this->_tpl_vars['ROOT']; ?>
files/<?php echo $this->_tpl_vars['cur_folder']; ?>
<?php echo $this->_tpl_vars['file']['name']; ?>
" class="view" id="vb_<?php echo $this->_tpl_vars['fileID']; ?>
" title="View '<?php echo $this->_tpl_vars['file']['name']; ?>
'"></a></li>
								</ul>
							</td>
						</tr>
						
		<?php endforeach; endif; unset($_from); ?>
		
					</tbody>
					
					</table>		
					
					
					
<?php elseif ($this->_tpl_vars['cur_folder'] == ''): ?>


					<p style="text-align: center; margin-top: 100px;">
						<img src="images/icons/arrow_left.png" alt="" /><br />
						Select a folder to the left
					</p>
					
<?php elseif ($this->_tpl_vars['num_files'] == 0): ?>
					
					<p style="text-align: center; margin-top: 100px;">
						<img src="images/icons/box.png" alt="" /><br />
						No files found in <strong><?php echo $this->_tpl_vars['cur_folder']; ?>
</strong>.
					</p>
					
<?php endif; ?>
					
					
				</div>
						
						
				<div class="buttons_bar">
					<div class="loader"></div>					
					<ul class="left">
						<li><span><a href="#" class="new" id="new_folder">New Folder</a></span></li>
					</ul>						
					<ul class="right">
						<li><span><a href="#" class="upload" id="upload">Upload</a></span></li>
					</ul>				
				</div>
				
				<script type="text/javascript">
				
					var root_url = '<?php echo ((is_array($_tmp=$this->_tpl_vars['ROOT'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, -1) : substr($_tmp, 0, -1)); ?>
';
					var cur_folder = '<?php echo $this->_tpl_vars['cur_folder']; ?>
';
				
<?php echo '
				
					
					$$(\'li.img .lil_buttons\').each(function(lb) {
						$(lb).fade(\'hide\');					
					});
					
					$$(\'li.img\').each(function(li) {
						
						$(li).addEvent(\'mouseover\',function() {										
							var ul = \'#\' + $(li).get(\'id\');							
							$$(ul + \' ul\').fade(\'in\');
							$$(ul + \' p\').fade(\'out\');					
						});				
						
						$(li).addEvent(\'mouseout\',function() {										
							var ul = \'#\' + $(li).get(\'id\');							
							$$(ul + \' ul\').fade(\'out\');		
							$$(ul + \' p\').fade(\'in\');							
						});		
										
					});
					
					
					$$(\'#left_column .lil_buttons\').each(function(lc) {
						$(lc).fade(\'hide\');					
					});
					
					$$(\'#left_column li\').each(function(lci) {
						
						$(lci).addEvent(\'mouseover\',function() {										
							var ul = \'#\' + $(lci).get(\'id\');							
							$$(ul + \' ul\').fade(\'show\');				
						});				
						
						$(lci).addEvent(\'mouseout\',function() {										
							var ul = \'#\' + $(lci).get(\'id\');							
							$$(ul + \' ul\').fade(\'hide\');					
						});		
										
					});

					
					
					
					$($(\'upload\')).addEvent(\'click\',function(e) {
							new Event(e).stop();
							
							MochaUI.uploadWindow = function(){	
								new MochaUI.Window({
									id: \'uploadWindow\',
									title: \'Upload File\',
									loadMethod: \'xhr\',
									contentURL: \'inc/upload_file_image.php?type=file&file_destination=\' + cur_folder,
									width: 330,
									height: 140,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'uploadWindow\');
										toolbar2_button([\'ok\',\'Upload\',\'#\',function(e){ new Event(e).stop(); $(\'upload_form\').submit(); }],\'uploadWindow\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'uploadWindow\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'uploadWindow\');
									}
								});
							}
							
							MochaUI.uploadWindow();
							
						});
						
				$($(\'new_folder\')).addEvent(\'click\',function(e) {
							new Event(e).stop();
							
							MochaUI.newFolderWindow = function(){	
								new MochaUI.Window({
									id: \'newFolder\',
									title: \'New Folder\',
									loadMethod: \'xhr\',
									contentURL: \'inc/new_folder.php?type=file\',
									width: 300,
									height: 120,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'newFolder\');
										toolbar2_button([\'ok\',\'Create\',\'#\',function(e){ new Event(e).stop(); $(\'new_folder_post\').submit(); }],\'newFolder\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'newFolder\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'newFolder\');
									}
								});
							}
							
							MochaUI.newFolderWindow();
							
						});
						
						
						
						
				$$(\'$files_list .info\').each(function(ib) {
					
						$(ib).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var file_data = $(ib).get(\'rel\');
							
							var file = [];
							
							file[\'name\'] = file_data;
							file[\'folder\'] = cur_folder;
														
							MochaUI.fileInfo = function(){	
								new MochaUI.Window({
									id: \'fileInfo\',
									title: \'File Information\',
									loadMethod: \'xhr\',
									contentURL: \'inc/file_info.php?file=\' + file[\'name\'] + \'&folder=\' + file[\'folder\'],
									width: 300,
									height: 400,
									toolbar2: true,
									type: \'modal\',
									onContentLoaded: function() {
										reset_toolbar2(\'fileInfo\');
										toolbar2_button([\'ok\',\'Close\',\'#\',function(e){ new Event(e).stop(); $(\'fileInfo\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'fileInfo\');
									}
								});
							}
							
							MochaUI.fileInfo();
							
						});
						
					});
						
				
				$$(\'#files_list .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var file = $(db).get(\'rel\');
							
							MochaUI.deleteImage = function(){	
								new MochaUI.Window({
									id: \'deleteImage\',
									title: \'Delete Image\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_file.php?file=\' + file + \'&destination=files&folder=\' + cur_folder,
									width: 300,
									height: 60,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'deleteImage\');
										toolbar2_button([\'ok\',\'Delete\',\'#\',function(e){ new Event(e).stop(); $(\'delete_file_post\').submit(); }],\'deleteImage\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'deleteImage\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'deleteImage\');
									}
								});
							}
							
							MochaUI.deleteImage();
							
						});
						
					});
					
					
					
					
					$$(\'#left_column .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var del_folder = $(db).get(\'rel\');
							
							MochaUI.deleteFolder = function(){	
								new MochaUI.Window({
									id: \'deleteFolder\',
									title: \'Delete Folder\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_folder.php?folder=\' + del_folder + \'&destination=files\',
									width: 300,
									height: 60,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'deleteFolder\');
										toolbar2_button([\'ok\',\'Delete\',\'#\',function(e){ new Event(e).stop(); $(\'delete_folder_post\').submit(); }],\'deleteFolder\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'deleteFolder\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'deleteFolder\');
									}
								});
							}
							
							MochaUI.deleteFolder();
							
						});
						
					});


					
					
'; ?>

				
				</script>
				
				
				
				
						