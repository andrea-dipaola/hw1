<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "homework1_db");
        $userId = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        $query = "SELECT * FROM users WHERE id = '".$userId."'";
        $res = mysqli_query($conn, $query);
        $userInfo = mysqli_fetch_assoc($res);
    ?>

    <head>
        <title> Home </title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='home.css' />
        <script src='home.js' defer></script> 

        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body>
        <nav>
            <div id="links">
                <a href="create_review.php">Nuova recensione</a>
                <a id="podcast"> Podcast ricette Giallo Zafferano</a>
                <a id="ricetta"> Cerca una ricetta </a>
                <a href="lista_preferiti.php" id="preferiti"> Preferiti </a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>

        <form id="form_ricetta" class="hidden">
            Inserisci un ingrediente <br>
            <input type="text" id="ricetta_text">
            <input type="submit" id="cerca_ricetta" value="Cerca">
        </form>

        <section id="podcast_value"></section>
        <section id="ricetta_value"></section>


        <header>
            <div id="overlay"></div> 
            <div id="text">
                <strong>Ciao <?php echo $userInfo["username"]."!" ?></strong>
            </div>
        </header>

        <div id="menu">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <article>
            <div id="profile"> 
                <img src="https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-512.png"/> 
                <p> <?php echo $userInfo["nome"]." ".$userInfo["cognome"]?> </p> 
            </div>

        </article>

        <section id="reviews"> </section>
 
        
    </body>

</html>

<?php mysqli_close($conn); ?>