<?php
session_start();
require_once "functions.php";

// monat und jahr zuweisen ($_REQUEST)
$email = $_SESSION['email'];
$monat = $_REQUEST['month'];
$jahr = $_REQUEST['year'];


// PDO object
$pdo = getPdo();


// query alle mitarbeiter in diesem Zeit raum
$sql1 = "SELECT * FROM users, arbeitsyeit WHERE MONTH = :monat AND YEAR = :jahr"; // userdaten abfragen
//

$result = getMonthData($pdo, $sql1, $monat, $jahr); // ergebnis aus sql1

// echo ergebnis
echo json_encode($result);
