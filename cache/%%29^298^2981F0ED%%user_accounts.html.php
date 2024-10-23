<?php /* Smarty version 2.6.22, created on 2019-03-06 02:29:34
         compiled from user_accounts.html */ ?>
				<div id="tab_bar">
					<h1>User Accounts</h1>
				</div>
				
				<div class="buttons_bar">
					
					<p><?php echo $this->_tpl_vars['num_users']; ?>
</p>
					
					<ul class="right" id="new_page_btn1">
						<li><span><a href="#" class="new new_user">New User</a></span></li>
					</ul>				
				</div>
				
				
				<div id="main">
				
					<?php echo $this->_tpl_vars['result']; ?>

				
					<table class="list" id="user_list">
					
						<thead>
						
						<tr>
							<th>Username</th>
							<th style="width: 200px;">First Name</th>
							<th style="width: 200px;">Last Name</th>
							<th style="width: 200px;">Created</th>
							<th style="width: 105px;"></th>
						</tr>
						
						</thead>
						
						<tbody>
						
<?php if ($this->_tpl_vars['num_users'] > 0): ?>

	<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userID'] => $this->_tpl_vars['user']):
?>
						
						<tr id="tr_<?php echo $this->_tpl_vars['user']['ID']; ?>
">
							<td><strong><?php echo $this->_tpl_vars['user']['Username']; ?>
</strong> &nbsp;</td>
							<td><?php echo $this->_tpl_vars['user']['First_Name']; ?>
 &nbsp;</td>
							<td><?php echo $this->_tpl_vars['user']['Last_Name']; ?>
 &nbsp;</td>
							<td style="border: none;"><?php echo $this->_tpl_vars['user']['Created']; ?>
<em> by <strong><?php echo $this->_tpl_vars['user']['Created_By']; ?>
</strong></em> &nbsp;</td>
							<td style="border: none;">
								<ul class="lil_buttons">
									<li><a href="#" class="edit" rel="<?php echo $this->_tpl_vars['user']['ID']; ?>
" title="Edit '<?php echo $this->_tpl_vars['user']['Username']; ?>
'"></a></li>
									<li><a href="#" class="delete" id="db_<?php echo $this->_tpl_vars['user']['ID']; ?>
" rel="<?php echo $this->_tpl_vars['user']['ID']; ?>
" title="Delete '<?php echo $this->_tpl_vars['user']['Username']; ?>
'"></a></li>
								</ul>
							</td>
						</tr>

	<?php endforeach; endif; unset($_from); ?>		
	
<?php else: ?>

						<tr>
							<td colspan="4" style="text-align: center;">There are no users.</td>
						</tr>

<?php endif; ?>

					</tbody>
					
					</table>				
				
				
				</div>
				
				<div class="buttons_bar">
					
					<ul class="right" id="new_page_btn2">
						<li><span><a href="#" class="new new_user">New User</a></span></li>
					</ul>				

				</div>
				
				<script type="text/javascript">
								
<?php echo '
					
					$$(\'#user_list .delete\').each(function(db) {
					
						$(db).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var user_id = $(db).get(\'rel\');
							
							MochaUI.deleteUser = function(){	
								new MochaUI.Window({
									id: \'deleteUser\',
									title: \'Delete User\',
									loadMethod: \'xhr\',
									contentURL: \'inc/delete_user.php?user_ID=\' + user_id,
									width: 300,
									height: 60,
									toolbar2: true,
									type: \'modal\',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2(\'deleteUser\');
										toolbar2_button([\'ok\',\'Delete\',(\'user_accounts/delete/\' + user_id),\'\'],\'deleteUser\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'deleteUser\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'deleteUser\');
									}
								});
							}
							
							MochaUI.deleteUser();
							
						});
						
					});
					
					
					
					
					$$(\'#user_list .edit\').each(function(eb) {
					
						$(eb).addEvent(\'click\',function(e) {
							new Event(e).stop();
							var user_ID = $(eb).get(\'rel\');
							var page_URL = \'inc/edit_user.php?user_ID=\' + user_ID;
							
							MochaUI.editUser = function(){
								new MochaUI.Window({
									id: \'editUser\',
									title: \'Edit User\',
									loadMethod: \'xhr\',
									contentURL: page_URL,
									width: 300,
									height: 550,
									toolbar2: false,
									type: \'modal\',
									closable: true,
									toolbar2: true,
									onContentLoaded: function() {
										reset_toolbar2(\'editUser\');
										toolbar2_button([\'ok\',\'Save\',\'#\',function(e){ new Event(e).stop(); $(\'edit_user_post\').submit(); }],\'editUser\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'editUser\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'editUser\');
									}
								});
							}
							
							MochaUI.editUser();
							
						});
						
					});
					
				
					$$(\'a.new_user\').each(function(nu) {
					
						$(nu).addEvent(\'click\',function(e) {
							new Event(e).stop();
							
							MochaUI.newUser = function(){
								new MochaUI.Window({
									id: \'newUser\',
									title: \'New User\',
									loadMethod: \'xhr\',
									contentURL: \'inc/new_user.php\',
									width: 300,
									height: 550,
									toolbar2: false,
									type: \'modal\',
									closable: true,
									toolbar2: true,
									onContentLoaded: function() {
										reset_toolbar2(\'newUser\');
										toolbar2_button([\'ok\',\'Save\',\'#\',function(e){ new Event(e).stop(); $(\'new_user_post\').submit(); }],\'newUser\');
										toolbar2_button([\'cancel\',\'Cancel\',\'#\',function(e){ new Event(e).stop(); $(\'newUser\').destroy(); $(\'modalOverlay\').setStyle(\'opacity\', 0); }],\'newUser\');
									}
								});
							}
							
							MochaUI.newUser();
							
						});
						
					});
					
					
				
'; ?>

				
				</script>
				
				