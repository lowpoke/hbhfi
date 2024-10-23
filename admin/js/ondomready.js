
	window.addEvent('domready', function()
		{
			
			var ul_opacity = 0;
			
			$$('.list ul').each(function(lb) {
																				 
				$(lb).setStyle('opacity',ul_opacity);
			
			});
			
			$$('.list tr').each(function(tr) {
																				 
				$(tr).addEvent('mouseover',function() {				
					$$('.list ul').each(function(lb) { $(lb).setStyle('opacity',ul_opacity); });
					var ul_set = '#' + $(tr).get('id') + ' ul';				
					$$(ul_set).setStyle('opacity',1);				
				});
				
				$(tr).addEvent('mouseout',function() {
					var ul_set = '#' + $(tr).get('id') + ' ul';				
					$$(ul_set).setStyle('opacity',ul_opacity);				
				});
			
			});
			
			
			
			
			
			
			if($chk($('logout_button')))
				{
					$($('logout_button')).addEvent('click',function(e) {
							new Event(e).stop();
							
							MochaUI.logoutWarning = function(){	
								new MochaUI.Window({
									id: 'logoutWarning',
									title: 'Logout',
									loadMethod: 'xhr',
									contentURL: 'inc/logout_popup.php',
									width: 300,
									height: 60,
									toolbar2: true,
									type: 'modal',
									closable: true,
									onContentLoaded: function() {
										reset_toolbar2('logoutWarning');
										toolbar2_button(['ok','Logout','logout',''],'logoutWarning');
										toolbar2_button(['cancel','Cancel','#',function(e){ new Event(e).stop(); $('logoutWarning').destroy(); $('modalOverlay').setStyle('opacity', 0); }],'logoutWarning');
									}
								});
							}
							
							MochaUI.logoutWarning();
							
						});
				}
			
			

		});
		
	

		
