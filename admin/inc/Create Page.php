
						<h1>Create Page</h1>
						
						<form id="create_page" action="Content/Pages" method="post">
							<input type="hidden" name="action" value="create_page" />
							
						
							<h3>Page Name</h3>
							<p>This is for your internal referencing only.</p>
							<p>
								<input type="text" name="page_name" id="page_name" class="medium_textbox" />
							</p>

							<h3>Page Title</h3>
							<p>This will appear as the main heading and in the browser title bar.</p>
							<p>
								<input type="text" name="page_title" id="page_title" class="large_textbox" />
							</p>
							
							<h3>Page URL</h3>
							
							<p>This is the URL you would like to appear in the address bar. Acceptable characters include A-Z, a-z, 0-9, underscores and spaces.
							<em><strong>For Example:</strong> &quot;<?php echo ROOT; ?><strong id="url_ex" style="font-weight: bolder; font-size: 14px;">Page URL</strong>&quot;.</em></p>
							<p>
								<input type="text" name="page_url" id="page_url" class="medium_textbox" onkeyup="document.getElementById('url_ex').innerHTML = escape(document.getElementById('page_url').value.replace(/ /g,'_'));" />
							</p>
							
							<h3>Content</h3>
							
<?php

$oFCKeditor = new FCKeditor('section1_content') ;
$oFCKeditor->BasePath	= ROOT.'functions/fckeditor/' ;
$oFCKeditor->Width = $fck_width;
$oFCKeditor->Height = 800;
$oFCKeditor->ToolbarSet = 'Basic';
$oFCKeditor->Value		=  '' ;
$oFCKeditor->Create() ;

?>

<!--							<h3>Menu</h3>
							
							<p><input type="checkbox" name="in_menu" value="1" /> Check this box to place a link to this page in the main menu.</p>
							<p><em>Menu items can be managed in the <strong><a href="Content/Edit Menu/1">menu editor</a></strong>.</em></p>-->
							
							<div id="admin_buttons" style="margin-top: 50px;">
								<div class="button"><a href="Pages" class="cancel">Cancel</a></div>
								<div class="button"><a href="javascript:document.getElementById('create_page').submit();" class="save">Save</a></div>
							</div>
							
						</form>
