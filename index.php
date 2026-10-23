<?php
require_once 'assets/db.php';//Tillfälig kontroll.
require_once 'assets/sessioncheck.php';
require_once 'assets/functions.php';
session_start();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
 <p><a href ="search.php">Sök efter ord</a></p>

</body>
</html>