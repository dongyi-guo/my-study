<?php
	error_reporting(E_ALL);						//show any errors if there is any
	ini_set('display_errors', '1');

	header("Content-type: text/plain");		// reply with TEXT
	
	$datapath = "geodata.json";
	$jsonObject = json_decode(file_get_contents($datapath));
	
	$mostFar = -1.0;
	$leastFar = INF;
	
	foreach ($jsonObject as $j){
		foreach ($jsonObject as $k){
			$distance = sqrt(($j->x - $k->x)*($j->x - $k->x)+($j->y - $k->y)*($j->y - $k->y));
			if ($mostFar < $distance) {
				$mostFar = $distance;
			}
			
			if ($leastFar > $distance and 0 != $distance) {
				$leastFar = $distance;
			}
		}
	}

	echo "The biggest distance between points are: " . $mostFar . "\n"
		. "The smallest distance between points are: " . $leastFar . "\n";
?>

