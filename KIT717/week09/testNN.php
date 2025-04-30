
<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__.'/vendor/autoload.php';

use Phpml\Classification\MLPClassifier;

$mlp = new MLPClassifier(4,[2],['a','b','c']);

$mlp->setLearningRate(0.1);

$mlp->train(
	$samples = [[1, 0, 0, 0], [0, 1, 1, 0], [1, 1, 1, 1], [0, 0, 0, 0]],
    $targets = ['a', 'a', 'b', 'c']
);

print_r($mlp->predict([[1, 1, 1, 1], [0, 0, 0, 0]]));

?>
