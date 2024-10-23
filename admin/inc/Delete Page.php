<?php

	$confirmed = GET('confirmed',false);
	
	$get_page_SQL = "SELECT * FROM `pages` WHERE `ID` = '".GET('page_ID',NULL)."'";
	$get_page = db_select($get_page_SQL);
	
	if($get_page['num_rows'] > 0)
		{
			$page_data = $get_page['result'][0];
			
			if($confirmed == false)
				{
?>
					<div id="confirm">
						<img src="../images/admin/messagebox_warning.png" alt="" style="float: left; vertical-align: middle; margin-right: 20px;" />
						<strong>Are you sure you want to delete &quot;<?php echo $page_data['Name']; ?>&quot;?</strong>
						<div id="admin_buttons">
							<div class="button"><a href="Content/Pages" class="cancel">Cancel</a></div>
							<div class="button"><a href="Content/Delete Page/<?php echo $page_data['ID']; ?>/Confirmed" class="delete_page">Delete</a></div>
						</div>
					</div>
<?
				}
			else
				{
					$delete_page_SQL = "DELETE FROM `pages` WHERE `ID` = '".GET('page_ID',NULL)."'";
					$delete_page = db_delete($delete_page_SQL);
					
					if($delete_page == true)
						{
							$result = result('success',"<div class=\"continue\"><a href=\"Pages\">Continue</a></div><strong><strong>'".$page_data['Name']."'</strong> deleted successfully.");
						}
					else
						{
							$result = result('fail',"<div class=\"continue\"><a href=\"Pages\">Continue</a></div><strong>'".$page_data['Name']."'</strong> could not be deleted.");
						}
?>
						<?php echo $result; ?>
						
<?php

				}
		}
	else
		{

?>

						<p>The page you requested could not be found.</p>
						
<?php

		}
		
?>
