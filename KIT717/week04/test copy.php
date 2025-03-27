
<?php

	// http://iotserver.com/test.php?num=X
	if (isset($_GET['num'])){
		$n = $_GET['num'];
		if ($n % 2 == 0) {
			echo 'Even';
		}
		else
		{
			echo 'Odd';
		}
	}
	else
	{
		echo 'Invalid Inputs';
	}
?>

