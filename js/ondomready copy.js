
	window.addEvent('domready', function()
		{
			
			var default_ui_state = {page:1,category:'vinyl',order:'most_recent'}; // Default UI settings
			var ui_state = {};
			
		
			$$('a.external').each(function(link){
				link.target = "_blank";
			});
			
			
	
	

					function save_ui_state(page,category,order)
						{
							var saveUIstate = new Request.JSON({
							url: "inc/ui_state.php",
							async: false,
							onSuccess: function(ui,json_string)
								{
			    				ui_state = ui.state;
			    				return ui_state;
								}
							}).get({'action':'save','page':page,'category':category,'order':order});
						}
					
					var getUIstate = new Class({
					  fetch: function(){
					    
					    var ui_state;
					    
					    console.log('Fetch started...');
					    
					    new Request.JSON({
					      url: 'inc/ui_state.php',
					      method: 'get',
					      async: false,
					      onSuccess: function(ui,json_string) {
					        
					        if(ui.set == true)
										{
											this.ui_state = ui.state;
											//this.page = this.ui_state.page;
											//alert(this.page);
											//console.log(json_string);
											//console.log(this.ui_state);
										}
									else
										{
											this.ui_state = save_ui_state(default_ui_state.page,default_ui_state.category,default_ui_state.order);
											//console.log(ui_state);
										}
										
					      }.bind(this)
					    }).send();
					  }
					});		
	
			
			function get_UI_state()
				{
					var getUIstater = new getUIstate();
					getUIstater.fetch();			
					ui_state = getUIstater.ui_state;
					return ui_state;
				}
			
			ui_state = get_UI_state();
			console.log(ui_state);
			//alert(ui_state.page);
			
			//alert(getUIstate);
			
			//console.log(getUIstate.ui_state.category);
			
			//console.log('DEFAULT: ' + 'page: ' + ui_state.page + ' category: ' + ui_state.category + ' order: ' + ui_state.order);
			
			console.log('Save new settings....');
			
			save_ui_state('6','speakers','builder');
			
			ui_state = get_UI_state();
			console.log(ui_state);
			
			//getUIstate.fetch();
			//console.log('NEW: ' + 'page: ' + ui_state.page + ' category: ' + ui_state.category + ' order: ' + ui_state.order);
			
			
			
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
				
			if($chk($('search_field')))
				{
					var search_field = $('search_field');
					var default_val = search_field.get('value');
					
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
				
			/*
if($chk($('pagination')))
				{
					var pagination_links = $$('#pagination ul li a');
					
					pagination_links.each(function(pagination_link) {
					
						
								pagination_link.addEvents({
									
									click: function(e) {
									
										new Event(e).stop();
										
										var panel_slide = $('panel_slide');
										var slide_location = panel_slide.getStyle('left').replace(/px/,'');
										
										var cur_panel = parseInt($('panel_slide').get('class'));
										
										alert(cur_panel);
									
										var link_num = parseInt(pagination_link.get('text'));
										var goto = pagination_link.get('id').replace(/goto/,'');
										console.log('Clicked link #' + link_num);
										
										var num_wrappers = parseInt($('panels').get('class').replace(/nw/,''));
										
										if(goto == 'Next')
											{
												if(cur_panel < num_wrappers)
													{
														slide_right(cur_panel + 1);
													}
												cur_panel = cur_panel + 1;
											}
										else if(goto == 'Prev')
											{
												if(cur_panel > 1)
													{
														slide_left(cur_panel - 1);
													}
												cur_panel = cur_panel - 1;
											}
										else if(goto != cur_panel)
											{
												pagination_links.each(function(pag_link) { pag_link.set('class',''); });
												
												if(goto > cur_panel) // slide left
													{
														slide_left(goto);
													}
												else if(goto < cur_panel) // slide right
													{
														slide_right(goto);
													}
													
												cur_panel = goto;
												pagination_link.addClass('selected');	
											
											}
											
										function slide_left(goto)
											{
												var slide_location = panel_slide.getStyle('left').replace(/px/,'');
												var slide_to = slide_location - ((goto - 1) * 945);
												
												panel_slide.morph({'left':slide_to});	
												console.log('Slide location: ' + slide_location);
												console.log('Slide <-- left');
												console.log('Goto:' + goto);
												console.log('Slide to:' + slide_to);		
											}
											
										function slide_right(goto)
											{
												var slide_location = panel_slide.getStyle('left').replace(/px/,'');
												var slide_to = ((goto - 1) * 945);
												slide_to = slide_to - (2 * slide_to);
												
												panel_slide.morph({'left':slide_to});
												console.log('Slide location: ' + slide_location);
												console.log('Slide --> right');
												console.log('Goto: ' + goto);
												console.log('Slide to: ' + slide_to);
											}
											
										$('panel_slide').set('class',cur_panel);
									
									}
									
									
								});
					
					
					});
				}
			
			
*/
			
		
			
		$('json').addEvent('click',function(e){	
			
			new Event(e).stop();
			var panels = $('panels');
			panels.fade('hide');
			
			var jsonRequest = new Request.JSON({
				url: "inc/get_projects.php",
				onSuccess: function(projects,json_string)
					{
    				var num_wrappers = parseInt((projects.length / 6) + 1);
    				
    				var wrappers = [];
    				var panel_slide_width = 0;
    				
    				for(i=0; i<num_wrappers; i++)
    					{
    						var panels_wrapper = new Element('div');
    						panels_wrapper.addClass('panel_wrapper');
    						panels_wrapper.set('id','pw'+i);
    						panels_wrapper.setStyle('left',(i * 945));
    						
    						panels_wrapper.inject('panel_slide');
    						if(i > 0)
    							{
 			   						//panels_wrapper.fade('hide');
 			   					}
    						wrappers[i] = panels_wrapper;
    						current_panel = 0;
    						panel_slide_width = panel_slide_width + 945;
    					}
    					
    				console.log('Num wrappers: ' + num_wrappers);
    				panels.addClass('nw' + num_wrappers);
    					
    				$('panel_slide').setStyle('width',panel_slide_width);
    				
    				var panel_count = 0;
    				var project_panel = [];
    				
    				projects.each(function(project)
    					{
    						var inject_panel = 'pw' + parseInt(panel_count/6);
    					
    						project_panel[panel_count] = new Element('div');
    						project_panel[panel_count].addClass('panel');
    						project_panel[panel_count].addClass(project.category_slug);
    						project_panel[panel_count].set('id','panel'+project.project_id);
    						project_panel[panel_count].set('text',project.project_id);
    						
    						//alert(project.category_slug);
    						
    						//project_panel.inject(wrappers[panel_count]):
								//project_panel[panel_count].inject(wrappers[panel_count]);
								
								project_panel[panel_count].inject($(inject_panel));
								
    						console.log('Inject: ' + 'panel'+project.id);
    						console.log(project);
    						
    						panel_count++;
    					});
    				
    				console.log(json_string);
    				console.log('Panel count: ' + panel_count);
					}
				}).get({'limit': '', 'category': 'vinyl'});
				
				panels.fade('in');

			});
			
			
			
			

			
			
			
			
			
/*
			$('get_ui_state').addEvent('click',function(e){	
			
				new Event(e).stop();
				
				var getUIstate = new Request.JSON({
					url: "inc/ui_state.php",
					onSuccess: function(ui,json_string)
						{
	    				if(ui.set == true)
	    					{
	    						this.ui_state = ui.state;
	    						console.log(json_string);
	    					}
	    				else
	    					{
	    						this.ui_state = save_ui_state(default_ui_state.page,default_ui_state.category,default_ui_state.order);
	    						console.log(ui_state);
	    					}
	    				
						}.bind(this)
					}).send();
				console.log(this.ui_state);
				var ui_state = this.ui_state;
				alert('page: ' + ui_state.page + ' category: ' + ui_state.category + ' order: ' + ui_state.order);
			});
*/






$('get_ui_state').addEvent('click',function(e){	
			
				new Event(e).stop();
				
				$('pw0').morph({'left':-945,'opacity':0});


			});

		
		$('get_ui_state2').addEvent('click',function(e){	
			
				new Event(e).stop();
				
				$('pw0').morph({'left':0,'opacity':1});


			});

		});
		
	

		
