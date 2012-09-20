$(document).ready(function() {

	//TV Screen optim stuff
	var w = screen.width;
	var h = screen.height;

	var bw = $(window).width();
	var bh = $(window).height();

	var wRatio = bw/w;
	var hRatio = bh/h;
	var ratio = (wRatio + hRatio) / 2;

	//$('body').css('zoom', ratio);

	//Raphaël Stuff
	if ($("#canvas").data("occupation")) {
		var gaugeContainer = $("#canvas");
		var occupationRate = $("#canvas").data("occupation");
		var boxWidth  = gaugeContainer.width();
		var boxHeight = boxWidth;

		var paper = new Raphael("canvas", boxWidth, boxHeight);

		paper.customAttributes.arc = function (xloc, yloc, value, total, R) {
			var alpha = 360 / total * value,
			    a = (90 - alpha) * Math.PI / 180,
			    x = xloc + R * Math.cos(a),
			    y = yloc - R * Math.sin(a),
			    path;
			if (total == value) {
			    path = [
			        ["M", xloc, yloc - R],
			        ["A", R, R, 0, 1, 1, xloc - 0.01, yloc - R]
			    ];
			} else {
			    path = [
			        ["M", xloc, yloc - R],
			        ["A", R, R, 0, +(alpha > 180), 1, x, y]
			    ];
			}
			return {
			    path: path
			};
		};

		var arcWidth = 180 - 120;
		var strokeRadius = (120 + arcWidth/2);

		var indicatorArc = paper.path().attr({
		    "stroke": "#6DDBD1",
		    "stroke-width": 50,
		    arc: [boxHeight/2, boxHeight/2, 0, 100, strokeRadius]
		});

		indicatorArc.animate({
		    arc: [boxHeight/2, boxHeight/2, occupationRate, 100, strokeRadius]
		}, 1500, "<>", function(){
		    // anim complete here
		});
	}

	//Chart freq.
	if ($("#holder").width()) {
		var w = $("#holder").width(); // you can make this dynamic so it fits as you would like
	      var freqChart = Raphael('holder', '100%', '400'); // init the raphael obj and give it a width plus height
	      freqChart.lineChart({
	         data_holder: 'data', // find the table data source by id
	         width: w, // pass in the same width
	         height: '400', // pass in the same width
	         show_area: true, // show the area
	         x_labels_step: 3, // X axis labels step
	         y_labels_count: 5, // Y axis labels count
	         mouse_coords: 'rect', // rect (uses blanket mode) | circle (pinpoints the points)
	         colors: {
	           master: '#FF8CA2' // set the line color
	         },
	         text: {
		        axis_labels: {
		            font: "12px Helvetica, Arial",
		            fill: "#666"
		        },
		        popup_line1: {
		            font: "bold 11px Helvetica, Arial",
		            fill: "#666"
		        },
		        popup_line2: {
		            font: "bold 10px Helvetica, Arial",
		            fill: "#666"
		        }
		    }
	      });
	//Resize Window trigger
	$(window).resize(function() {
  		freqChart.setViewBox('holder','100%',400,true);
  		//alert('resize');
	});
	}
	//Stats Date Picker
	//DatePicker
	if ($( '#sd_label').length > 0) {
		var dates = $( "#sd, #ed" ).datepicker({
			defaultDate: "+1w",
			numberOfMonths: 1,
			showButtonPanel: true,
			dateFormat: 'dd/mm/yy',
			showAnim: 'drop',
			onSelect: function( selectedDate ) {
				var option = this.id == "sd" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" );
				date = $.datepicker.parseDate(
				instance.settings.dateFormat ||
				$.datepicker._defaults.dateFormat,
				selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
				//window.alert($("#sd, #ed").datepicker( "getDate" ));
			}
		});
		$('#btn_date_form').click(function() {
  			$('#date_form').submit();
		});
		$('#sd_label').click(function() {
			$('#sd_label, #sd').toggle();
  			$('#sd').focus();
  			$('#btn_date_form').show();
		});
		$('#ed_label').click(function() {
			$('#ed_label, #ed').toggle();
  			$('#ed').focus();
  			$('#btn_date_form').show();
		});
		$('#date_form').submit(function() {
 			var startDate = $('#sd').val().split('/');
 			var endDate = $('#ed').val().split('/');
 			var path = startDate[2] + '-' + startDate[1] + '-' + startDate[0] + '/' + endDate[2] + '-' + endDate[1] + '-' + endDate[0] + '/';
  			path = '/admin/checkin/stats/' + path;
  			$(this).attr('action', path);
  			return true;
		});
		//$('#sd').blur(function() { $('#sd_label, #sd').toggle(); }); 
		//$('#sd').change(function() { $('#sd_label').html($(this).val()); }); 
		//$('#ed').blur(function() { $('#ed_label, #ed').toggle(); });
		//$('#ed').change(function() { $('#ed_label').html($(this).val()); }); 
	}
	//Button wait click behaviour
	/*$('[data-wait]').click(function(){
		$(this).val($(this).data('wait'));
	});*/
	 
	 //Resize Window trigger on checkin window
	if ($('#loginScreen').length > 0 || $('#addForm').length > 0) {
		$(window).bind('resize', function() {
			if (screen.height === window.outerHeight) { 
				//Enable fullscreen session variable by an ajax call, to stay in that mode during browsing.
				$('#loadingRobot').fadeIn();
				$.ajax({
					url: 'http://' + $(location).attr('host') + '/user/fullscreen/enter',
					cache: false,
					success: function(html) {
						//Switch to fullscreen css
						$('#loadingRobot').fadeOut();
						if (!$('.container-fluid').hasClass('fullScreen')) {
							$('.container-fluid').addClass('fullScreen');
							$('.btn').removeClass('btn-large').addClass('btn-giant');
						}
					},
					error: function() {
						alert('ERROR entering fullscreen :(');
					}
				});
			} else if($('.container-fluid').hasClass('fullScreen')) { 
				//Enable fullscreen session variable by an ajax call, to stay in that mode during browsing.
				$.ajax({
					url: 'http://' + $(location).attr('host') + '/user/fullscreen/exit',
					cache: false,
					success: function(html) {
						//Switch to non fullscreen css
						$('.container-fluid').removeClass('fullScreen');
						$('.btn').addClass('btn-large').removeClass('btn-giant');
					},
					error: function() {
						alert('ERROR exit fullscreen :(');
					}
				});
			}
		});
	}

	/* Pines Notify Activation
	----------------------------------*/
	if ($('#message').data()) {
		var msg = $('#message').data('msg');
		var alert = $('#message').data('alert');
		if (alert == 'success') { var title = 'Yeepa!'; } else { var title = 'Boodo :('; }
		$.pnotify({
		    title: title,
		    text: msg,
		    type: alert
		});
	}

	//Ajax trigger
	var a;
	return a = $('#companies').autocomplete({
	serviceUrl: '/user/company/search'
	});

	$("abbr.timeago").timeago();
});
