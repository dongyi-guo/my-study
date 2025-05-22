
<?php 

error_reporting(E_ALL);	//show any errors if there is any
ini_set('display_errors', '1');

$pkey = "gnoefjmpr14";
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

if (isset($_POST['h'])) {
	
	echo decryptStr($_POST['h'], $pkey);
}
?>
