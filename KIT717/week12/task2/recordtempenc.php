<?php 
	
error_reporting(E_ALL);	//show any errors if there is any
ini_set('display_errors', '1');

function encString($str, $pkey) {
	// Store a string into the variable which need to be Encrypted 
	$simple_string = $str; 
	  
	// Store the cipher method 
	$ciphering = "AES-128-CTR"; 
	  
	// Use OpenSSl Encryption method 
	$iv_length = openssl_cipher_iv_length($ciphering); 
	$options = 0; 
	  
	// Non-NULL Initialization Vector for encryption 
	$encryption_iv = '1234567891011121'; 
	  
	// Store the encryption key 
	$encryption_key = $pkey; 
	  
	// Use openssl_encrypt() function to encrypt the data 
	$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv); 

	return $encryption;
}

if(isset($_GET['t'])) { // Check if temprature is present or not
	
	$str = '';								// intialize empty string
	$pkey = "gnoefjmpr14";							//set Password


	if(file_exists('tempDataenc.xml')) {				// if the xml file already exists then read it
		$str = file_get_contents('tempDataenc.xml');	// get all the current data
	}
	
	if(strlen($str) == 0) {
		// intialize the variable to the empty xml if there is no old content
		$str = "<?xml version='1.0' encoding='UTF-8'?> \n<kittemp></kittemp>";
	}

	// create a new text for appending to the file
	$newData = "\n<record><temp>". encString($_GET['t'], $pkey). "</temp><date>". date('d-m-Y H:i:s') . "</date></record>\n</kittemp>"; 	
	$str = str_replace("</kittemp>", $newData, $str);	// put the data in the end of the xml document
	
	file_put_contents('tempDataenc.xml', $str);			// write the file back to the server

	echo '1';							// return success
}
else
	echo '0';							// return failure
	
?>
