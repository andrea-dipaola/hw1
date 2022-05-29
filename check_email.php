<?php
    $conn = mysqli_connect("localhost", "root", "", "homework1_db");
    $email = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT email FROM users WHERE email = '".$email."'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) > 0){
        $resp = array('exists' => true);
    }else{
        $resp = array('exists' => false);
    }
    echo json_encode($resp);
    mysqli_close($conn);


?>