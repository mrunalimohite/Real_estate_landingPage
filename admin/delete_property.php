<?php
include "../db.php";
session_start(); 

$id = $_GET['id']; // get id from URL
mysqli_query($conn, "DELETE FROM properties WHERE id = $id");

if(mysqli_query($conn, $query)){
        $_SESSION['success'] = "Property Delete successfully!";
    } else {
        $_SESSION['error'] = "Failed to Delete property!";
    }

    header("Location: manage_property.php");
    exit();

?>