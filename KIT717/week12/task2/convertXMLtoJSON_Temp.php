<?php

// Load the XML file
$xml = simplexml_load_file("tempDataenc.xml");

// Decryption setup
$key = 'gnoefjmpr14';
$iv = '1234567891011121';
$cipher = 'AES-128-CTR';

$results = [];

// Loop through each <record>
foreach ($xml->record as $record) {
    $encryptedTemp = (string) $record->temp;
    $date = (string) $record->date;

    // Decrypt
    $decryptedTemp = openssl_decrypt(
        base64_decode($encryptedTemp),
        $cipher,
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    $results[] = [
        'temp' => $decryptedTemp,
        'date' => $date
    ];
}

// Output as JSON
header('Content-Type: application/json');
echo json_encode($results);
?>
