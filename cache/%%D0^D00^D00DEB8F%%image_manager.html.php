<?php /* Smarty version 2.6.22, created on 2019-03-06 02:29:01
         compiled from image_manager.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'image_manager.html', 29, false),)), $this); ?>
				<div id="tab_bar">
					<h1>Image Manager</h1>
					<ul>
						<li class="selected"><a href="image_manager">Images</a></li>
						<!--<li><a href="image_manager/folders">Folders</a></li>-->
					</ul>
				</div>
				
				<div class="buttons_bar">		
				
					<p><strong><?php echo $this->_tpl_vars['num_images']; ?>
 images in</strong> "images/<?php echo $this->_tpl_vars['cur_folder']; ?>
"</p>				
					<!--<ul class="right">
						<li><span><a href="#" class="view_list icon_only"></a></span></li>
						<li><span><a href="#" class="view_thumbnails icon_only"></a></span></li>
					</ul>		-->		
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
							<a href="image_manager/<?php echo $this->_tpl_vars['folder']['name']; ?>
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
				
				<div id="right_column" class="thumbnails">
				
<?php if ($this->_tpl_vars['num_images'] > 0 && $this->_tpl_vars['cur_folder'] != ''): ?>
				
					<ul>
					
<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['imageID'] => $this->_tpl_vars['image']):
?>
					
						<li class="img" id="img_<?php echo $this->_tpl_vars['imageID']; ?>
">
							<span class="<?php echo $this->_tpl_vars['image']['orientation']; ?>
"></span>
							<img src="<?php echo $this->_tpl_vars['ROOT']; ?>
inc/img.php?dimension=<?php echo $this->_tpl_vars['image']['dimension']; ?>
<?php echo $this->_tpl_vars['image_folder']; ?>
&amp;image=<?php echo $this->_tpl_vars['image']['name']; ?>
" alt="" class="<?php echo $this->_tpl_vars['image']['orientation']; ?>
" />
							<p><?php echo $this->_tpl_vars['image']['short_name']; ?>
</p>
								<ul class="lil_buttons">
									<li style="margin-left: 15px;"><a href="#" class="info" id="ib_<?php echo $this->_tpl_vars['imageID']; ?>
" rel="<?php echo $this->_tpl_vars['cur_folder']; ?>
<?php echo $this->_tpl_vars['image']['name']; ?>
"></a></li>
									<li><a href="#" class="delete" id="db_<?php echo $this->_tpl_vars['imageID']; ?>
" rel="<?php echo $this->_tpl_vars['image']['name']; ?>
" title="Delete '<?php echo $this->_tpl_vars['image']['name']; ?>
'"></a></li>
									<li><a href="<?php echo $this->_tpl_vars['image']['img_url']; ?>
" class="zoom" id="vb_<?php echo $this->_tpl_vars['imageID']; ?>
" rel="<?php echo $this->_tpl_vars['image']['dimension_str']; ?>
" title="View '<?php echo $this->_tpl_vars['image']['name']; ?>
'"></a></li>
								</ul>
						</li>
						
<?php endforeach; endif; unset($_from); ?>

					</ul>
					
<?php elseif ($this->_tpl_vars['cur_folder'] == ''): ?>


					<p style="text-align: center; margin-top: 100px;">
						<img src="images/icons/arrow_left.png" alt="" /><br />
						Select a folder to the left
					</p>
					
<?php elseif ($this->_tpl_vars['num_images'] == 0): ?>
					
					<p style="text-align: center; margin-top: 100px;">
						<img src="images/icons/box.png" alt="" /><br />
						No images found in <strong><?php echo $this->_tpl_vars['cur_folder']; ?>
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
									title: \'Upload Image\',
									loadMethod: \'xhr\',
									contentURL: \'inc/upload_file_image.php?type=image&file_destination=\' + cur_folder,
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
									contentURL: \'inc/new_folder.php?type=image\',
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
						
						
						
						
				$$(\'li.img .info\').each(function(ib) {
					
						$(ib).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var image = $(ib).get(\'rel\');
							
							MochaUI.fileInfo = function(){	
								new MochaUI.Window({
									id: \'fileInfo\',
									title: \'Image Information\',
									loadMethod: \'xhr\',
									contentURL: \'inc/image_info.php?image=\' + image,
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
						
						
				$$(\'li.img .zoom\').each(function(vb) {
					
						$(vb).addEvent(\'click\',function(e) {
							new Event(e).stop();
							//var image_name = $(vb).get(\'rel\');
							var image_URL = $(vb).get(\'href\');
							
							var image_dimensions = $(vb).get(\'rel\').split(\'x\');
							var img_width = parseInt(image_dimensions[0]);
							var img_height = parseInt(image_dimensions[1]);
							
							//alert(img_width + \' \' + img_height);
							
							MochaUI.viewImageWindow = function(){
								new MochaUI.Window({
									id: \'viewImage\',
									title: \'View Image\',
									loadMethod: \'iframe\',
									contentURL: image_URL,
									toolbar2: false,
									width: img_width,
									height: img_height,
									type: \'modal\',
									closable: true,
									toolbar2: true,
									onContentLoaded: function() {
										reset_toolbar2(\'viewImage\');
										toolbar2_button([\'ok\',\'Close\',\'#\',function(e){ new Event(e).stop(); $(\'viewImage\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'viewImage\');
									}
								});
							}
							
							MochaUI.viewImageWindow();
							
						});
						
				});
				
				
				
				$$(\'li.img .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var file = $(db).get(\'rel\');
							
							MochaUI.deleteImage = function(){	
								new MochaUI.Window({
									id: \'deleteImage\',
									title: \'Delete Image\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_file.php?file=\' + file + \'&destination=images&folder=\' + cur_folder,
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
									contentURL: \'inc/delete_folder.php?folder=\' + del_folder + \'&destination=images\',
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
				
				
				
				
						