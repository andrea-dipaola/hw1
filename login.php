<?php
    session_start();
    if(isset($_SESSION["username"])){
        header("Location: home.php");
        exit;
    }
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $conn = mysqli_connect("localhost", "root", "", "homework1_db");
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $query = "SELECT id, username, password FROM users WHERE username = '".$username."'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0){ 
            $entry = mysqli_fetch_assoc($res);         
            
            if(password_verify($_POST["password"], $entry["password"])) {
                $_SESSION["username"] = $entry["username"];
                $_SESSION["user_id"] = $entry["id"];
                header("Location: home.php");
                mysqli_close($conn);
                exit;
            }else{
                echo "Username o password errate";
            }
        }else{
            $errore = true;
        }
    }
?>

<html>
    <head>
        <title> Login </title>
        <link rel="stylesheet" href="login.css" />
        <script src='login.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <?php
            if(isset($errore)){
                echo "<p> Credenziali non valide </p>";
            }
        ?>

        <main>
            <div id="overlay"></div> 
            <form name='login_form' method='post'>
                <p>
                    <label> Username <input type='text' name='username'> </label> 
                </p>
                <p> 
                    <label> Password <input type='password' name='password'> </label>
                </p>
                <p>
                    <label> <input type='submit' value="Accedi"> </label> <br>
                </p>
                <p>
                   Non hai un account? <a href = 'signup.php'> Registrati </a>
                </p>
            </form>

        </main>


    </body>

</html>