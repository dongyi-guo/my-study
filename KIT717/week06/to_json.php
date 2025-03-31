<?php 
	error_reporting(E_ALL);						//show any errors if there is any
	ini_set('display_errors', '1');
	$filename = 'canvasjs3.6/datafortuts/txh.json';
	
	// Read existing data (if file exists)
	$data = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
	
	if (!is_array($data)) {
		$data = [];
	}

	if(isset($_GET['t']) and isset($_GET['h'])) { // Check if temprature and humidity is present or not
		
		$data[] = ['t' => $_GET['t'], 'h' => $_GET['h']];
		

		file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

		echo '1';							// return success
	}
	else
		echo '0';							// return failure
?>

