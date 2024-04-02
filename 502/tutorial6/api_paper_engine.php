<?php

include('db_conn.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $result = "";
    $emailAddress = $_GET['e'];
    $sql = "SELECT * FROM $dbName.`users` WHERE `Email Address`= ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$emailAddress]);
    $user_index = $stmt->rowCount();

    if($user_index > 0) {
        $user_row = $stmt->fetch();
        $user_id = $user_row["ID"];
        $sql = "SELECT * FROM $dbName.`papers` WHERE User_id=".$user_id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $paper_row = $stmt->fetch();
        $result = "<b>Paper Title</b><hr />" . $paper_row["Title"] . "<hr /><b>Abstract</b><hr />" . $paper_row["Abstract"] . "<hr />";
    }

    echo $result;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result = "";
    $paperId = $_POST['paperId'];

    try {
        $sql = "SELECT * FROM $dbName.ReviewerView WHERE PaperId=".$paperId;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $review_index = $stmt->rowCount();

        if($review_index <= 0) {
            $sql = "DELETE FROM $dbName.`papers` WHERE Id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$paperId]);
        } else {
            $result = "Selected paper has $review_index reviews. Cannot delete this paper.";
        }
    } catch(Exception $e) {
        $result = "An error occured. Details: " . $e->getMessage();
    }

    echo $result;
}