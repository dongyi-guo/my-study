<?php

include('db_conn.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paperId = $_POST['paperId'];
    $authorId = $_POST['authorId'];
    $paperType = $_POST['paperType'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];

    $message = "";
    $location = $paperType==1 ? "Sandy Bay" : "Launcheston";

    try {
        $sql = "UPDATE $dbName.users SET Location=? WHERE Id = ?";
        $stmt = $db->prepare($sql);
        $stmt ->execute([$location, $authorId]);

        $sql = "UPDATE $dbName.papers SET Paper_type=?, Title=?, Abstract=? WHERE Id = ?";
        $stmt = $db->prepare($sql);
        $stmt ->execute([$paperType, $title, $abstract, $paperId]);
    } catch(Exception $e) {
        $message = "An error occurred. Details: " . $e->getMessage();
    }

    return $message;
}

?>