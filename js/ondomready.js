
	window.addEvent('domready', function()
		{
		
			$$('a.external').each(function(link){
				link.target = "_blank";
			});
	
	
		
			// COLOUR THEME
			
			var colour_light = '#ccc';
			var colour_dark  = '#878787';
			
			
						
			//box = new MultiBox('mb', {descClassName: 'mbDesc'});
			
			
			if($chk($('main_menu')))
				{	
					var menu_buttons = $$('#main_menu li a');
				
					menu_buttons.each(function(menu_button) {
							
							if(menu_button.get('id') != 'selected')
								{
									menu_button.addEvents({
										mouseover: function() {this.morph({'background-color':colour_dark, 'margin-top':-5})},
										mouseout: function() {this.morph({'background-color':colour_light, 'margin-top':0})}
									});
								}
					});
				}
				
			if($chk($('submit_project')))
				{
					var submit_project = $('submit_project');
					submit_project.addEvents({
						mouseover: function() {this.morph({'background-color':colour_dark})},
						mouseout: function() {this.morph({'background-color':colour_light})}
					});					
				}
			
			
			if($chk($('submit_form')))
				{
					var submit_form = $('submit_form');
					var submit_button = $('submit_button');
					var save_spinner = $('save_spinner');
					
					submit_button.addEvent('click',function(e){
						save_spinner.fade('show');
						submit_button.disabled = 1;
						submit_button.set('value','Please wait...');
						submit_form.submit();
					});					
				}
				
				
				
			if($chk($('search_field')))
				{
					var search_field = $('search_field');
					var default_val = search_field.get('value');
					
					search_field.set('value','');
					search_field.setStyle('color','#000');
					search_field.setStyle('font-style','normal');
					
					/*
search_field.addEvent('focus', function() {
					
						var current_val = search_field.get('value');
						
						if(current_val == default_val)
							{
								search_field.set('value','');
								search_field.setStyle('color','#000');
								search_field.setStyle('font-style','normal');
							}
					
					});
					
					search_field.addEvent('blur', function() {
					
						var current_val = search_field.get('value');
						
						if(current_val == '' || current_val == default_val)
							{
								search_field.set('value',default_val);
								search_field.setStyle('color','#ccc');
								search_field.setStyle('font-style','italic');
							}
					
					});
*/
				}
				
				
			if($chk($('panels')))
				{
				
					var panels = $$('#panels .panel');
					
					var panel_count = 0;
					panels.each(function(panel){
						panel.set('id','panel' + panel_count);
						panel_count++;
					});
					
					panels.each(function(panel){
						var panel_class = panel.get('class').replace(/panel /,"");
						var overlay_icon = new Element('div',{'class':'overlay_icon'});
						overlay_icon.addClass(panel_class);
						overlay_icon.inject(panel,'top');
					});
					
					panels.each(function(panel){
						var panel_class = panel.get('class').replace(/panel /,"");
						var hover_overlay = new Element('div',{'class':'hover_overlay'});
						hover_overlay.addClass(panel_class);
						hover_overlay.inject(panel,'top');
						hover_overlay.fade('hide');
						
						var panel_overlay_icon = $$('#' + panel.get('id') + ' .overlay_icon');
						
						$$(panel.getElement('a')).addEvents({
							mouseover: function() {hover_overlay.fade('in'); panel_overlay_icon.fade('out');},
							mouseout: function() {hover_overlay.fade('out'); panel_overlay_icon.fade('in');}
						});
						
					});
					
					panels.setStyle('visibility','visible');
				
				
				}
				
			
			var current_panel = 0;
			var cur_panel = (current_panel + 1);
			
			
			//  My account / Builder details panels
			
			if($chk($('builder_projects')))
				{
				
					var builder_panels = $$('#builder_projects .panel');
					
					var panel_count = 0;
					builder_panels.each(function(panel){
						panel.set('id','panel' + panel_count);
						panel_count++;
					});
					
					builder_panels.each(function(panel){
						var panel_class = panel.get('class').replace(/panel /,"");
						var overlay_icon = new Element('div',{'class':'overlay_icon'});
						overlay_icon.addClass(panel_class);
						overlay_icon.inject(panel,'top');
					});
					
					builder_panels.each(function(panel){
						var panel_class = panel.get('class').replace(/panel /,"");
						var hover_overlay = new Element('div',{'class':'hover_overlay'});
						hover_overlay.addClass(panel_class);
						hover_overlay.inject(panel,'top');
						hover_overlay.fade('hide');
						
						var panel_overlay_icon = $$('#' + panel.get('id') + ' .overlay_icon');
						
						$$(panel.getElement('a')).addEvents({
							mouseover: function() {hover_overlay.fade('in'); panel_overlay_icon.fade('out');},
							mouseout: function() {hover_overlay.fade('out'); panel_overlay_icon.fade('in');}
						});
						
					});
					
					builder_panels.setStyle('visibility','visible');
				
				
				}
			
			/*
if($chk('sign_up_form'))
				{
					var sign_up = new FormCheck('sign_up_form',{
						submit : false,
						display : { scrollToFirst : false }
					});	
				}
*/
				
				
			if($chk($('submit_form')))
				{					
					var validate_submit_form = new FormCheck('submit_form',{
						submit : false,
						display : { scrollToFirst : false }
					});	
				}				
				
			
			if($chk($('save_spinner')))
				{
					var save_spinner = $('save_spinner');
					save_spinner.fade('hide');
				}
				
				
			if($chk($('terms_slider')))
				{					
					var approve_preview = $('approve_preview');
					approve_preview.disabled = 1;
					
					var accept_terms = $('accept_terms');
					
					var show_terms = $('show_terms');
					var terms_slider = new Fx.Slide('terms_conditions');
					terms_slider.hide();
					
					show_terms.addEvent('click',function(e) {
					
						new Event(e).stop();						
						terms_slider.toggle();
					
					});
					
					accept_terms.addEvent('click',function(){
					
						if(accept_terms.checked)
							{
								approve_preview.disabled = 0;
							}
						else
							{
								approve_preview.disabled = 1;
							}
					
					});
				}
				
				
				
			
			function create_builders_list(selected)
				{
					console.log('Start JSON request');
						
					var jsonRequest = new Request.JSON({url: "inc/get_builders_json.php", onSuccess: function(jsonData){
						
						console.log('Request successful');
						console.log(jsonData.builders);
						
						var select_field = new Element('select',{'id':'builder_list_select'}).inject($('builder_list'));
						var builder_list_select = $('builder_list_select');
						var default_option = new Element('option',{'value':0,'text':'Select Builder...'}).inject(builder_list_select);
						
						jsonData.builders.each(function(builder){
						
							var select_option = new Element('option',{'value':builder.builder_id,'text':builder.builder_short_name});
							select_option.inject(builder_list_select);
						});
						
						builder_list_select.addEvent('change',function(){
							window.location = 'projects/builder/' + builder_list_select.get('value');
						});
						
						$('project_count').setStyle('display','none');
						
						
					}}).send();
				}
			
				
			
			
			if($chk($('view_by')))
				{			
					$('view_by').addEvent('change',function() {
					
						var select_value = $('view_by').get('value');
										
						if($chk($('builder_list_select')) == false)
							{
								if(select_value == 'builder')
									{
										create_builders_list('');
									}
							}
							
						
						if(select_value == 'builder')
							{
								if($chk($('builder_list_select')))
									{
										$('builder_list_select').setStyle('display','');
										$('project_count').setStyle('display','none');
									}
							}
						else
							{
								if($chk($('builder_list_select')))
									{
										$('builder_list_select').setStyle('display','none');
										$('project_count').setStyle('display','');
									}
							}
							
						if(select_value == 'most_popular')
							{
								window.location = '/popular';
							}
							
						if(select_value == 'most_recent')
							{
								window.location = '/';
							}
					
					});
			}	
			
				
			if($chk($('builder_list_select')))
				{
					$('builder_list_select').addEvent('change',function(){
						window.location = 'projects/builder/' + $('builder_list_select').get('value');
					});
				}


		});
		
	

		
