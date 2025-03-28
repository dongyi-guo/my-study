<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script>
window.onload = function () {

	var pitchData = [];
	var yawData = [];
	var rollData = [];
	
	var chart_pitch = new CanvasJS.Chart("chartContainerPitch", {
		title: {
			text: "Pitch Over Time"
		},
		axisX: {
			valueFormatString: "DD-MM-YY HH:mm:ss"
		},
		axisY: {
			title: "Pitch",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "DarkSlateBlue" ,
				tickThickness: 1
		},
		//axisY2: {
		//},
		toolTip: {
			shared: true
		},
		legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			dockInsidePlotArea: true,
			itemclick: toogleDataSeries_pitch
		},

		data: [
			{
				type:"line",
				axisYType: "secondary",
				name: "Pitch",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: pitchData
			}
		]
	});
	
	var chart_yaw = new CanvasJS.Chart("chartContainerYaw", {
		title: {
			text: "Yaw Over Time"
		},
		axisX: {
			valueFormatString: "DD-MM-YY HH:mm:ss"
		},
		axisY: {
			title: "Yaw",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "DarkSlateBlue" ,
				tickThickness: 1
		},
		//axisY2: {
		//},
		toolTip: {
			shared: true
		},
		legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			dockInsidePlotArea: true,
			itemclick: toogleDataSeries_yaw
		},

		data: [
			{
				type:"line",
				axisYType: "secondary",
				name: "Yaw",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: yawData
			}
		]
	});
	
	var chart_roll = new CanvasJS.Chart("chartContainerRoll", {
		title: {
			text: "Roll Over Time"
		},
		axisX: {
			valueFormatString: "DD-MM-YY HH:mm:ss"
		},
		axisY: {
			title: "Roll",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "DarkSlateBlue" ,
				tickThickness: 1
		},
		//axisY2: {
		//},
		toolTip: {
			shared: true
		},
		legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			dockInsidePlotArea: true,
			itemclick: toogleDataSeries_roll
		},

		data: [
			{
				type:"line",
				axisYType: "secondary",
				name: "Roll",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: rollData
			}
		]
	});
	
	var chart_all = new CanvasJS.Chart("chartContainerAll", {
		title: {
			text: "Pitch, Yaw, Roll Over Time"
		},
		axisX: {
			valueFormatString: "DD-MM-YY HH:mm:ss"
		},
		axisY: [
		{
			title: "Pitch",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "DarkSlateBlue" ,
				tickThickness: 1
		},
		{
			title: "Yaw",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "Red" ,
				tickThickness: 1
		},
		{
			title: "Roll",
			prefix: "",
			suffix: "",

				tickLength: 5,
				tickColor: "#4c566a" ,
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
				name: "Pitch",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: pitchData
			},
			{
				type:"line",
				axisYType: "secondary",
				axisYIndex: 1,
				name: "Yaw",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: yawData
			},
			{
				type:"line",
				axisYType: "secondary",
				axisYIndex: 2,
				name: "Roll",
				showInLegend: true,
				markerSize: 0,
				yValueFormatString: "#",
				dataPoints: rollData
			}
		]
	});

	chart_pitch.render();
	chart_yaw.render();
	chart_roll.render();
	chart_all.render();

	function toogleDataSeries_pitch(e){

		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else{
			e.dataSeries.visible = true;
		}
		chart_pitch.render();
	}
	
	function toogleDataSeries_yaw(e){

		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else{
			e.dataSeries.visible = true;
		}
		chart_yaw.render();
	}
	
	function toogleDataSeries_roll(e){

		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else{
			e.dataSeries.visible = true;
		}
		chart_roll.render();
	}
	
	function toogleDataSeries_all(e){

		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else{
			e.dataSeries.visible = true;
		}
		chart_all.render();
	}


	function addData(data) {	
		
			pitchData = [];
			yawData = [];
			rollData =[];
//			var tl = tempData.length;

			for (var i = 0; i < data.record.length; i++) {

				currentValues = data.record[i];				
//				console.log(currentValues.date.toString());
				[dateValues, timeValues] = currentValues.date.toString().split(' ');
				[month, day, year] = dateValues.split('-');
				[hours, minutes, seconds] = timeValues.split(':');
				date_in = new Date(+year, +month - 1, +day, +hours, +minutes, +seconds);
				ori = currentValues.orientation;
				pitch = ori.pitch;
				yaw = ori.yaw;
				roll = ori.roll;

				pitchData.push( {x: date_in, y: (pitch * 1.0)});
				yawData.push( {x: date_in, y: (yaw * 1.0)});
				rollData.push( {x: date_in, y: (roll * 1.0)});
			}

//			for(var ix = 0; ix < tl; ix++) {
//				tempData.shift();
//			}
			
			chart_pitch.options.data[0].dataPoints = pitchData;
			chart_yaw.options.data[0].dataPoints = yawData;
			chart_roll.options.data[0].dataPoints = rollData;
			chart_all.options.data[0].dataPoints = pitchData;
			chart_all.options.data[1].dataPoints = yawData;
			chart_all.options.data[2].dataPoints = rollData;
			
			chart_pitch.render();
			chart_yaw.render();
			chart_roll.render();
			chart_all.render();
			setTimeout(updateData, 2000);
	}

	function updateData() {
		$.getJSON("http://iotserver.com/convertXMLtoJSON_Ori.php", addData);				
	}
	
	setTimeout(updateData, 1000);
}
</script>
</head>
<body>
<div id="chartContainerPitch" style="height: 370px; max-width: 1520px; margin: 0px auto;"></div>
<div id="chartContainerYaw" style="height: 370px; max-width: 1520px; margin: 0px auto;"></div>
<div id="chartContainerRoll" style="height: 370px; max-width: 1520px; margin: 0px auto;"></div>
<div id="chartContainerAll" style="height: 370px; max-width: 1520px; margin: 0px auto;"></div>

<script src="../../canvasjs.min.js"></script>
</body>
</html>
