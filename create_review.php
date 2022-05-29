<?php
    session_start();
    if(!empty($_POST["nome_locale"]) && !empty($_POST["descrizione"]) && !empty($_POST["voto"])){
        $conn = mysqli_connect("localhost", "root", "", "homework1_db");
        $user = $_SESSION["user_id"];
        $nomelocale = mysqli_real_escape_string($conn, $_POST["nome_locale"]);
        $descrizione = mysqli_real_escape_string($conn, $_POST["descrizione"]);
        $voto = mysqli_real_escape_string($conn, $_POST["voto"]);
        $query = "INSERT INTO recensioni(id_user, nome_locale, descrizione, voto) VALUES ('$user', '$nomelocale', '$descrizione', '$voto')";
        $res = mysqli_query($conn, $query);
        
        if($res){
            //echo "Dati inseriti";
            header("Location: home.php");  
            mysqli_close($conn);
            exit;
        }else{
            echo "Errore inserimento dati";
        }
        mysqli_close($conn);
    }

?>

<html>
    <head>
        <title> Nuova recensione </title>
        <link rel='stylesheet' href='create_review.css' />
        <script src='create_review.js' defer></script> 

        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <nav>
                <a href="home.php"> Home</a>
                <a href="logout.php"> Logout</a>
            </nav>

            <section id="newrecensione">
                <h1> Inserisci recensione locale </h1> 
                <form name="recensione_form" method="post"> 
                    <div>
                        <label> Nome locale <br> <input type="text" name="nome_locale"> </label>
                         
                    </div>

                    <div>
                        <label> Voto <br> <input type="text" name="voto" id="votazione"></textarea> </label>  
                        <span id="voto_span"></span>
                    </div>

                    <div>
                        <label> Descrizione <br> <textarea name="descrizione"></textarea> </label>  
                        
                    </div>

                    <label> <input type="submit" name="invio" value="Pubblica recensione"> </label>
                        
                </form>
                    
                    

            </section>

        </header>
    </body>


</html