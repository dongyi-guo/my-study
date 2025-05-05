
<?php

require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Regression\LeastSquares;

$samples = [[30], [29], [25], [22], [20], [18], [17], [14], [13]]; 
$targets = [48, 47, 48, 46, 46, 47, 46, 45, 46];

$regression = new LeastSquares();
$regression->train($samples, $targets); 
echo $regression->predict([1]) . PHP_EOL;

$samples = [[73676, 1996], [77006, 1998], [10565, 2000], [146088, 1995], [15000, 2001], [65940, 2000], [9300, 2000], [93739, 1996], [153260, 1994], [17764, 2002], [57000, 1998], [15000, 2000]];
$targets = [2000, 2750, 15500, 960, 4400, 8800, 7100, 2550, 1025, 5900, 4600, 4400];

$regression = new LeastSquares();
$regression->train($samples, $targets);
// return 4094.82
echo $regression->predict([60000, 1996]) . PHP_EOL;


?>
