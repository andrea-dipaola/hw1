<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "homework1_db");
    $userId = $_SESSION["user_id"];
    $query = "SELECT recensioni.id_rec AS id_rec, recensioni.nome_locale AS locale, 
    recensioni.voto AS valutazione, recensioni.descrizione AS descrizione FROM users JOIN preferiti ON users.id = preferiti.user 
    JOIN recensioni ON recensioni.id_rec = preferiti.review WHERE users.id = '".$userId."'";
    $res = mysqli_query($conn, $query); 
   
    $reviewArrayPreferiti = array();
    while($entry = mysqli_fetch_assoc($res)){
        $reviewArrayPreferiti[] = array('id_rec' => $entry["id_rec"], 'locale' => $entry["locale"], 'valutazione' => $entry["valutazione"], 
        'descrizione' => $entry["descrizione"]);
    }

    mysqli_close($conn);
    echo json_encode($reviewArrayPreferiti);
    
?>