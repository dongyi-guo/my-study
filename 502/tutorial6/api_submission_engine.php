<?php

include('db_conn.php');

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $emailAddress = $_GET['e'];
    $sql = "SELECT * FROM $dbName.`users` WHERE `Email Address`= ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$emailAddress]);
    $user_index = $stmt->rowCount();
    $paper_index = 0;

    if($user_index > 0) {
        $user_row = $stmt->fetch();
        $user_id = $user_row["ID"];
        $sql = "SELECT * FROM $dbName.`papers` WHERE User_id=".$user_id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $paper_index = $stmt->rowCount();
    }

    echo $user_index . "," . $paper_index;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $emailAddress = $_POST['emailAddress'];
    $affiliation = $_POST['affiliation'];
    $paperType = $_POST['paperType'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];

    $role = 1;
    $location = $paperType==1 ? "Sandy Bay" : "Launcheston";
    $accepted = 1;

    $message = "";

    try {
        $sql = "SELECT * FROM $dbName.users WHERE `Email Address`= ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$emailAddress]);
        $user_index = $stmt->rowCount();
        $user_id = 0;

        if($user_index > 0) {
            $user_row = $stmt->fetch();
            $user_id = $user_row["ID"];
        } else {
            $sql = "INSERT INTO $dbName.users (Name, `Email Address`, Affiliation, Role, Location) VALUES (?, ?, ?, ?, ?) ";
            $stmt = $db->prepare($sql);
            $stmt ->execute([$name, $emailAddress, $affiliation, $role, $location]);
            $user_id = $db->lastInsertId();
        }

        $sql = "SELECT * FROM $dbName.papers WHERE User_id= ".$user_id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $paper_index = $stmt->rowCount();

        if($paper_index <= 0) {
            $sql = "INSERT INTO $dbName.papers (User_id, Paper_type, Accepted, Title, Abstract) VALUES (?, ?, ?, ?, ?) ";
            $stmt = $db->prepare($sql);
            $stmt ->execute([$user_id, $paperType, $accepted, $title, $abstract]);
        }
    } catch(Exception $e) {
        $message = "An error occurred. Details: " . $e->getMessage();
    }

    return $message;
}
?>