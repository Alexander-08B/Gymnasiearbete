<?php
require_once 'assets/functions.php';
session_start();
$error = false;

if(isset($_POST['submit'])){
    if(isset($_POST['username']) && $_POST['username'] != "" &&
        isset($_POST['email']) && $_POST['email'] != "" &&
        isset($_POST['password']) && $_POST['password'] != ""){

            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            //Ev. tilläg av roller.
            $password = $_POST['password'];
            $password = password_hash($password,PASSWORD_DEFAULT);

            $filter = array('username' => $username, 'email' => $email, 'password' => $password);

            if(addUser($filter)){ 
                $_SESSION['username']= $username;
                $_SESSION['email']= $email;
                $_SESSION['password']= $password;
                header("Location: index.php");
            }
            else{
                $error = true;
            }
        } else{
            $error = false;
        }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrering</title>
    <link rel = "stylesheet" href=""/> <!--Tillfälg-->
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Titel</h1>
            <!--Tillfälg struktur för navbar-->
        </div>
</header>
    <?php
    if($error)
        echo "<p>Kontrollera dina uppgifter</p>";
    ?>
    <form method="post" action="">
        <label for="username">Användarnamn: </label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Lösenord: </label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p><a href="login.php">Har du redan ett konto?</a></p>
</body>
</html>