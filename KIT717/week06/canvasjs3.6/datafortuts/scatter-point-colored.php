<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">	
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="http://iotserver.com/canvasjs3.6/canvasjs.min.js"></script>
<script>

var dataPoints = [];
var chart;

window.onload = function () {

    chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	zoomEnabled: true,
	title:{
		text: "Geo Location"
	},
	axisX: {
		title: "X"
	},
	axisY:{
		title: "Y"
	},
	data: [{
		type: "scatter",
		toolTipContent: "<b>Location </b> {x}, {y}",
		dataPoints: dataPoints
	}]
});

chart.render();

}

var k = 1;
setInterval(updateChart, 1000);

function updateChart() {
	$.getJSON("http://iotserver.com/canvasjs3.6/datafortuts/geodata.json?k=" + k, function(data) {
		
		var l = dataPoints.length;
		for (var i = 0; i < l; i++) dataPoints.shift();			

		$.each(data, function(key, value) {		
			console.log(value["color"]);	
			dataPoints.push({
			  x: parseInt(value["x"]),
			  y: parseInt(value["y"]),
			  markerColor: value["color"]
			  });
		});
		
		chart.render();
		k++;
	});
}

</script>
</head>
<body>
<div id="chartContainer" style="height: 500px; max-width: 550px; margin: 0px auto;"></div>
</body>
</html>

