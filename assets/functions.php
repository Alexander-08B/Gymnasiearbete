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
