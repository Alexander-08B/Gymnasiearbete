<?php
//Initierar sessionhantering.
session_start();

//Kontrollerar om sessionsvariabeln existerar.
if(!isset($_SESSION['username'])){
    
    //Skicka en användare till startsidan.
    header('Location: login.php');
}
?>