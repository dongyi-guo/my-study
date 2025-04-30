
<?php
	error_reporting(E_ALL);			//show any errors if there if any
	ini_set('display_errors', '1');
	ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
	set_time_limit(300);
	header('Content-type: text/plain');
	require_once __DIR__ . '/vendor/autoload.php';


	use Phpml\Classification\MLPClassifier;
	use Phpml\ModelManager;

	$mlp = new MLPClassifier(56, [8], ['rainy', 'sunny']);
	$mlp->setLearningRate(1);

	$rawData = json_decode(file_get_contents("dataforNN.json"));

	echo "count of raw data :";
	echo count($rawData) . PHP_EOL;

	$last_entry_id = $rawData[0]->entry_id;

	$days = [];
	$days_sampled = [];
	$day = [];

	for($i = 0; $i < count($rawData); $i++) {
		
		//push the values for field1 into day array
		array_push($day, intval($rawData[$i]->field1));
		
		//if the day array contains more that 282 values (end of day) push the day into the days array and clear the day
		if($rawData[$i]->entry_id - $last_entry_id == 282){
			$last_entry_id = $rawData[$i]->entry_id;
			array_push($days, $day);
			$day = [];
		}	
	}
	//push remaining data into final day
	if(count($day) > 0)
		array_push($days, $day);

	echo"number of days: ";
	print_r(count($days));
	echo"\r\n";

	echo"number of samples each day :";
	for ($index = 0; $index<10; $index++) {
		print_r("Day " . $index+1 . ": " . count($days[$index]));
		echo"\r\n";
	}


	for($j = 0; $j < count($days); $j++) {
		
		$day = [];
		//pull out every ith value and put into days sampled array
		for ( $i = 1; $i < count($days[$j]); $i += 1) { 
			array_push($day, $days[$j][$i]);
		}
		
		array_push($days_sampled, $day);
	}

	echo"number of days sampled : ";
	print_r(count($days_sampled));
	echo"\r\n";

	echo "number of samples in each day sampled : ";
	print_r(count($days_sampled[0]));
	echo"\r\n";

	$t_ = time();
	$modelFile = 'model/mlp_model';
	
	// The 'model' folder must be created first
	if (!file_exists('model')) {
		mkdir('model', 0777, true);
	}
	
	$mlp->train(
		$samples = [$days_sampled[0], $days_sampled[1], $days_sampled[2], $days_sampled[3], $days_sampled[4], $days_sampled[5], $days_sampled[6], $days_sampled[7]], 
		$targets = ['sunny', 'rainy', 'sunny', 'rainy', 'sunny', 'rainy', 'sunny', 'sunny']
	);
	
	$mm = new ModelManager();
	$mm->saveToFile($mlp, $modelFile);

	echo "Execution time : " . time() - $t_ . "s\r\n" . "Model file saved at: " . $modelFile;
?>
