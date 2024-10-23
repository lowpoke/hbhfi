/* -----------------------------------------------------------------

	In this file:

	1. Define windows
	
		var myWindow = function(){ 
			new MochaUI.Window({
				id: 'mywindow',
				title: 'My Window',
				loadMethod: 'xhr',
				contentURL: 'pages/lipsum.html',
				width: 340,
				height: 150
			});
		}

	2. Build windows on onDomReady
	
		myWindow();
	
	3. Add link events to build future windows
	
		if ($('myWindowLink')){
			$('myWindowLink').addEvent('click', function(e) {
				new Event(e).stop();
				jsonWindows();
			});
		}

		Note: If your link is in the top menu, it opens only a single window, and you would
		like a check mark next to it when it's window is open, format the link name as follows:

		window.id + LinkCheck, e.g., mywindowLinkCheck

		Otherwise it is suggested you just use mywindowLink

	Associated HTML for link event above:

		<a id="myWindowLink" href="pages/lipsum.html">My Window</a>	


	Notes:
		If you need to add link events to links within windows you are creating, do
		it in the onContentLoaded function of the new window.


   ----------------------------------------------------------------- */

initializeWindows = function(){




	MochaUI.jsonWindows = function(){
		var url = 'data/json-windows-data.js';
		var request = new Request.JSON({
			url: url,
			method: 'get',
			onComplete: function(properties) {
				MochaUI.newWindowsFromJSON(properties.windows);
			}
		}).send();
	}	
	if ($('jsonLink')){
		$('jsonLink').addEvent('click', function(e) {
			new Event(e).stop();
			MochaUI.jsonWindows();
		});
	}
	
	MochaUI.parametricsWindow = function(){	
		new MochaUI.Window({
			id: 'parametrics',
			title: 'Window Parametrics',
			loadMethod: 'xhr',
			contentURL: 'lib/ui/plugins/parametrics/index.html',
			onContentLoaded: function(){
				if ( !MochaUI.parametricsScript == true ){
					new Request({
						url: 'lib/ui/plugins/parametrics/scripts/parametrics.js',
						method: 'get',
						onSuccess: function() {
							MochaUI.addRadiusSlider.delay(10); // Delay is for IE6
							MochaUI.addShadowSlider.delay(10); // Delay is for IE6
							MochaUI.parametricsScript = true;
						}.bind(this)
					}).send();
				}
				else {
					MochaUI.addRadiusSlider.delay(10); // Delay is for IE6
					MochaUI.addShadowSlider.delay(10); // Delay is for IE6
				}
			},
			width: 305,
			height: 110,
			x: 230,
			y: 210,
			padding: { top: 12, right: 12, bottom: 10, left: 12 },
			resizable: true,
			maximizable: true,
			contentBgColor: '#fff'/*,
			toolbar: true,
			toolbarURL: 'panel-tabs.html',
			toolbar2: true,
			toolbar2URL: 'ckbuttons.html'*/
		});
	}
	if ($('parametricsLinkCheck')){
		$('parametricsLinkCheck').addEvent('click', function(e){	
			new Event(e).stop();
			MochaUI.parametricsWindow();
		});
	}	

	MochaUI.clockWindow = function(){
		new MochaUI.Window({
			id: 'clock',
			title: 'Canvas Clock',
			addClass: 'transparent',
			loadMethod: 'xhr',
			contentURL: 'plugins/coolclock/index.html?t=' + new Date().getTime(),
			onContentLoaded: function(){
				if ( !MochaUI.clockScript == true ){
					new Request({
						url: 'plugins/coolclock/scripts/coolclock.js?t=' + new Date().getTime(),
						method: 'get',
						onSuccess: function() {
							if (Browser.Engine.trident) {
								myClockInit = function(){
									CoolClock.findAndCreateClocks();
								};
								window.addEvent('domready', function(){
									myClockInit.delay(10); // Delay is for IE
								});
								MochaUI.clockScript = true;
							}
							else {
								CoolClock.findAndCreateClocks();
							}
						}.bind(this)
					}).send();
				}
				else {
					if (Browser.Engine.trident) {
						myClockInit = function(){
							CoolClock.findAndCreateClocks();
						};
						window.addEvent('domready', function(){
							myClockInit.delay(10); // Delay is for IE
						});
						MochaUI.clockScript = true;
					}
					else {
						CoolClock.findAndCreateClocks();
					}
				}
			},
			shape: 'gauge',
			headerHeight: 30,
			width: 160,
			height: 160,
			x: 570,
			y: 140,
			padding: { top: 0, right: 0, bottom: 0, left: 0 },
			bodyBgColor: [250,250,250]
		});	
	}
	if ($('clockLinkCheck')){
		$('clockLinkCheck').addEvent('click', function(e){	
			new Event(e).stop();
			MochaUI.clockWindow();
		});
	}




	MochaUI.accordiantestWindow = function(){
		var id = 'accordiantest';
		new MochaUI.Window({
			id: id,
			title: 'Accordian',
			loadMethod: 'xhr',
			contentURL: 'pages/accordian-demo.html',
			width: 300,
			height: 200,
			scrollbars: false,
			resizable: false,
			maximizable: false,				
			padding: { top: 0, right: 0, bottom: 0, left: 0 },
			onContentLoaded: function(windowEl){
				this.windowEl = windowEl;
				var accordianDelay = function(){
					new Accordion('#' + id + ' h3.accordianToggler', "#" + id + ' div.accordianElement',{
					//	start: 'all-closed',
						opacity: false,
						alwaysHide: true,
						onActive: function(toggler, element){
								toggler.addClass('open');
						},
						onBackground: function(toggler, element){
								toggler.removeClass('open');
						},							
						onStart: function(toggler, element){
							this.windowEl.accordianResize = function(){
								MochaUI.dynamicResize($(id));
							}
							this.windowEl.accordianTimer = this.windowEl.accordianResize.periodical(10);
						}.bind(this),
						onComplete: function(){
							this.windowEl.accordianTimer = $clear(this.windowEl.accordianTimer);
							MochaUI.dynamicResize($(id)) // once more for good measure
						}.bind(this)
					}, $(id));
				}.bind(this)
				accordianDelay.delay(10, this); // Delay is a fix for IE
			}
		});
	}	
	if ($('accordiantestLinkCheck')){ 
		$('accordiantestLinkCheck').addEvent('click', function(e){	
			new Event(e).stop();
			MochaUI.accordiantestWindow();
		});
	}



	// Tools
	MochaUI.builderWindow = function(){	
		new MochaUI.Window({
			id: 'builder',
			title: 'Window Builder',
			icon: 'images/icons/page.gif',
			loadMethod: 'xhr',
			contentURL: 'plugins/windowform/',
			onContentLoaded: function(){
				if ( !MochaUI.windowformScript == true ){
					new Request({
						url: 'plugins/windowform/scripts/Window-from-form.js',
						method: 'get',
						onSuccess: function() {
							$('newWindowSubmit').addEvent('click', function(e){
								new Event(e).stop();
								new MochaUI.WindowForm();
							});
							MochaUI.windowformScript = true;
						}.bind(this)
					}).send();
				}
			},
			width: 370,
			height: 410,
			maximizable: false,
			resizable: false,
			scrollbars: false
		});
	}
	if ($('builderLinkCheck')){
		$('builderLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MochaUI.builderWindow();
		});
	}
	

	
	
	
	
	
	
	if ($('ckOpen')){
		$('ckOpen').addEvent('click', function(e){	
			new Event(e).stop();
			MochaUI.ckeditorWindow();
		});
	}
	
	
	


	// Deactivate menu header links
	$$('a.returnFalse').each(function(el){
		el.addEvent('click', function(e){
			new Event(e).stop();
		});
	});
	
	// Build windows onDomReady
	//MochaUI.parametricsWindow();
	
}

// Initialize MochaUI when the DOM is ready
window.addEvent('domready', function(){

	MochaUI.Modal = new MochaUI.Modal();
	initializeWindows();

});



// This runs when a person leaves your page.
window.addEvent('unload', function(){
	if (MochaUI) MochaUI.garbageCleanUp();
});