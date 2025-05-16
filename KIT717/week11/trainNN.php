
<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__.'/vendor/autoload.php';

use Phpml\Classification\MLPClassifier;
use Phpml\ModelManager;
use Phpml\Pipeline;

$samples = [
	[0,20,39,56],
	[20,39,56,72],
	[39,56,72,84],
	[56,72,84,93],
	[72,84,93,99],
	[84,93,99,100],
	[93,99,100,97],
	[99,100,97,91],
	[100,97,91,81],
	[97,91,81,68],
	[91,81,68,52],
	[81,68,52,33],
	[68,52,33,14],
	[52,33,14,1],
	[33,14,1,21],
	[14,1,21,40],
	[1,21,40,57],
	[21,40,57,73],
	[40,57,73,85],
	[57,73,85,94],
	[73,85,94,100],
	[85,94,100,101],
	[94,100,101,98],
	[100,101,98,92],
	[101,98,92,82],
	[98,92,82,69],
	[92,82,69,53],
	[82,69,53,34],
	[69,53,34,15],
	[53,34,15,2],
	[34,15,2,22],
	[15,2,22,41],
	[2,22,41,58],
	[22,41,58,74],
	[41,58,74,86],
	[58,74,86,95],
	[74,86,95,101],
	[86,95,101,102],
	[95,101,102,99],
	[101,102,99,93],
	[102,99,93,83],
	[99,93,83,70],
	[93,83,70,54],
	[83,70,54,35],
	[70,54,35,16],
	[54,35,16,0],
	[35,16,0,19],
	[16,0,19,38],
	[0,19,38,55],
	[19,38,55,71],
	[38,55,71,83],
	[55,71,83,92],
	[71,83,92,98],
	[83,92,98,99],
	[92,98,99,96],
	[98,99,96,90],
	[99,96,90,80],
	[96,90,80,67],
	[90,80,67,51],
	[80,67,51,32],
	[67,51,32,13],
	[51,32,13,0],
	[32,13,0,18],
	[13,0,18,37],
	[0,18,37,54],
	[18,37,54,70],
	[37,54,70,82],
	[54,70,82,91],
	[70,82,91,97],
	[82,91,97,98],
	[91,97,98,95],
	[97,98,95,89],
	[98,95,89,79],
	[95,89,79,66],
	[89,79,66,50],
	[79,66,50,31]
];

$targets = [
	72,
	84,
	93,
	99,
	100,
	97,
	91,
	81,
	68,
	52,
	33,
	14,
	0,
	20,
	39,
	56,
	72,
	84,
	93,
	99,
	100,
	97,
	91,
	81,
	68,
	52,
	33,
	14,
	0,
	20,
	39,
	56,
	72,
	84,
	93,
	99,
	100,
	97,
	91,
	81,
	68,
	52,
	33,
	14,
	0,
	20,
	39,
	56,
	72,
	84,
	93,
	99,
	100,
	97,
	91,
	81,
	68,
	52,
	33,
	14,
	0,
	20,
	39,
	56,
	72,
	84,
	93,
	99,
	100,
	97,
	91,
	81,
	68,
	52,
	33,
	14
];

$samples_t = [];
$targets_t = [];

for ($j = 0; $j < count($samples); $j+=1) {
	array_push($samples_t, $samples[$j]);
	array_push($targets_t, strval(floor(floatval($targets[$j]))));
}

echo "Samples " . count($samples_t) . "\r\n";
print_r($samples_t);

echo "Targets " . count($targets_t) . "\r\n";
print_r($targets_t);

$filtered_samples_t = [];
$filtered_targets_t = [];
$elements_t = [];

for($j = 0; $j < count($samples_t); $j++) {
	if(!in_array($samples_t[$j], $filtered_samples_t)){
		array_push($filtered_samples_t, $samples_t[$j]);
		array_push($filtered_targets_t, strval($targets_t[$j]));
	}
}

for($j = 0; $j < count($filtered_targets_t); $j++) {
	if(!in_array($filtered_targets_t[$j], $elements_t)){
		array_push($elements_t, $filtered_targets_t[$j]);
	}
}

echo "Filtered Samples " . count($filtered_samples_t) . "\r\n";
print_r($filtered_samples_t);

echo "Filtered Targets " . count($filtered_targets_t) . "\r\n";
print_r($filtered_targets_t);

echo "Unique Elements " . count($elements_t) . "\r\n";
print_r($elements_t);

$mid_layer = max(intval(count($filtered_samples_t) / 2), count($elements_t));

echo $mid_layer;

$transformers = [];
$mlp = new MLPClassifier(4, [$mid_layer], $elements_t);
$mlp->setLearningRate(0.01);

$pip = new Pipeline($transformers, $mlp);

$t_ = time();
$pip->train($filtered_samples_t, $filtered_targets_t);
echo "Time Taken to train: " . time() - $t_ . "seconds\r\n";

$filepath = "myNNModel";
$mm = new ModelManager();
$mm->saveToFile($pipeline, $filepath);

echo "Test Output: ";
echo ($pipeline->predict([58,74,86,95])) . " ";

?>
