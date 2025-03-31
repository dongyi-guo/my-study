<?php
	error_reporting(E_ALL);						//show any errors if there is any
	ini_set('display_errors', '1');

		header("Content-type: application/json");		// reply with JSON

		$ldrpoints = array();
		
		$high_S1 = 0;
		$low_S1 = 0;
		$high_S2 = 0;
		$low_S2 = 0;

		$threshhold = 100.0;					// a threshhold corresponding to the sensitivity of the sensor		
		$S1filename = 'S1 11-11-2019.xml';
		$S2filename = 'S2 11-11-2019.xml';
		
				
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
		
		$xml_arr_S1 = simplexml_load_file($S1filename);		// get all the current data for Sensor 1
		$xml_arr_S2 = simplexml_load_file($S2filename);		// get all the current data for Sensor 2
		
		foreach($xml_arr_S1->feeds->feed as $r) {
			$val = strval($r->field1);
			if($val > $threshhold){
				$high_S1++;				// count the high values
			}
			else {
				$low_S1++;					// count the low values
			}
		}
		
		foreach($xml_arr_S2->feeds->feed as $r) {		
			$val = strval($r->field2);
			if($val > $threshhold){
				$high_S2++;				// count the high values
			}
			else {
				$low_S2++;					// count the low values
			}
		}

		// For Sensor 1
		$high_S1 = ($high_S1 / count($xml_arr_S1->feeds->feed)) * 100;		// convert the high and low count
		$low_S1  = ($low_S1  / count($xml_arr_S1->feeds->feed)) * 100;		// to percentages
		
		// For Sensor 2
		$high_S2 = ($high_S2 / count($xml_arr_S2->feeds->feed)) * 100;		// convert the high and low count
		$low_S2  = ($low_S2  / count($xml_arr_S2->feeds->feed)) * 100;		// to percentages
		
		
			
		//add the high light values
		array_push($ldrpoints,  array("y" => $high_S1, "legendText" => "High Light", "label" => "High Light"));
		array_push($ldrpoints,  array("y" => $low_S1, "legendText" => "Low Light", "label" => "Low Light"));
		
		//add the low light values
		array_push($ldrpoints,  array("y" => $high_S2, "legendText" => "High Light", "label" => "High Light"));
		array_push($ldrpoints,  array("y" => $low_S2, "legendText" => "Low Light", "label" => "Low Light"));

		echo json_encode($ldrpoints, JSON_NUMERIC_CHECK);
?>

