<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<?php

		$threshhold = "";
		$date = "";

		if(isset($_GET['trh'])) {
			$threshhold = $_GET['trh'];
		}

		if(isset($_GET['date'])) {
			if($_GET['date'] == "11-11-2019") {
				$S1filename = 'S1 11-11-2019.xml';
				$S2filename = 'S2 11-11-2019.xml';
			}
			else if($_GET['date'] == "25-04-2020") {
				$S1filename = 'S1 25-04-2020.xml';
				$S2filename = 'S2 25-04-2020.xml';
			}
			else{
				echo "The date you supplied does not have records in our database.";
			}
		}
?>

<script>

var dataPointsS1 = [];
var dataPointsS2 = [];

window.onload = function() {

  var chartS1 = new CanvasJS.Chart("chartContainerS1", {
	animationEnabled: true,
	title: {
		text: "Light Share Sensor 1 (<?php echo $date. ', ' . $threshhold; ?>)"
	},
	data: [{
					type: "pie",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 20,
					indexLabel: "{label} {y}%",
					startAngle: -20,
					showInLegend: true,
					toolTipContent: "{legendText} {y}%",
					dataPoints: dataPointsS1
	      }]
  });
  console.log("before update");
  updateChart();
  
  var chartS2 = new CanvasJS.Chart("chartContainerS2", {
	animationEnabled: true,
	title: {
		text: "Light Share Sensor 2 (<?php echo $date. ', ' . $threshhold; ?>)"
	},
	data: [{
					type: "pie",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 20,
					indexLabel: "{label} {y}%",
					startAngle: -20,
					showInLegend: true,
					toolTipContent: "{legendText} {y}%",
					dataPoints: dataPointsS2
	      }]
  });
  console.log("before update");
  updateChart();

  function updateChart() {
	$.getJSON(
	"http://iotserver.com/canvasjs3.6/datafortuts/date-JSON-datapoints.php?trh=<?php echo  $_GET['trh']; ?>&date=<?php echo $_GET['date']; ?>",
	function(data) {
		dataPointsS1.length = 0;
        dataPointsS2.length = 0;
        
        for (let i = 0; i < data.length; i++){
			value = data[i];
			if (i < 2){
				dataPointsS1.push({
				  y: parseInt(value["y"]),
				  label: value["label"],
				  legendText: value["legendText"]
				});
			}
			else{
				dataPointsS2.push({
				  y: parseInt(value["y"]),
				  label: value["label"],
				  legendText: value["legendText"]
				});
			}
		}	
		
		chartS1.render();
		chartS2.render();
	});
  }	
}

</script>
</head>
<body>
<div id="chartContainerS1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<div id="chartContainerS2" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="http://iotserver.com/canvasjs3.6/canvasjs.min.js"></script>
</body>
</html>

