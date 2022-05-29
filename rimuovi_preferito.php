<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "homework1_db");

    $reviewId = $_GET["q"];
  
    $query_ins = "DELETE FROM preferiti WHERE review = '".$reviewId."'"; 
    $res = mysqli_query($conn, $query_ins);

    mysqli_close($conn);
    echo json_encode($res); 
?>
