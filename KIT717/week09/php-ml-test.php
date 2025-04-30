<?php

require_once __DIR__ . '/vendor/autoload.php';
$EOL = php_sapi_name() === 'cli' ? PHP_EOL : '<br>';

use Phpml\Classification\KNearestNeighbors;

$samples = [
    // Class 'a' (low x, high y)
    [1, 3], [1, 4], [2, 4], [1, 5], [2, 5], [1.5, 4.5], [2, 3.5], [1, 3.2], [1.8, 4.1], [2.2, 4.8], [2.5, 3.8], [1.9, 4.4], [2.1, 5], [1.3, 3.7], [2.4, 4.6],
    
    // Class 'b' (high x, low y)
    [3, 1], [4, 1], [4, 2], [3.5, 1.2], [4.2, 1], [3.8, 2.1], [3.9, 1.6], [4.5, 1.7], [3.6, 1.1], [4.1, 2.3], [3.4, 1.9], [4.3, 2.4], [4.6, 1.5], [3.7, 1.4], [3.2, 2.2],

    // Class 'c' (high x and high y)
    [7, 8], [8, 7], [9, 8], [8, 8], [7.5, 7.5], [9.1, 8.3], [8.7, 9], [9, 7.5], [8.3, 8.2], [7.8, 9.4], [9.5, 8.7], [7.9, 8.1], [8.2, 9.2], [9.3, 7.6], [8.5, 8.9]
];

$labels = [
    // 15 x 'a'
    'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',

    // 15 x 'b'
    'b','b','b','b','b','b','b','b','b','b','b','b','b','b','b',

    // 15 x 'c'
    'c','c','c','c','c','c','c','c','c','c','c','c','c','c','c'
];


$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);

if (isset($_GET['x']) and isset($_GET['y'])) {
	$target = [floatval($_GET['x']), floatval($_GET['y'])];
	echo $classifier->predict($target) . $EOL;
}
else{
	echo "Invalid Arguments: Provide x and y for your coordination as GET parameter.";
}

$testSamples = [
    [1.5, 4],    // Likely 'a'
    [4.1, 1.5],  // Likely 'b'
    [8.2, 8.1],  // Likely 'c'
    [2.0, 3.8],  // Likely 'a'
    [4.0, 2.0],  // Likely 'b'
    [9.0, 8.0]   // Likely 'c'
];

echo "==================" . $EOL . "Test Sample Results:". $EOL;

foreach ($testSamples as $sample) {
	echo $classifier->predict($sample) . $EOL;
}


