
<?php

	// To make this work, make sure the user has w access in the 'iotserver' folder
	// chmod -R 777 /path/to/server/folder
	$filename = "log.csv";
	
	if(isset($_GET['temp']) and isset($_GET['time']) and isset($_GET['humid']))
	{
		$temp = $_GET['temp'];
		$time = $_GET['time'];
		$humid = $_GET['humid'];
		$comma = ",";
		$newline = "\n";
		$outcome = $time . $comma . $temp . $comma . $humid . $newline;
		file_put_contents($filename, $outcome, FILE_APPEND);
		echo "Logged Successfully";
	}
	else
	{
			echo "Insufficient Parameters.";
	}
	

?>


