<?php
	include('db_conn.php');

	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$paperId = $_GET['paperId'];
		$sql = "SELECT * FROM $dbName.ReviewerView WHERE PaperId=".$paperId;
		$stmt = $db->query($sql);
		$index = 0;
				
		$result = "Reviewer Information: Reviewer Name (Reviewer Score): " . "<br /><ul>";

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result .= "<li>" . $row["ReviewerName"] . "(" . $row["Score"] . ")" . "</li>";
			$index++;
		};

		if($index > 0) {
			$result .= "<br />";
		}

		echo $result;
	}
?>