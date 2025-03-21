
<?php

	// http://iotserver.com/temperature.php?temp=X
	if (isset($_GET['temp']) and isset($_GET['threshold'])){
		$n = $_GET['temp'];
		$t = $_GET['threshold'];
		if ($n >=$t) {
			echo 'Hot';
		}
		else
		{
			echo 'Cold';
		}
	}
	else
	{
		echo 'Invalid Inputs';
	}
	
?>

