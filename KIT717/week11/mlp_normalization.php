<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Classification\MLPClassifier;

$mlp = new MLPClassifier(1, [8], ['freezing', 'normal', 'hot']);
$mlp->setLearningRate(0.8);

// Sample data, freezing < 0 <= normal <= 42 < hot
$samples = [-30, -25, -10, -5, -1, 0, 5, 10, 15, 20, 25, 30, 35, 40, 42, 43, 45, 50, 60, 70, 80, 90, 100, 110, 120, 150, 200];
$targets = ['freezing', 'freezing', 'freezing', 'freezing', 'freezing', 'normal', 'normal', 'normal', 'normal', 'normal', 'normal', 'normal', 'normal', 'normal', 'normal', 'hot', 'hot', 'hot', 'hot', 'hot', 'hot', 'hot', 'hot', 'hot', 'hot', 'hot', 'hot'];


// Find min and max
$min = min($samples);
$max = max($samples);

// Normalize the array
$normalized_samples = array_map(function($value) use ($min, $max) {
    return [($value - $min) / ($max - $min)];
}, $samples);

// Train the model
$mlp->train($normalized_samples, $targets);

// Predict a few examples
$testSamples = [
    10, // normal
    3,  // normal
    50, // hot
    80, // hot
    -30, // freezing
    -15 // freezing
];

// Normalize the array
$normalized_tests = array_map(function($value) use ($min, $max) {
    return [($value - $min) / ($max - $min)];
}, $testSamples);

print_r($normalized_samples);
print_r($normalized_tests);

foreach ($normalized_tests as $t) {
    $result = $mlp->predict([$t]);
    print_r($result);
}

?>
