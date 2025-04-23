<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script>
window.onload = function () {

	var curr_temp_data = [];
	var avg_temp_data = [];
	
	var chart_all = new CanvasJS.Chart("chartContainerAll", {
		title: {
			text: "Current and Average Temperature Over Time"
		},
		axisX: {
			valueFormatString: "DD-MM-YY HH:mm:ss"
		},
		axisY: [
		{
			title: "Current Temperature",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "DarkSlateBlue" ,
				tickThickness: 1
		},
		{
			title: "Average Temperature",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "Red" ,
				tickThickness: 1
		}],
		
		toolTip: {
			shared: true
		},
		legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			dockInsidePlotArea: true,
			itemclick: toogleDataSeries_all
		},

		data: [
			{
				type:"line",
				axisYType: "secondary",
				axisYIndex: 0,
				name: "Current Temperature",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: curr_temp_data
			},
			{
				type:"line",
				axisYType: "secondary",
				axisYIndex: 1,
				name: "Average Temperature",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: avg_temp_data
			}
		]
	});

	chart_all.render();
	
	function toogleDataSeries_all(e){

		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else{
			e.dataSeries.visible = true;
		}
		chart_all.render();
	}


	function addData(data) {	
		curr_temp_data = [];
		avg_temp_data = [];

		for (var i = 0; i < data.record.length; i++) {

			currentValues = data.record[i];				
			[dateValues, timeValues] = currentValues.date.toString().split(' ');
			[month, day, year] = dateValues.split('-');
			[hours, minutes, seconds] = timeValues.split(':');
			date_in = new Date(+year, +month - 1, +day, +hours, +minutes, +seconds);
			curr_temp = currentValues.ct;
			avg_temp = currentValues.at;

			curr_temp_data.push( {x: date_in, y: (curr_temp * 1.0)});
			avg_temp_data.push( {x: date_in, y: (avg_temp * 1.0)});
		}

		chart_all.options.data[0].dataPoints = curr_temp_data;
		chart_all.options.data[1].dataPoints = avg_temp_data;
		
		chart_all.render();
		setTimeout(updateData, 2000);
	}

	function updateData() {
		$.getJSON("http://iotserver.com/convertXMLtoJSON-w7.php", addData);				
	}
	
	setTimeout(updateData, 1000);
}
</script>
</head>
<body>
<div id="chartContainerAll" style="height: 370px; max-width: 1520px; margin: 0px auto;"></div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
