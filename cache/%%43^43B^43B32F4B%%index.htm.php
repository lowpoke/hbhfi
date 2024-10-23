<?php /* Smarty version 2.6.22, created on 2024-06-06 18:58:26
         compiled from index.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		
		<title><?php echo $this->_tpl_vars['page_title']; ?>
Homebuilt Hi-Fi - A user submitted image showcase of high quality home built hi-fi components.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="Description" content="A user-submitted image gallery that showcases some of the best DIY hi-fi projects from around the world. Our focus is on aesthetics, design and build quality." />
		<meta name="Keywords" content="diy, audio, audiophile, diy audio, hifi, hi fi, hi-fi, diy hifi, diy hi fi, diy amplifier, diy speakers, diy turntable, homebuilt, home built, homebuilt hifi, diy loudspeakers, diy amplifier, diy speakers, diy turntable, diy dac, diy preamp, diy audio cables, diy phono, diy tonearm, diy tone arm" />
		<meta name="URL" content="https://www.homebuilthifi.com/" />
		

		<base href="<?php echo $this->_tpl_vars['ROOT']; ?>
" />
		
		<style type="text/css" media="screen"> @import "css/screen_styles.css?v=3"; </style>
		
		<script type="text/javascript" src="js/mootools-1.2.2-core-more.js"></script>
		<script type="text/javascript" src="js/ondomready.js"></script>
		
		<?php if ($this->_tpl_vars['page'] == 'submit'): ?>
		<script type="text/javascript" src="js/formcheck/formcheck.js"></script>
		<script type="text/javascript" src="js/formcheck/en.js"></script>
		<link rel="stylesheet" type="text/css" href="css/formcheck/classic/formcheck.css" />
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['thumbnail_js']): ?>
		<script type="text/javascript" src="js/UvumiCrop.js"></script>
		<link rel="stylesheet" type="text/css" href="css/uvumi-crop/uvumi-crop.css" />
		<style type="text/css">
			<?php echo '
		
			#resize_coords{
				width:300px;
			}
			
			#previewExample3{
				margin:10px;
			}
	
			.yellowSelection{
				border: 2px dotted #FFB82F;
			}
	
			.blueMask{
				background-color:#00f;
				cursor:pointer;
			}
			
			'; ?>

		
		</style>
		<script type="text/javascript">
			<?php echo '
				thumbCrop = new uvumiCropper(\'thumb_crop\',{
					coordinates:false,
					keepRatio:true,
					preview:\'thumb_preview\',
					mini:{
						x:290,
						y:210
					},
					serverScriptSave: \'inc/save-thumb.php\'/*,
					onComplete: function() { alert($(\'thumbnail_file\').value); thumbCrop.cropSave({images_path: $(\'thumbnail_file\').value}); }*/
				});
				
			'; ?>

		</script>
		<?php endif; ?>
	<script data-ad-client="ca-pub-1900575144759514" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>
	
	<body>
				
<!--
		<div id="ribbon">
			<img src="images/layout/t-shirt_ribbon.png" alt="Homebuilt Hi-Fi t-shirts are now available in the store." usemap="t-shirt_ribbon" />
			<map name="t-shirt_ribbon">
				<area shape="poly" coords="5,124,126,5,133,7,145,25,28,144,6,127" href="http://www.zazzle.com/homebuilthifi" alt="Homebuilt Hi-Fi at Zazzle" title="Homebuilt Hi-Fi at Zazzle">
			</map>
		</div>
-->
		
		<div id="wrapper_outer">
			<div id="wrapper_inner">					
			
				
				<!--
<div id="user">
					<div class="user_message"><?php echo $this->_tpl_vars['submission_message']; ?>
&nbsp;</div>
					
					<?php if ($this->_tpl_vars['show_user_panel']): ?>
					<div class="user_info"> 
						<strong><?php echo $this->_tpl_vars['user_details']['builder_first_name']; ?>
 <?php echo $this->_tpl_vars['user_details']['builder_last_name']; ?>
</strong> &nbsp;|&nbsp;
						<a href="my_account">My Account</a> &nbsp;|&nbsp;
						<a href="logout">Logout</a>
					</div>
					<?php else: ?>
					<div class="user_info">
						<a href="login_register">Login</a>  |  <a href="login_register">Register</a>
					</div>
					<?php endif; ?>
				</div>
-->
					
				<div id="top">								
								
					<div id="header"><a href="<?php echo $this->_tpl_vars['ROOT']; ?>
"><img src="images/layout/Header_Logo.png" alt="" /></a> <?php echo $this->_tpl_vars['login_status']; ?>
</div>	
					
					<ul id="main_menu">
						<li><a href="vinyl" class="vinyl"<?php if ($this->_tpl_vars['project_category'] == 'vinyl'): ?> id="selected"<?php endif; ?>>Vinyl</a></li>
						<li><a href="amps" class="amps"<?php if ($this->_tpl_vars['project_category'] == 'amps'): ?> id="selected"<?php endif; ?>>Amps</a></li>
						<li><a href="speakers" class="speakers"<?php if ($this->_tpl_vars['project_category'] == 'speakers'): ?> id="selected"<?php endif; ?>>Speakers</a></li>
						<li><a href="digital" class="digital"<?php if ($this->_tpl_vars['project_category'] == 'digital'): ?> id="selected"<?php endif; ?>>Digital</a></li>
						<li><a href="analog" class="analog"<?php if ($this->_tpl_vars['project_category'] == 'analog'): ?> id="selected"<?php endif; ?>>Analogue</a></li>
						<li><a href="mods" class="mods"<?php if ($this->_tpl_vars['project_category'] == 'mods'): ?> id="selected"<?php endif; ?>>Mods</a></li>
					</ul>
					
					<?php if ($this->_tpl_vars['page'] != 'submit'): ?><a href="" id="submit_project">Submit New Project</a><?php endif; ?>
				
				</div>
				
				<div id="top_strip">
				
					<?php if ($this->_tpl_vars['page'] != 'submit'): ?>					
					<form id="search" action="search" method="post">
						<div>Search: &nbsp; <input type="text" name="q" id="search_field" value="<?php echo $this->_tpl_vars['q']; ?>
" /></div>
					</form>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['show_user_panel']): ?>
					<div class="user_info"> 
						<strong><?php echo $this->_tpl_vars['user_details']['builder_short_name']; ?>
<!-- <?php echo $this->_tpl_vars['user_details']['builder_first_name']; ?>
 <?php echo $this->_tpl_vars['user_details']['builder_last_name']; ?>
 --></strong> &nbsp;|&nbsp;
						<a href="my_account">My Account</a> &nbsp;|&nbsp;
						<a href="logout">Logout</a>  &nbsp;|&nbsp;
					</div>
					<?php else: ?>
					<div class="user_info">
						<a href="">Login</a> &nbsp;|&nbsp; <a href="">Register</a>  &nbsp;|&nbsp;
					</div>
					<?php endif; ?>
				
					<?php if ($this->_tpl_vars['page'] == 'projects'): ?>
					
					View By: &nbsp;
					<select name="view_by" id="view_by">
						<option value="most_recent"<?php if ($this->_tpl_vars['project_category'] == 'recent'): ?> selected="selected"<?php endif; ?>>Most Recent</option>
						<option value="most_popular"<?php if ($this->_tpl_vars['project_category'] == 'popular'): ?> selected="selected"<?php endif; ?>>Most Popular</option>
						<option value="builder"<?php if ($this->_tpl_vars['view_by'] == 'builder'): ?> selected="selected"<?php endif; ?>>Builder</option>
					</select>
					
					<span id="builder_list">
						<?php if ($this->_tpl_vars['show_builders_list']): ?><?php echo $this->_tpl_vars['builder_list_select']; ?>
<?php endif; ?> 
					</span>
					
					
					&nbsp;
					
					<span id="project_count"<?php if ($this->_tpl_vars['show_builders_list']): ?> style="display: none;"<?php endif; ?>>Project Count: <?php echo $this->_tpl_vars['project_count']; ?>
</span>
					
					<?php endif; ?>
				
				</div>				
				
				<div id="main">
					
		<?php if ($this->_tpl_vars['page_type'] == 'file'): ?>
							
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		<?php else: ?>
		
					<div id="main_content">
			
			<?php echo $this->_tpl_vars['page_content']; ?>

			
					</div>
		
		<?php endif; ?>	
					
				</div>
								
				<div id="footer">					
					<p>
						<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FHomebuilt-Hi-fi-A-user-submitted-image-gallery-of-DIY-hi-fi-projects%2F185105341508719%3F&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="No" frameborder="0" style="border:none; overflow:hidden; width:225px; height:21px;" allowtransparency="true"></iframe>
 </p><p>&nbsp;</p>
					<p>Copyright Homebuilt Hi-Fi &copy; 2021&nbsp;&nbsp;|&nbsp;
		                <a href="terms">Terms of Use</a> &nbsp;|&nbsp;
		                <a href="privacy">Privacy Policy</a> &nbsp;|&nbsp;
		                <a href="advertise">Advertise on Homebuilt Hi-Fi</a> &nbsp;|&nbsp; <a href="contact">Contact Us</a> &nbsp;|&nbsp; <a href="about">About Us</a> &nbsp;|&nbsp;
		                <a href="http://www.zazzle.com/homebuilthifi" class="external">Merchandise</a>
				  &nbsp;|&nbsp; <a href="index.php">Home</a></p>
              </div>
				
			
			</div>
		</div>
		
		<script type="text/javascript">
			<?php echo '
			 var _gaq = _gaq || [];
			 _gaq.push([\'_setAccount\', \'UA-10902769-1\']);
			 _gaq.push([\'_trackPageview\']);
			
			 (function() {
			   var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			   ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			   var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
			 })();
			'; ?>

		</script>

	</body>

</html>












































