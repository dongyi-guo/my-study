<?php
header('Content-Type: application/json');
require_once('dbscan.php');
//

$point_ids = array();
$distance_matrix = array();
$i = 0;

$X = array(); // for X position
$Y = array(); // for Y position
$L = array(); // for label of the point
$C = array(); // for color of the point

if(file_exists($_GET['data']) and isset($_GET['eps']) and isset($_GET['mp'])) {        // if the json file already exists then read it

	$epsilon = $_GET['eps'];
	$minpoints = $_GET['mp'];

	$json_arr = json_decode(file_get_contents($_GET['data']));		
	// get all the current data
	//print_r($json_arr[0]->X);

	foreach($json_arr as $r) {
		array_push($point_ids,  $r->label . ""); //$i); 
		$X[$r->label] = $r->X;
		$Y[$r->label] = $r->Y;
		$C[$r->label] = $r->color;
		$L[$r->label] = $r->label;
	}

	$i = 0;
	foreach($json_arr as $r) {

	  $j = 0;
	  $temporary = array();

	  foreach($json_arr as $s) {
	
		$d = sqrt(($r->X - $s->X) * ($r->X - $s->X) + ($r->Y - $s->Y) * ($r->Y - $s->Y));
		
		$temporary[$s->label] = $d; //$distance_matrix["P$i"]
		$j++;
	  }

	   $distance_matrix[$r->label] = $temporary;

	  $i++;	
	}

	//echo 'All the points <br>';
	//print_r($point_ids);

	//echo "<br><br>All the Distances <br>";
	//print_r($distance_matrix);


	// Setup DBSCAN with distance matrix and unique point IDs
	$DBSCAN = new DBSCAN($distance_matrix, $point_ids);
	

	// Perform DBSCAN clustering
	$clusters = $DBSCAN->dbscan($epsilon, $minpoints);

	//Output results
	$output = array(
		"epsilon" => $epsilon,
		"minpoints" => $minpoints,
		"clusters" => array()
	);

	foreach ($clusters as $index => $cluster)
	{
		if (sizeof($cluster) > 0)
		{
			$cluster_data = array(
				"cluster_number" => $index + 1,
				"points" => array()
			);

			foreach ($cluster as $member_point_id){
				$cluster_data["points"][] = array(
					"id" => $member_point_id,
					"label" => $L[$member_point_id],
					"coordinates" => array(
						"x" => $X[$member_point_id],
						'y' => $Y[$member_point_id]
					),
					"color" => $C[$member_point_id]
				);
			}
			$output["clusters"][] = $cluster_data;
		}
	}
	
	echo json_encode($output, JSON_PRETTY_PRINT);
}
else {
	echo json_encode(array(
        "error" => "Insufficient Arguments or Data File Doesn't Exist."
    ));
}
?>
