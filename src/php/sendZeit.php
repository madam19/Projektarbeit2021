<?php

require_once "functions.php";

// monat und jahr zuweisen ($_REQUEST)
$Datum = $_REQUEST['datum'];
$user_Id = $_REQUEST['id'];
$key = $_REQUEST ['key'];
$value = $_REQUEST['value'];

// PDO object

$pdo = getPdo();

//$query = "SELECT from Zeiten where user = ... and datum ="


// sql query , kontrol email, ID user and date
$sql = "INSERT INTO `zeit`(`users_ID`, `Datum`, :key) 
                   VALUES (:user_Id,:Datum,:value)";


$result = sendUserZeiten($pdo, $sql, $user_Id, $key, $value);
// echo ergebnis



echo json_encode($result);