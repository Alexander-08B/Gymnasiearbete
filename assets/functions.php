<?php
require_once 'assets/db.php';

function login($username, $password) {
    global $ordbank;

    $sql = "SELECT * FROM anvandare WHERE anvandarnamn = :username";
    $stmt = $ordbank->prepare($sql);
    $stmt->bindvalue(':username', $username);
    $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(password_verify($password, $user['losenord'])){
        return true;

        } else false;
    }

function getUser($username){
    global $ordbank;

    $sql = "SELECT * FROM anvandare WHERE anvandarnamn = :username";

    $stmt = $ordbank->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>