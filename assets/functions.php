<?php
require_once 'db.php';

function login($username, $password) {
    global $ordbank;

    $sql = "SELECT * FROM anvandare WHERE anvandarnamn = :username";
    $stmt = $ordbank->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['losenord'])) {
        return true;
    } else {
        return false;
    }
}

function getUser($username){
    global $ordbank;

    $sql = "SELECT * FROM anvandare WHERE anvandarnamn = :username";

    $stmt = $ordbank->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addUser($felt){
    global $ordbank;

    $sql = "INSERT INTO anvandare(anvandarnamn, email, losenord)
            VALUES (:username, :email, :password)";

    $stmt = $ordbank->prepare($sql);

    $stmt->bindValue(':username', $felt['username']);
    $stmt->bindValue(':email', $felt['email']);
    $stmt->bindValue(':password', $felt['password']);

    try {
        return $stmt->execute();
    }
    catch(Exception $e) {
        return false;
    }
}

function searchWord($search){
    global $ordbank;

    $sql = "SELECT ord, ord_id FROM ord WHERE ord = :search";

    $stmt = $ordbank->prepare($sql);

    $stmt->bindValue(':search', $search,PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getWordInfo($wordId){
    global $ordbank;

    $sql = "SELECT
    ord.ord_id,
    ord.ord,
    ord.ord_typ,
    definition.def_id,
    definition.definition,
    GROUP_CONCAT(
        ex_mening.mening
        SEPARATOR '|'
    ) AS exempelmeningar

FROM ord

LEFT JOIN definition
    ON ord.ord_id = definition.ord_id

LEFT JOIN ex_mening
    ON definition.def_id = ex_mening.def_id

WHERE ord.ord_id = :wordId

GROUP BY
    ord.ord_id,
    ord.ord,
    ord.ord_typ,
    definition.def_id,
    definition.definition";

    $stmt = $ordbank->prepare($sql);

    $stmt->bindValue(':wordId', $wordId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Sökning på endast ordet prov
// SELECT * FROM `ord` INNER JOIN definition ON ord.ord_id = definition.ord_id WHERE ord = 'prov';
//$sql = "SELECT * FROM ord INNER JOIN definition ON ord.ord_id = definition.ord_id WHERE ord = :word";

// Sökning på definitioner som innehåller ordet "eller"
// SELECT * FROM `ord` INNER JOIN definition ON ord.ord_id = definition.ord_id WHERE definition.definition LIKE '%eller%';

//SQL-fråga för att hämta ord, definitioner, exMeningar och ord typ
/*SELECT//Väljer den information som ska hämtas
    ord.ord_id,
    ord.ord,
    ord.ord_typ,
    definition.def_id,
    definition.definition,
    GROUP_CONCAT(//Sammanfogar en definitions befintliga exM till en och samma rad.
        ex_mening.mening
        SEPARATOR '|'
    ) AS exempelmeningar//Alias.

FROM ord//Utgångspunkt

LEFT JOIN definition
    ON ord.ord_id = definition.ord_id//Kopplar ihop tabellerna via ord_id(villkor)

LEFT JOIN ex_mening
    ON definition.def_id = ex_mening.def_id//Kopplar ihop tabellerna via def_id(villkor)

WHERE ord.ord_id = '1'//Hämtar endast information från rad 1.

GROUP BY//Grupperar utifrån de angivna kolumnerna.
    ord.ord_id,
    ord.ord,
    ord.ord_typ,
    definition.def_id,
    definition.definition;*/