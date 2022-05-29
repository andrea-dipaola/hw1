<?php
    session_start();
    if(!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["password"])){
        $error = array();
        $conn = mysqli_connect("localhost", "root", "", "homework1_db");
        //username
        if(!preg_match('/^[a-z0-9_-]{3,15}$/', $_POST["username"])){
            $error[] = "Username non valido";
        }else{
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $query = "SELECT username FROM users WHERE username = '".$username."'";
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) > 0){
                $error[] = "Username già esistente";
            }
        } 
        //password
        if(strlen($_POST["password"]) < 8){
            $error[] = "Caratteri non sufficienti";
        }
        //email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $error[] = "Email non valida";
        }else{
            $email = mysqli_real_escape_string($conn, strtolower($_POST["email"]));
            $email_query = "SELECT email FROM users WHERE email = '".$email."'";
            $res = mysqli_query($conn, $email_query);
            if(mysqli_num_rows($res) > 0){
                $error[] = "Email già utilizzata";
            }
        }

        if(count($error) == 0){
            $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
            $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
            //$email = mysqli_real_escape_string($conn, $_POST["email"]);
            //$username = mysqli_real_escape_string($conn, $_POST["username"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $password = password_hash($password, PASSWORD_BCRYPT);
    
            $query = "INSERT INTO users(nome, cognome, email, username, password) VALUES ('$nome', '$cognome', '$email', '$username', '$password')";
    
            if(mysqli_query($conn, $query)){
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                header("Location: home.php");
                mysqli_close($conn);
                exit;   
            }else{
                $error[] = "Errore di connessione al database";
            }
        }

        mysqli_close($conn); 
        
    }
?>

<html>
    <head>
        <title> Iscriviti </title>
        <link rel='stylesheet' href='signup.css' />
        <script src='signup.js' defer></script> 

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <main>
            <div id="overlay"> </div>
            <form name="signup_form" method="post">
                <p> 
                    <label>Nome <input type="text" name="nome" class="nome_input"> </label> 
                    <span id="nome_span"></span>
                </p>
                <p> 
                    <label>Cognome <input type="text" name="cognome" class="cognome_input"> </label> 
                    <span id="cognome_span"></span>
                </p>
                <p> 
                    <label>E-mail <input type="text" name="email" class="email_input"> </label> 
                    <span id="email_span"></span>
                </p>
                <p> 
                    <label>Username <input type="text" name="username" class="username_input"> </label> 
                    <span id="user_span"></span>
                </p>
                <p> 
                    <label>Password <input type="password" name="password" class="password_input"> </label> 
                    <span id="password_span"></span>
                </p>
                <p> <label> <input type="submit" value="Accedi"> </label> </p>
                <p> Hai un account? <a href="login.php"> Accedi </a> </p>
            </form>

        </main>
        
        
    </body>


</html>