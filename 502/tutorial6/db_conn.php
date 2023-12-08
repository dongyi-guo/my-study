<?php
    $dbFile = 'kit502conferencedb.db';
    $dbName = 'kit502conferencedb';

    try {
        $db = new PDO("mysql:$dbFile", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Database Connection failed: " . $e->getMessage();
    }
?>