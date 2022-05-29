<?php
    $conn = mysqli_connect("localhost", "root", "", "homework1_db");
    $username = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT username FROM users WHERE username = '".$username."'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) > 0){
        $resp = array('exists' => true);
    }else{
        $resp = array('exists' => false);
    }
    echo json_encode($resp);

    mysqli_close($conn);

?>