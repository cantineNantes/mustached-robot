$(document).ready(function() {

	//Kicking ass custom slider function brought by jwSlider v1 - http://www.jeffrey-way.com
	$.fn.jwSlider = function(options) {

		// set default options
		var defaults = {
			speed : 1000,
			pause : 2000,
			transition : 'fade'
		},

		// Take the options that the user selects, and merge them with defaults.
		options = $.extend(defaults, options);
		
		// Needed to fix a tiny bug. If the pause is less than speed, it'll cause a flickr.
		// This will check for that, and if it is smaller, it increases it to just about the options.speed.
		if(options.pause <= options.speed) options.pause = options.speed + 100;
	
		// for each item in the wrapped set
		return this.each(function() {
		
			// cache "this."
			var $this = $(this);
			
			// Wrap "this" in a div with a class of "slider-wrap."
			$this.wrap('<div class="slider-wrap" />');
			
			// Set the width to a really high number. Adjusting the "left" css values, so need to set positioning.
			$this.css({
				'width' : '99999px',
				'position' : 'relative',
				'padding' : 0
			});

			// If the user chose the "slide" transition...
			if(options.transition === 'slide') {
				$this.children().css({
					'float' : 'left',
					'list-style' : 'none'
				});
				
				$('.slider-wrap').css({
					'width' : $this.children().width(),
					'overflow' : 'hidden'
				});				
			}
			
			// If the user chose the "fade" transition, instead pile all of the images on top of each other.
			if(options.transition === 'fade') {
				$this.children().css({
					'width' : $this.children().width(),
					'position' : 'absolute',
					'left' : 0
				});
				
				// reorder elements to fix z-index issue.
				
				for(var i = $this.children().length, y = 0; i > 0; i--, y++) { 		
					$this.children().eq(y).css('zIndex', i + 99999);
				}	

				// Call the fade function. 
				fade();
			}
			
			// If the user instead chose the "slide" transition, call the slide function.
			if(options.transition === 'slide') slide();	
			
			
			function slide() {
				var timerInterval = setInterval(function() {
					// Animate to the left the width of the image/div
					$this.animate({'left' : '-' + $this.parent().width()}, options.speed, function() {
						// Return the "left" CSS back to 0, and append the first child to the very end of the list.
						$this
						   .css('left', 0)
						   .children(':first')
						   .appendTo($this); // move it to the end of the line.
					})
				}, options.pause);
			} // end slide

			function fade() {
				var timerInterval = setInterval(function() {
					$this.children(':first').animate({'opacity' : 0}, options.speed, function() {	
						$this
						   .children(':first')
						   .css('opacity', 1) // Return opacity back to 1 for next time.
						   .css('zIndex', $this.children(':last').css('zIndex') - 1) // Reduces zIndex by 1 so that it's no longer on top.					
						   .appendTo($this); // move it to the end of the line.
					})
				}, options.pause);
			} // end fade			

		}); // end each		
	
	} // End plugin. Go eat cake.

	//Reset function for #screenContent
	function onFullScreenChange() {
		/*//Replacing all setInterval methods launched by slider
		window.oldSetInterval = window.setInterval;
		window.setInterval = function(func, interval) {
		    var interval = oldSetInterval(func, interval);
		    clearInterval(interval);
		}*/
		//Unwrap our container from dirty slider divS and empty it
		$('#screenContent').unwrap();
		$('#screenContent').html('');
	}

	//document.addEventListener('mozfullscreenchange', onFullScreenChange);
	//document.addEventListener('webkitfullscreenchange', onFullScreenChange);

	//Launch TV Mode button trigger
	$('#goScreenMode').click(function(e){
		//Clear timer and previous hypothetic loaded data in #screenContent
		if (typeof timerInterval != 'undefined') {
			clearInterval(timerInterval);
		}
		//Unwrap our container from dirty slider divS and empty it
		//$('#screenContent').unwrap();
		$('#fullScreenContainer').html('<div id="screenContent" class="row-fluid"></div>');
			//replaceWith('<div id="screenContent" class="row-fluid"></div>');
		//$('#screenContent').html('');
		//Switch in html5 fullscreen mode
		$('#screenContent').fullScreen();
		e.preventDefault();
		//Load the tv modules in our fullscreen containers
		var modulesToLoad = $(this).data('toload');
		var screenString = '';
		for (i = 0; i < modulesToLoad.length; i++) {
			//Create a .screen container for each module
			$('#screenContent').html($('#screenContent').html() + '<div id="screen'+ i + '" class="screen span12"></div>');
			//Fill the .screen container with module data
			$.ajax({
				url: modulesToLoad[i],
				cache: false,
				iAsync: i,
				success: function(html) {
					$('#screen' + this.iAsync).html(html);
					//alert('We successfuly loaded ' + modulesToLoad[this.iAsync] + ' in #screen' + this.iAsync);
					//Launch the slider when the last .screen container is loaded
					if ((this.iAsync+1) == modulesToLoad.length) {
						//timerInterval = setInterval('$("'+ screenString + '").fadeToggle(1000);',5000);
						$('#screenContent').jwSlider({
							speed : 2500,
							pause : 3000
						});
					}
					i = this.iAsync;
				},
				error: function() {
					alert('ERROR loading ' + modulesToLoad[this.iAsync] + ' in #screen' + this.iAsync);
				}
			});
			if (screenString != '') {
				screenString = screenString + ', #screen' + i;
			} else { screenString = '#screen' + i; }
		} //end FOR loop
	});
});