<?php
require_once 'assets/functions.php';
session_start();

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = $_POST['password'];
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    //Ev. tilläg av roller.

    $filter = array('username' => $username, 'password' => $password);
    print_r($filter);//Tillfälligt.

    if(login($username, $password))
        {
            $user = getUser($username);

            $_SESSION['username'] = $user['anvandarnamn'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['losenord'];
            header('Location: index.php');
            exit();
        }
        else
        {
            echo "Ogiltigt användarnamn eller lösenord";
        }
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logga in</title>
    <link rel = "stylesheet" href=""/> <!--Tillfälg-->
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Titel</h1>
            <!--Tillfälg struktur för navbar-->
        </div>
</header>
<form method="post" action="">
        <label for="username">Användarnamn:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Lösenord:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p><a href="signup.php">Har du inget konto?</a></p>
</body>
</html>