<?php
require_once 'assets/functions.php';
session_start();

$wordInfo = [];

if (isset($_GET['word'])) {

    $search = trim($_GET['word']);

    if ($search !== '') {

        // Hitta ordets ID
        $record = searchWord($search);

        // Hämta information om ordet
        if ($record) {
            $wordInfo = getWordInfo($record['ord_id']);
        }
    }
}
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
<?php if (!empty($wordInfo)): ?>

<table id="dbres">

    <tr>
        <th>Ord</th>
        <td><?= htmlspecialchars($wordInfo[0]['ord'] ?? '') ?></td>
    </tr>

    <tr>
        <th>Ordtyp</th>
        <td><?= htmlspecialchars($wordInfo[0]['ord_typ'] ?? '') ?></td>
    </tr>

    <tr>
        <th>Definition</th>
        <td>
            <?php foreach ($wordInfo as $wrd): ?>
                <p><?= htmlspecialchars($wrd['definition'] ?? '') ?></p>
            <?php endforeach; ?>
        </td>
    </tr>

    <tr>
        <th>Exempelmeningar</th>
        <td>
            <?php foreach ($wordInfo as $wrd): ?>
                <?php foreach (explode('|', $wrd['exempelmeningar'] ?? '') as $mening): ?>
                    <?php if ($mening !== ''): ?>
                        <p><?= htmlspecialchars($mening) ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </td>
    </tr>

    <tr>
        <th>Synonymer</th>
        <td>
            <?php $rT = explode('|', $wordInfo[0]['relationstyp'] ?? ''); $oR = explode('|', $wordInfo[0]['ordrelation'] ?? '');?>
                <?php foreach ($oR as $index => $ordet): ?>
                    <?php if (isset($rT[$index]) && $rT[$index] === 'synonym'): ?>
                        <p><?= htmlspecialchars($ordet) ?></p>
                         <?php endif; ?>
                <?php endforeach; ?>
        </td>
    </tr>

    <tr>
        <th>Antonymer</th>
        <td>
            <?php $rT = explode('|', $wordInfo[0]['relationstyp'] ?? ''); $oR = explode('|', $wordInfo[0]['ordrelation'] ?? '');?>
                <?php foreach ($oR as $index => $ordet): ?>
                    <?php if (isset($rT[$index]) && $rT[$index] === 'antonym'): ?>
                        <p><?= htmlspecialchars($ordet) ?></p>
                         <?php endif; ?>
                <?php endforeach; ?>
        </td>
    </tr>


</table>

<?php else: ?>

    <p>Ordet kunde inte hittas.</p>

<?php endif; ?>
</body>
</html>