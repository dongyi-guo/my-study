
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__.'/vendor/autoload.php';

use Phpml\Classification\MLPClassifier;
use Phpml\ModelManager;

$filepath = 'testTimeNNmodel';
$mm = new ModelManager();

$restoredClassifier = $mm->restoreFromFile($filepath);
echo "Test Output: ";

echo ($restoredClassifier->predict([58,74,86,95])) . " " ;
echo ($restoredClassifier->predict([33,14,5,27])) . " " ;
echo ($restoredClassifier->predict([84,93,99,100])) . " " ;
echo ($restoredClassifier->predict([99,100,97,88])) . " " ;
echo ($restoredClassifier->predict([99,96,90,80])) . " " ;

// Added sine-like samples
echo ($restoredClassifier->predict([0, 20, 39, 56])) . " ";
echo ($restoredClassifier->predict([33, 14, 0, 20])) . " ";
echo ($restoredClassifier->predict([68, 52, 33, 14])) . " ";
echo ($restoredClassifier->predict([52, 33, 14, 0])) . " ";

// Test Output: 99 39 97 81 81 72 39 0 20
?>
