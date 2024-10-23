<?php /* Smarty version 2.6.22, created on 2019-03-11 22:57:46
         compiled from my_account.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'my_account.htm', 27, false),)), $this); ?>

				<div id="builder_details">
				
					<h3>My Account</h3>
					
					<ul class="details">
						<li><em>Nickname:</em> <?php echo $this->_tpl_vars['user_details']['builder_short_name']; ?>
</li>
						<li><em>Name:</em> <?php echo $this->_tpl_vars['user_details']['builder_first_name']; ?>
 <?php echo $this->_tpl_vars['user_details']['builder_last_name']; ?>
</li>
						<li><em>Country:</em> <?php echo $this->_tpl_vars['user_details']['builder_country']; ?>
</li>
						<li><em>Email:</em> <?php echo $this->_tpl_vars['user_details']['builder_email']; ?>
</li>
						<li><em>Projects:</em> <?php echo $this->_tpl_vars['num_projects']; ?>
</li>
						<li><em>Comments:</em> <?php echo $this->_tpl_vars['num_comments']; ?>
</li>
					</ul>
					
					<!-- <a href="submit" class="edit_details">Edit My Details</a>	 -->
				
					<?php if ($this->_tpl_vars['num_comments'] > 0): ?>
					
					<div id="builder_comments">
		
						<h3>Recent Comments</h3>
					
						<?php $_from = $this->_tpl_vars['builder_comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
						
						<ul class="comment">	
							<li class="comment_builder_name"><a href="project/<?php echo $this->_tpl_vars['comment']['project_id']; ?>
"><?php echo $this->_tpl_vars['comment']['project_name']; ?>
</a></li>
							<li class="comment_posted"><?php echo ((is_array($_tmp=$this->_tpl_vars['comment']['comment_posted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %B %Y at %I:%M%p") : smarty_modifier_date_format($_tmp, "%e %B %Y at %I:%M%p")); ?>
</li>
							<li class="comment_text"><?php echo $this->_tpl_vars['comment']['comment_comment']; ?>
</li>
						</ul>
						
						<?php endforeach; endif; unset($_from); ?>
						
					</div>
					
					<?php endif; ?>
				
				</div>
				
				
				<div id="builder_projects">
					
					<h3>My Projects</h3>
					
					<?php if ($this->_tpl_vars['num_projects'] > 0): ?>
		
						<?php echo $this->_tpl_vars['projects_html']; ?>

					
					<?php else: ?>
					
					<img src="images/layout/no_projects/builder.png" alt="No Projects" class="no_projects" />
					
					<?php endif; ?>
					
				</div>