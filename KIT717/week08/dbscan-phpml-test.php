<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Clustering\DBSCAN;

$samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9], [6,5]];

print_r($samples);

echo "<br/><br/>";

$dbscan = new DBSCAN($epsilon = 5, $minSamples = 3);
print_r($dbscan->cluster($samples));

?>
