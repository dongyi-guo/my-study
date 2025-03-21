
<?php

	// To make this work, make sure the user has w access in the 'iotserver' folder
	// chmod -R 777 /path/to/server/folder
	$filename = "log.txt";
	
	if(isset($_GET['temp']) and isset($_GET['time']))
	{
		$temp_label = "Temperature: ";
		$time_label = "Timestamp: ";
		$temp = $_GET['temp'];
		$time = $_GET['time'];
		$outcome = $temp_label . $temp . $time_label . $time . "\n";
		file_put_contents($filename, $outcome, FILE_APPEND);
		echo "Logged Successfully";
	}
	else
	{
			echo "Insufficient Parameters.";
	}
	

?>

