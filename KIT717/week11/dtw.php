<?php

function dtwDistance($ts1, $ts2) {
    $n = count($ts1);
    $m = count($ts2);

    $DTW = array_fill(0, $n+1, array_fill(0, $m+1, INF));
    $DTW[0][0] = 0;

    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $m; $j++) {
            $dist = abs($ts1[$i-1] - $ts2[$j-1]);
            $DTW[$i][$j] = $dist + min($DTW[$i-1][$j], $DTW[$i][$j-1], $DTW[$i-1][$j-1]);
        }
    }

    return $DTW[$n][$m];
}

// Case 1: Identical
$ts1a = [1, 2, 3];
$ts2a = [1, 2, 3];

// Case 2: Shifted
$ts1b = [1, 2, 3];
$ts2b = [2, 3, 4];

// Case 3: Flat vs Increasing
$ts1c = [5, 5, 5, 5];
$ts2c = [1, 2, 3, 4];

// Case 4: One vs Many
$ts1d = [3];
$ts2d = [1, 2, 3, 4, 5];

// Case 5: Opposite Trends
$ts1e = [1, 2, 3, 4, 5];
$ts2e = [5, 4, 3, 2, 1];

// Case 6: Zeros vs Positives
$ts1f = [0, 0, 0, 0];
$ts2f = [1, 2, 3, 4];

echo "Case 1 (Identical): " . dtwDistance($ts1a, $ts2a) . "\n";
echo "Case 2 (Shifted): " . dtwDistance($ts1b, $ts2b) . "\n";
echo "Case 3 (Flat vs Increasing): " . dtwDistance($ts1c, $ts2c) . "\n";
echo "Case 4 (One vs Many): " . dtwDistance($ts1d, $ts2d) . "\n";
echo "Case 5 (Opposite Trends): " . dtwDistance($ts1e, $ts2e) . "\n";
echo "Case 6 (Zeros vs Positives): " . dtwDistance($ts1f, $ts2f) . "\n";

?>
