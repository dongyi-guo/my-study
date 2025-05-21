<?php 
	
	error_reporting(E_ALL);						//show any errors if there is any
	ini_set('display_errors', '1');

	$returnVal = 1;								// set global return value
	
	
	if(isset($_GET['uname']) && isset($_GET['pin'])) { 			// Check if paramters is present or not
		
		$xml_arr = '';							// intialize empty string

		if(file_exists('userhash.xml')) {				// if the xml file already exists then read it
			$xml_arr = simplexml_load_file('userhash.xml');		// get all the current data
			$returnVal = 1;
		}
		else {
			$returnVal = 0;
		}
		
		if($returnVal == 1) {	
		
			$returnVal = 0;			// There is something in the file, but we have to match the user and pin now
									// so we set returnVal = 0
									
			//print_r($xml_arr);
			//echo "The number of records in the array: " . count($xml_arr->stud) . "\n";
			
			foreach($xml_arr->stud as $u) {				
				// check if there is a record with user id and pin number
				// that matches the inputs that are coming from the Arduino
				
				// No need to MD5 here as it will be hashed before passing in
				if($u->id == $_GET['uname'] && $u->pass == ($_GET['pin'])) {		
					$returnVal = 1;
					break;					// stop the loop, there is no need to look any more
				}
				
				// if still $returnVal == 0, then there is no record found with the uname/pin
			}
		}
		else {			
			// if there is no proper file then return false/failure
			$returnVal = 0;
		}
	}
	else
			$returnVal = 0;
	
	echo $returnVal;	// echo the final decision
	
?>
