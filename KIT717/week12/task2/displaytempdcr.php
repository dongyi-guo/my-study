<?php 

error_reporting(E_ALL);	//show any errors if there is any
ini_set('display_errors', '1');

function decryptStr($str, $pkey) {
	// Store the cipher method 
	$ciphering = "AES-128-CTR"; 
	  
	// Use OpenSSl Encryption method 
	$iv_length = openssl_cipher_iv_length($ciphering); 
	$options = 0; 
	  
	// Non-NULL Initialization Vector for encryption 
	$decryption_iv = '1234567891011121'; 
	  
	// Store the decryption key 
	$decryption_key = $pkey; 
	  
	// Use openssl_decrypt() function to decrypt the data 
	$decryption = openssl_decrypt ($str, $ciphering,  $decryption_key, $options, $decryption_iv); 

	return $decryption ;

}

$xml_arr = '';								// intialize empty string
$pkey = "gnoefjmpr14";							//set Password


if(file_exists('tempDataenc.xml')) {					// if the xml file already exists then read it
	$xml_arr = simplexml_load_file('tempDataenc.xml');		// get all the current data

	foreach($xml_arr->record as $r) {				
		// display the data				
		echo $r->temp. "," . decryptStr($r->temp, $pkey). "," . $r->date. "\n";
	}
}
else {
	echo "No file";
}
?>
