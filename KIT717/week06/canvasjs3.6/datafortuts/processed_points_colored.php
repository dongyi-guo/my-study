<?php
	error_reporting(E_ALL);						//show any errors if there is any
	ini_set('display_errors', '1');

	header("Content-type: application/json");		// reply with TEXT
	
	$datapath = "geodata.json";
	$jsonObject = json_decode(file_get_contents($datapath));
	
	$x_bound = 1400;
	$y_bound = 1100;
	
	foreach ($jsonObject as $j){
		$jx = $j->x;
		$jy = $j->y;
		
		if ($jx <= $x_bound){
			if ($jy <= $y_bound){
				$j->color = "#4C566A";
			}
			else{
				$j->color = "#D08770";
			}
		}
		else{
			if ($jy <= $y_bound){
				$j->color = "#BF616A";
			}
			else{
				$j->color = "#A3BE8C";
			}
		}
	}
	
	// Save the updated JSON back to the file
	file_put_contents($datapath, json_encode($jsonObject, JSON_PRETTY_PRINT));
?>

