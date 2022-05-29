<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "homework1_db");
    $query = "SELECT recensioni.id_rec AS id_rec, users.nome AS nome, users.cognome AS cognome, recensioni.nome_locale AS locale, 
    recensioni.voto AS valutazione, recensioni.descrizione AS descrizione FROM users JOIN recensioni ON users.id = recensioni.id_user";
    $res = mysqli_query($conn, $query); 
   
    $reviewArray = array();
    while($entry = mysqli_fetch_assoc($res)){
        $reviewArray[] = array('id_rec' => $entry["id_rec"], 'nome' => $entry["nome"], 'cognome' => $entry["cognome"], 'locale' => $entry["locale"], 
        'valutazione' => $entry["valutazione"], 'descrizione' => $entry["descrizione"]);
    }
    
    mysqli_close($conn);
    echo json_encode($reviewArray);
    
?>