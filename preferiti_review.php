<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "homework1_db");

    $userId = $_SESSION["user_id"];
    $reviewId = $_GET["q"];
  
    $query_ins = "INSERT INTO preferiti(user, review) VALUES ('$userId', '$reviewId')"; 
    $res = mysqli_query($conn, $query_ins);

    mysqli_close($conn);
    echo json_encode($res); 
?>
