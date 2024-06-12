@extends('logged.layout')
 
@section('title', 'Dashboard')
 
@section('content')
	<div class="card">
  		<div class="card-body my-4">
    		<h5 class="card-title">Trading Market Summary</h5>
    		<div class='row'>
        		<div class="col-sm-12 col-md-6 my-4" id="curve_chart"></div>
        		<div class="col-sm-12 col-md-6 my-4" id="piechart"></div>
    		</div>
  		</div>
	</div>
	<div class="card my-4">
  		<div class="card-body">
    		<h5 class="card-title">System Summary</h5>
    		<div class='row'>
        		<div class="col-sm-12 col-md-6 my-4" id="curve_chart2"></div>
        		<div class="col-sm-12 col-md-6 my-4" id="columnchart_values"></div>
    		</div>
  		</div>
	</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawLineChart);
      google.charts.setOnLoadCallback(drawPieChart);
      google.charts.setOnLoadCallback(drawLineChart2);
      google.charts.setOnLoadCallback(drawColumnChart);

      function drawLineChart() {
      	var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
          	if(objXMLHttpRequest.readyState === 4) {
               	if(objXMLHttpRequest.status === 200) {
                   	const jsonObj = JSON.parse(objXMLHttpRequest.responseText);
                	const dateList = jsonObj.dateList;
                	const windList = jsonObj.windList;
                	const solarList = jsonObj.solarList;
                	
                	var data = google.visualization.arrayToDataTable([
          				['Day', 'Solar', 'Wind'],
          				[dateList[0].substring(0, 10), windList[0], solarList[0]],
          				[dateList[1].substring(0, 10), windList[1], solarList[1]],
          				[dateList[2].substring(0, 10), windList[2], solarList[2]],
          				[dateList[3].substring(0, 10), windList[3], solarList[3]],
          				[dateList[4].substring(0, 10), windList[4], solarList[4]]
        				]);

        			var options = {
          				title: 'Market Price',
          				curveType: 'function',
          				legend: { position: 'bottom' }
        				};

        			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        			chart.draw(data, options);
               	}
           	}
        }

        objXMLHttpRequest.open('GET', 'GetHomeTransactionDetails/');
      	objXMLHttpRequest.send();
      }

      function drawPieChart() {      
      	var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
          	if(objXMLHttpRequest.readyState === 4) {
               	if(objXMLHttpRequest.status === 200) {
                   	const jsonObj = JSON.parse(objXMLHttpRequest.responseText);
                	const wind = jsonObj.wind;
                	const solar = jsonObj.solar;
                
                	var data = google.visualization.arrayToDataTable([
          				['Product', 'Market Share'],
          				['Solar Buy & Sell', solar],
          				['Wind Buy & Sell', wind]
        			]);

        			var options = {
          				title: 'Wind vs Solar (Buy & Sell)'
        			};

        			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        			chart.draw(data, options);
               	}
           	}
        }

        objXMLHttpRequest.open('GET', 'GetHomeTradingSummary/');
      	objXMLHttpRequest.send();
      }

      function drawLineChart2() {
        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
          	if(objXMLHttpRequest.readyState === 4) {
               	if(objXMLHttpRequest.status === 200) {
                   	const jsonObj = JSON.parse(objXMLHttpRequest.responseText);
                	const dateList = jsonObj.dateList;
                	const taxList = jsonObj.taxList;
                	const priceList = jsonObj.priceList;
                	
                	var data = google.visualization.arrayToDataTable([
          				['Day', 'Tax', 'Trading Price'],
          				[dateList[0].substring(0, 10), taxList[0], priceList[0]],
          				[dateList[1].substring(0, 10), taxList[1], priceList[1]],
          				[dateList[2].substring(0, 10), taxList[2], priceList[2]],
          				[dateList[3].substring(0, 10), taxList[3], priceList[3]],
          				[dateList[4].substring(0, 10), taxList[4], priceList[4]]
        				]);

        			var options = {
          				title: 'Trading vs Tax',
          				curveType: 'function',
          				legend: { position: 'bottom' }
        				};

        			var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));
        			chart.draw(data, options);
               	}
           	}
        }

        objXMLHttpRequest.open('GET', 'GetServiceChargeAndTax/');
      	objXMLHttpRequest.send();
      }

      function drawColumnChart() {
      	var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
          	if(objXMLHttpRequest.readyState === 4) {
               	if(objXMLHttpRequest.status === 200) {
                   	const jsonObj = JSON.parse(objXMLHttpRequest.responseText);
                	const buyer = jsonObj.buyer;
                	const seller = jsonObj.seller;
                	const both = jsonObj.both;
                	const manager = jsonObj.manager;
                
                	var data = google.visualization.arrayToDataTable([
            			["User Type", "User Count", { role: "style" } ],
            			["Both", both, "blue"],
            			["Buyer", buyer, "silver"],
            			["Seller", seller, "violet"],
            			["SM", manager, "red"]
        			]);

        			var view = new google.visualization.DataView(data);
        			view.setColumns([0, 1,
                        	{ calc: "stringify",
                            	sourceColumn: 1,
                            	type: "string",
                        	    role: "annotation" },
                		        2]);

        			var options = {
            			title: "User",
            			bar: {groupWidth: "95%"},
            			legend: { position: "none" },
        			};
                
                	var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        			chart.draw(view, options);
               	}
           	}
        }

        objXMLHttpRequest.open('GET', 'GetUserInformation/');
      	objXMLHttpRequest.send();
    }      
</script>

@stop