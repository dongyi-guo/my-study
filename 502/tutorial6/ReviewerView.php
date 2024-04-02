<?php
include('db_conn.php');

class ReviewerView{
	private $_id;
	private $_reviewerId;
	private $_reviewerName;
	private $_paperId;
	private $_score;

	public function __construct() 
	{ }

	private function _loadReviewDetails($paperId=NULL)	{
		$result = "";

		if(empty(!id)) 
		{
			return result;
		}

		$sql = "SELECT * FROM reviewerview WHERE paperid=:paperId";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":paperId", $paperId, PDO::PARAM_INT);
		$stmt->execute();
		$review_list = $stmt->fetchAll(PDO::FETCH_ASSOC);		$stmt->closeCursor();
		
		$result = "Reviewer Information: Reviewer Name (Reviewer Score): " . "<br /><ul>";

		foreach($results as $row) {
		   $result .= "<li>" . row["ReviewerName"] . "(" . row["Score"] . ")" . "</li>";
		}

		return result;
	}
}
?>