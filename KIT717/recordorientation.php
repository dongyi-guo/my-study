<?php 

	error_reporting(E_ALL);						//show any errors if there is any
	ini_set('display_errors', '1');

	if(isset($_GET['pitch']) and isset($_GET['yaw']) and isset($_GET['roll'])) { 					// Check if temprature is present or not
		
		$str = '';								// intialize empty string

		if(file_exists('orientationData.xml')) {				// if the xml file already exists then read it
			$str = file_get_contents('orientationData.xml');	// get all the current data
		}
		
		if(strlen($str) == 0) {
			// intialize the variable to the empty xml if there is no old content
			$str = "<?xml version='1.0' encoding='UTF-8'?> \n<records></records>";
		}

		// create a new text for appending to the file
		$newData = "\n\t<record>\n\t\t<orientation>\n\t\t\t<pitch>".
					$_GET['pitch'].
					"</pitch>\n\t\t\t<yaw>".
					$_GET['yaw'].
					"</yaw>\n\t\t\t<roll>".
					$_GET['roll'].
					"</roll>\n\t\t</orientation>\n\t\t<date>".
					date('d-m-Y H:i:s').
					"</date>\n\t</record>\n</records>"; 	
					
		$str = str_replace("</records>", $newData, $str);	// put the data in the end of the xml document
		
		file_put_contents('orientationData.xml', $str);			// write the file back to the server

		echo '1';							// return success
	}
	else
		echo '0';							// return failure
?>

