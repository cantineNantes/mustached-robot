$(document).ready(function() {
	//Raphaël Stuff
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
	    "stroke-width": 45,
	    arc: [boxHeight/2, boxHeight/2, 0, 100, strokeRadius]
	});

	indicatorArc.animate({
	    arc: [boxHeight/2, boxHeight/2, occupationRate, 100, strokeRadius]
	}, 1500, "<>", function(){
	    // anim complete here
	});

	//Ajax trigger
	var a;
	return a = $('#companies').autocomplete({
	serviceUrl: '/user/company/search'
	});

	$("abbr.timeago").timeago();
});
