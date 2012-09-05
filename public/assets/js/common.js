$(document).ready(function() {
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
	$("#changeBtn").click(function() {
		alert("Changement de taille du canvas...");
		freqChart.setSize(600,300);
		freqChart.setViewBox(0, 0, 600, 300, true);
	});

	//Resize Window trigger
	$(window).resize(function() {
  		freqChart.setViewBox('holder','100%',400,true);
  		//alert('resize');
	});
	 
	//Ajax trigger
	var a;
	return a = $('#companies').autocomplete({
	serviceUrl: '/user/company/search'
	});

	$("abbr.timeago").timeago();
});
