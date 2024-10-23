
	function reset_toolbar()
		{
			$('mainPanel_panelFooter').set('text','');
			
			var toolbar_UL = new Element('ul',{'id' : 'mainPanel_panelFooter_ul'});
			toolbar_UL.inject($('mainPanel_panelFooter'));
		}
		
	
	function toolbar_button(button)
		{
			var button_li = new Element('li');
			var button_a = new Element('a', {'id' : (button[0] + '_link'), 'class' : button[0], 'href' : button[2], 'html' : button[1]});
			
			if(typeof(button[3]) == 'function')
				{
					button_a.addEvent('click',button[3]);
				}
				
			button_a.inject(button_li);
			button_li.inject($('mainPanel_panelFooter_ul'));
		}
		
		
		
		
	function reset_toolbar2(window_id)
		{
			var toolbar_id = window_id + '_toolbar2Wrapper';
			
			$(toolbar_id).set('text','');
			
			var toolbar_UL = new Element('ul',{'id' : (window_id + '_panelFooter_ul')});
			toolbar_UL.inject($(toolbar_id));
		}
		
	
	function toolbar2_button(button,window_id)
		{
			var toolbar_id = window_id + '_panelFooter_ul';
			
			var button_li = new Element('li');
			var button_a = new Element('a', {'id' : (button[0] + '_link'), 'class' : button[0], 'href' : button[2], 'html' : button[1]});
			
			if(typeof(button[3]) == 'function')
				{
					button_a.addEvent('click',button[3]);
				}
				
			button_a.inject(button_li);
			button_li.inject($(toolbar_id));
		}


