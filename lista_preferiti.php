<html>
    <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "homework1_db");
        $userId = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        $query = "SELECT * FROM users WHERE id = '".$userId."'";
        $res = mysqli_query($conn, $query);
        $userInfo = mysqli_fetch_assoc($res);
    ?>

        <head>
            <title> Lista preferiti </title>
            <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
            <link rel='stylesheet' href='lista_preferiti.css' />
            <script src='lista_preferiti.js' defer></script> 

            <meta name="viewport" content="width=device-width, initial-scale=1">

        </head>

        <body>
            <nav>
                <div id="links">
                    <a href="home.php"> Torna alla Home</a>
                    <a href="logout.php"> Logout</a>
                </div>
            </nav>

            <header>
                <div id="overlay"></div> 
                <div id="text">
                    <strong>Ecco la tua lista dei preferiti <?php echo $userInfo["nome"]."!" ?></strong>
                </div>
            </header>

            <article>
                <div id="profile"> 
                    <img src="https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-512.png"/> 
                    <p> <?php echo $userInfo["nome"]." ".$userInfo["cognome"]?> </p> 
                </div>

            </article>

            <section id="recensioni_preferite"> </section>

        </body>


</html>

<?php mysqli_close($conn); ?>