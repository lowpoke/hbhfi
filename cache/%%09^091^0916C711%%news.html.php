<?php /* Smarty version 2.6.22, created on 2019-03-17 20:52:28
         compiled from news.html */ ?>
					
					<div id="main_content">
					
<?php if ($this->_tpl_vars['show_article'] == true): ?>
					
						<h1 class="main_article_headline"><?php echo $this->_tpl_vars['article']['Headline']; ?>
</h1>
						
						<div class="main_article_date">
							<strong><?php echo $this->_tpl_vars['article']['Day']; ?>
, <?php echo $this->_tpl_vars['article']['Date']; ?>
 <?php echo $this->_tpl_vars['article']['Month']; ?>
, <?php echo $this->_tpl_vars['article']['Year']; ?>
</strong> - 
							<?php echo $this->_tpl_vars['article']['Time']; ?>

						</div>
						
						<div class="article_content">
							
							<div class="article_content"><?php echo $this->_tpl_vars['article']['Content']; ?>
</div>
						
						</div>

<?php else: ?>

						<h1>Latest News</h1>
												
	<?php if ($this->_tpl_vars['show_cat']): ?>
	
			<?php if ($this->_tpl_vars['num_articles'] > 0): ?>
						<p class="num_articles">Found <strong><?php echo $this->_tpl_vars['num_articles']; ?>
</strong> article<?php echo $this->_tpl_vars['num_articles_plural']; ?>
 in <strong><?php echo $this->_tpl_vars['news_cat']['Name']; ?>
</strong></p>
			<?php else: ?>
						<p class="num_articles">No articles in <strong><?php echo $this->_tpl_vars['news_cat']['Name']; ?>
</strong></p>
			<?php endif; ?>
	
	<?php endif; ?>
						
						
	<?php $_from = $this->_tpl_vars['articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['articleID'] => $this->_tpl_vars['article']):
?>
	
						<div class="article">
						
							<h2><a href="<?php echo $this->_tpl_vars['ROOT']; ?>
news/<?php echo $this->_tpl_vars['article']['URL']; ?>
"><?php echo $this->_tpl_vars['article']['Headline']; ?>
</a></h2>
						
							<span class="article_date">
								<strong><?php echo $this->_tpl_vars['article']['Date']; ?>
 <?php echo $this->_tpl_vars['article']['Month']; ?>
, <?php echo $this->_tpl_vars['article']['Year']; ?>
</strong> - <?php echo $this->_tpl_vars['article']['Time']; ?>

							</span>
							
							<p><?php echo $this->_tpl_vars['article']['Summary']; ?>
</p>
							<p><strong><a href="<?php echo $this->_tpl_vars['ROOT']; ?>
news/<?php echo $this->_tpl_vars['article']['URL']; ?>
">Read more...</a></strong></p>
						
						</div>
	
	<?php endforeach; endif; unset($_from); ?>
	
						
						<div class="news_nav">
						<?php if ($this->_tpl_vars['show_older']): ?> 
							<a href="<?php echo $this->_tpl_vars['ROOT']; ?>
news/page/<?php echo $this->_tpl_vars['older_page']; ?>
" class="left">&laquo; Older Articles</a>
						<?php endif; ?> 
						<?php if ($this->_tpl_vars['show_newer']): ?> 
							<a href="<?php echo $this->_tpl_vars['ROOT']; ?>
news/page/<?php echo $this->_tpl_vars['newer_page']; ?>
" class="right">Newer Articles &raquo;</a>
						<?php endif; ?> 
						</div>
					
<?php endif; ?>
					
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					<div id="sidebar">

						<h3 class="news_cats">News Categories</h3>
						<div class="news_cats">
							<a href="<?php echo $this->_tpl_vars['ROOT']; ?>
news">Latest News</a><br />

<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categoryID'] => $this->_tpl_vars['category']):
?>

							<a href="<?php echo $this->_tpl_vars['ROOT']; ?>
news/category/<?php echo $this->_tpl_vars['category']['Name']; ?>
"><?php echo $this->_tpl_vars['category']['Name']; ?>
</a><br /> 

<?php endforeach; endif; unset($_from); ?> 

						</div>
						
						<h3 class="news">Latest News</h3>
						<div class="latest_news">
						
<?php $_from = $this->_tpl_vars['latest_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['latestID'] => $this->_tpl_vars['latest']):
?>
							
							<h4><?php echo $this->_tpl_vars['latest']['Headline']; ?>
</h4>
							<p>
								<?php echo $this->_tpl_vars['latest']['Summary']; ?>
<br />
								<a href="<?php echo $this->_tpl_vars['ROOT']; ?>
news/<?php echo $this->_tpl_vars['latest']['URL']; ?>
">More ...</a>
							</p>
							
<?php endforeach; endif; unset($_from); ?> 
											
						</div>					
					
					</div>