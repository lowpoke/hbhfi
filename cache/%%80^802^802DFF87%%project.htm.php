<?php /* Smarty version 2.6.22, created on 2024-06-06 19:06:02
         compiled from project.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'project.htm', 9, false),)), $this); ?>

	<?php if ($this->_tpl_vars['project_exists']): ?>
	
	<div id="project_details">	
		
		<ul class="details">
			<li><em>Item:</em> <span><strong style="text-transform: uppercase;"><?php echo $this->_tpl_vars['project']['project_item']; ?>
</strong> &nbsp;</span></li>
			<li><em>Type:</em> <span><?php echo $this->_tpl_vars['project']['project_type']; ?>
 &nbsp;</span></li>
			<li><em>Posted:</em> <span><?php echo ((is_array($_tmp=$this->_tpl_vars['project']['project_posted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %B %Y") : smarty_modifier_date_format($_tmp, "%e %B %Y")); ?>
 &nbsp;</span></li>
			<li><em>Builder:</em> <span><a href="builder/<?php echo $this->_tpl_vars['project']['project_builder']; ?>
"><?php echo $this->_tpl_vars['project']['builder_short_name']; ?>
</a> &nbsp;</span></li>
			<li><em>Country:</em> <span><?php echo $this->_tpl_vars['project']['builder_country']; ?>
 &nbsp;</span></li>
			<li><em>Comments:</em> <span><?php echo $this->_tpl_vars['project']['project_comments']; ?>
 &nbsp;</span></li>
		</ul>
		
		<?php if ($this->_tpl_vars['owned_by_user']): ?>
		<ul id="project_tools">
			<li><a href="update/<?php echo $this->_tpl_vars['project']['project_id']; ?>
">Edit Project</a></li>
		</ul>
		<?php endif; ?>
		
		<h2><?php echo $this->_tpl_vars['project']['project_name']; ?>
</h2>
		
		<div id="project_description">
			<?php echo $this->_tpl_vars['project']['project_description']; ?>

		</div>
		
		<div id="project_comments">
		
			<h3>Comments</h3>
		
			<?php if ($this->_tpl_vars['num_comments'] > 0): ?>
			
			<?php $_from = $this->_tpl_vars['project_comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
			
			<ul class="comment">	
				<li class="comment_builder_name"><a href="builder/<?php echo $this->_tpl_vars['comment']['builder_id']; ?>
"><?php echo $this->_tpl_vars['comment']['builder_short_name']; ?>
</a></li>
				<li class="comment_posted"><?php echo ((is_array($_tmp=$this->_tpl_vars['comment']['comment_posted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %B %Y at %I:%M%p") : smarty_modifier_date_format($_tmp, "%e %B %Y at %I:%M%p")); ?>
</li>
				<li class="comment_text"><?php echo $this->_tpl_vars['comment']['comment_comment']; ?>
</li>
			</ul>
			
			<?php endforeach; endif; unset($_from); ?>
			
			<?php else: ?>
			
			<div class="no_comments">No comments. Leave your comment below.</div>
			
			<?php endif; ?>
					
		</div>
		
		<h3>Leave a Comment</h3>
		
		<form id="leave_comment" action="project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
" method="post">
		
		<?php if ($this->_tpl_vars['user_authenticated']): ?>
		
			<?php if ($this->_tpl_vars['post_comment_error']): ?>
			<div id="comment_validation">
				<ul>
					<?php $_from = $this->_tpl_vars['post_comment_errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['post_comment_err']):
?>
					<li><?php echo $this->_tpl_vars['post_comment_err']; ?>
</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['comment_posted']): ?>
			<div id="comment_posted">Your comment has been posted.</div>
			<?php endif; ?>
		
			<ul>
				<li>
					<em>Comment:</em><br />
					<textarea name="comment" class="comment_box<?php if ($this->_tpl_vars['process_comment']): ?><?php if (in_array ( 'comment' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?><?php endif; ?>" cols="50" rows="15"><?php if ($this->_tpl_vars['process_comment']): ?><?php echo $_POST['comment']; ?>
<?php endif; ?></textarea>
				</li>
				
				<li>
					<em>Please enter code shown:</em><br />
					<input type="text" name="capt_code" class="capt_code<?php if ($this->_tpl_vars['process_comment']): ?><?php if (in_array ( 'capt_code' , $this->_tpl_vars['error_fields'] )): ?> error<?php endif; ?><?php endif; ?>" /><br />
					<img src="secureimage" alt="" />
				</li>
				
				<li>
					<input type="hidden" name="builder_id" value="<?php echo $this->_tpl_vars['user_details']['builder_id']; ?>
" />
					<input type="hidden" name="action" value="post_comment" />
					<input type="submit" value="Post Comment" class="post_comment" />
				</li>
			</ul>
		
		<?php else: ?>
		
		<!-- <div class="login_to_comment">Please <strong><a href="login_register">login</a></strong> to comment.</div> -->
		
		<div class="login_to_comment">Please <strong><a href="">login</a></strong> to comment.
		
		<?php endif; ?>
		
		</form>
		
	</div>
	
	<div id="project_images">
	
	<?php if ($this->_tpl_vars['video_embed']): ?>
		<?php echo $this->_tpl_vars['video_embed']; ?>

		<div style="height: 25px;">&nbsp;</div>
	<?php endif; ?>
	
	<?php $_from = $this->_tpl_vars['project_images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
		<?php if ($this->_tpl_vars['image']['image_type'] == 'full'): ?> 
	 		<img src="images/projects/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/<?php echo $this->_tpl_vars['image']['image_filename']; ?>
" alt="" /><br /> 
		<?php endif; ?> 
	<?php endforeach; endif; unset($_from); ?> 
	
	</div>
	
	<?php else: ?>
	
	<img src="images/layout/not_found.png" alt="PAGE NOT FOUND" />
	
	<?php endif; ?>
	
	