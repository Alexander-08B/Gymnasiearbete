<?php
$hostname_ordbank = "localhost";
$database_ordbank = "ordbank";
$username_ordbank = "ordbank";
$password_ordbank = "ordbank";


try {
  $ordbank = new PDO("mysql:host=$hostname_ordbank;dbname=$database_ordbank", $username_ordbank, $password_ordbank);
  // set the PDO error mode to exception
  $ordbank->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; // denna rad kan tas bort om allt fungerar
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
