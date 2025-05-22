<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script>
	
window.onload = function () {

	var tData = [];
	
	var chart = new CanvasJS.Chart("chartContainer", {
		title: {
			text: "Temperature Over Time"
		},
		axisX: {
			valueFormatString: "DD-MM-YY HH:mm:ss"
		},
		axisY: {
			title: "Temperature",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "DarkSlateBlue" ,
				tickThickness: 1
		},
		toolTip: {
			shared: true
		},
		legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			dockInsidePlotArea: true,
			itemclick: toogleDataSeries
		},

		data: [
			{
				type:"line",
				axisYType: "secondary",
				name: "Temperature",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: tData
			}
		]
	});

	chart.render();

	function toogleDataSeries(e){

		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else{
			e.dataSeries.visible = true;
		}
		chart.render();
	}


	function addData(data) {	
		
			tData = [];

			for (var i = 0; i < data.record.length; i++) {

				currentValues = data.record[i];				
				[dateValues, timeValues] = currentValues.date.toString().split(' ');
				[month, day, year] = dateValues.split('-');
				[hours, minutes, seconds] = timeValues.split(':');
				date_in = new Date(+year, +month - 1, +day, +hours, +minutes, +seconds);
				temp = currentValues.temp;
				tData.push( {x: date_in, y: parseInt(temp)});
				// decrypted_val = -1;
				// fetch('decryptTemp.php', {
				// 	method: 'POST',
				// 	headers: {
				// 		'Content-Type': 'application/x-www-form-urlencoded'
				// 	},
				// 	body: 'h=' + encodeURIComponent(temp)
				// })
				// .then(response => response.text())
				// .then(temp_val => {
				// 	console.log("D: " + parseInt(temp_val));
				// 	tData.push( {x: date_in, y: parseInt(temp_val)});
				// });
			}
			
			chart.options.data[0].dataPoints = tData;
			console.log(chart.options);
			
			chart.render();
			setTimeout(updateData, 1000);
	}

	function updateData() {
		$.getJSON("http://iotserver.com/task2/convertXMLtoJSON_Temp.php", addData);				
	}
	
	setTimeout(updateData, 1000);
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 1520px; margin: 0px auto;"></div>

<script src="../canvasjs3.6/canvasjs.min.js"></script>
</body>
</html>
