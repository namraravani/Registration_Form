<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "dbconfig.php";

    
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = null; 
    }

    $name = $_POST['name'];
    $status = $_POST['status'];

    $insertQuery = "INSERT INTO category (id, name, status) VALUES (:id, :name, :status)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    echo "Data inserted Succesfully";
}

?>