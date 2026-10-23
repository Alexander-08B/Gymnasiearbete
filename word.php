<?php
require_once 'assets/functions.php';
session_start();

$records = null;
$word = trim($_GET['word'] ?? '');

if ($word !== '') {
    $records = searchWord($word);
}//Test
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ord</title>
    <link rel = "stylesheet" href=""/> <!--Tillfälg-->
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Titel</h1>
            <p><a href ="logout.php">Logga ut</a></p>
            <p><a href ="index.php">Index</a></p>
            <!--Tillfälg struktur för navbar-->
        </div>
</header>

<!--Innehåll-->
 <table id="dbres">
            <tr>
                <th>Ord</th>
                <th>Ord typ</th>
            </tr>
 <?php do { ?>
                <tr>
                    <td><?php echo ($wrd['ord']); ?></td>
                    <td><?php echo nl2br($wrd['ord_typ']); ?></td>
                </tr>

            <?php } while ($wrd = $records->fetch(PDO::FETCH_ASSOC)); ?>
        </table>

</body>
</html>