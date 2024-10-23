<?php /* Smarty version 2.6.22, created on 2019-03-06 02:04:00
         compiled from projects.htm */ ?>

				<div id="panels">
					
					<?php if ($this->_tpl_vars['num_projects'] > 0): ?>
					
					<div id="panel_slide" class="1">
		
						<?php echo $this->_tpl_vars['projects_html']; ?>

					
					</div>
					
					<?php else: ?>
					
						<?php if ($this->_tpl_vars['mode'] == 'search'): ?>
						
							<div id="main_content">
			
								<p>&nbsp;</p>
								<p>&nbsp;</p>
                                
								
								<p>Your search for <strong><?php echo $this->_tpl_vars['q']; ?>
</strong> returned no results.</p>
								
							</div><p>&nbsp;</p>
						
						<?php else: ?>
						
							<div id="no_projects" class="<?php echo $this->_tpl_vars['project_category']; ?>
"></div>	
						
						<?php endif; ?>
					
					<?php endif; ?>
					
				</div>
                					
				<?php if ($this->_tpl_vars['show_pagination']): ?>
				
				<div id="pagination">
					<ul>
						<?php if ($this->_tpl_vars['pagination_prev']['show']): ?><li><a href="<?php echo $this->_tpl_vars['project_category']; ?>
/page/<?php echo $this->_tpl_vars['pagination_prev']['page']; ?>
">&laquo;</a></li><?php endif; ?>
						
						<?php $_from = $this->_tpl_vars['pagination_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pagination']):
?>
						
						<li><a href="<?php echo $this->_tpl_vars['project_category']; ?>
/page/<?php echo $this->_tpl_vars['pagination']['page']; ?>
"<?php if ($this->_tpl_vars['pagination']['selected']): ?> class="selected"<?php endif; ?>><?php echo $this->_tpl_vars['pagination']['page']; ?>
</a></li>
						
						<?php endforeach; endif; unset($_from); ?>
						
						<?php if ($this->_tpl_vars['pagination_next']['show']): ?><li><a href="<?php echo $this->_tpl_vars['project_category']; ?>
/page/<?php echo $this->_tpl_vars['pagination_next']['page']; ?>
">&raquo;</a></li><?php endif; ?>
					</ul>
				</div>
       				
				<?php endif; ?>

				<?php echo ' 	
				<div id="leaderboard" class="advert">									
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- Leaderboard -->
							<ins class="adsbygoogle"
								 style="display:inline-block;width:728px;height:90px"
								 data-ad-client="ca-pub-1900575144759514"
								 data-ad-slot="9520346982"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
								
				</div>
				'; ?>
		