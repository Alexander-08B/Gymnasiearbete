<?php
require_once 'assets/functions.php';


if (isset($_POST['submit'])){
    $word = trim($_POST['word']);

    header('Location: word.php?word=' . urlencode($word));
    exit;
}//Test
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel = "stylesheet" href=""/> <!--Tillfälg-->
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Titel</h1>
            <p><a href ="logout.php">Logga ut</a></p>
            <!--Tillfälg struktur för navbar-->
        </div>
</header>

<!--Innehåll-->
<h1>Sök efter ord</h1>
    <form method="post" action="">
        <label for="name"></label>
        <input type="text" id="word" name="word" required>
        <br>
        <input type="submit" name="submit" value="Sök efter ord">
    </form>

</body>
</html>