<?php

include('db_conn.php');

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
	$paper_id = $_GET['id'];
	$stmt = $db->prepare("SELECT * FROM ReviewerView WHERE Paper_id = ?");
	$stmt->execute([$id]);
	$item_list -> $stmt->fetch(PDO::FETCH_ASSOC);
	
	echo json_encode($item_list);
}
?>