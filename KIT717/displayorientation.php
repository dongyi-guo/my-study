<?php 

	error_reporting(E_ALL);									//show any errors if there is any
	ini_set('display_errors', '1');
	
		$xml_arr = '';										// intialize empty string

		if(file_exists('orientationData.xml')) {					// if the xml file already exists then read it
			$xml_arr = simplexml_load_file('orientationData.xml');	// get all the current data

			foreach($xml_arr->record as $r) {				
				// display the data				
				$comma = ",";
				$result = $r->orientation->pitch . $comma . 
						$r->orientation->yaw . $comma .
						$r->orientation->roll . $comma .
						$r->date . "<br/>\n";
						
				echo $result;
			}
		}
		else {
			echo "No file";
		}
?>

