		<h1>Edit Page</h1>


<?php

	$get_page_SQL = "SELECT * FROM `pages` WHERE `ID` = '".GET('page_ID',NULL)."'";
	$get_page = db_select($get_page_SQL);
	
	if($get_page['num_rows'] > 0)
		{
			$page_data = $get_page['result'][0];

?>
						<form id="edit_page" action="Content/Pages" method="post">
							<input type="hidden" name="action" value="edit_page" />
							<input type="hidden" name="page_ID" value="<?php echo $page_data['ID']; ?>" />
							
							
							<h3>Page Name</h3>
							<p>This is for your internal referencing only.</p>
							<p>
								<input type="text" name="page_name" id="page_name" class="medium_textbox" value="<?php echo $page_data['Name']; ?>" />
							</p>
							
							<h3>Page Title</h3>
							<p>This will appear as the main heading and in the browser title bar.</p>
							<p>
								<input type="text" name="page_title" id="page_title" class="large_textbox" value="<?php echo $page_data['Title']; ?>" />
							</p>
							
							<h3>Page URL</h3>
							
							<p>This is the URL you would like to appear in the address bar. Acceptable characters include A-Z, a-z, 0-9, underscores and spaces.
							<em><strong>For Example:</strong> &quot;<?php echo ROOT; ?><strong id="url_ex" style="font-weight: bolder; font-size: 14px;"><?php echo $page_data['URL']; ?></strong>&quot;.</em></p>
							<p>
								<input type="text" name="page_url" id="page_url" class="medium_textbox" value="<?php echo $page_data['URL']; ?>" onkeyup="document.getElementById('url_ex').innerHTML = document.getElementById('page_url').value;" />
							</p>
							
							<h3>Content</h3>
							
<?php

$oFCKeditor = new FCKeditor('section1_content') ;
$oFCKeditor->BasePath	= ROOT.'functions/fckeditor/' ;
$oFCKeditor->Width = $fck_width;
$oFCKeditor->Height = 800;
$oFCKeditor->ToolbarSet = 'Basic';
$oFCKeditor->Value		=  stripslashes($page_data['Content1']) ;
$oFCKeditor->Create() ;

?>
							
							<div id="admin_buttons" style="margin-top: 50px;">
								<div class="button"><a href="Pages" class="cancel">Cancel</a></div>
								<div class="button"><a href="javascript:document.getElementById('edit_page').submit();" class="save">Save</a></div>
							</div>
							
						</form>
						
<?php

		}
	else
		{

?>

						<p>The page you requested could not be found.</p>
						
<?php

		}
		
?>
