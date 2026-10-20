<?php
//Initierar sessionshantering.
session_start();

//Raderar all information i sessionsvariabler.
session_unset();

//Avslutar den aktuella sessionen.
session_destroy();

//Skickar en användare till startsidan.
header('Location: index.php');
?>