<?php
session_start();
require_once "functions.php";

// monat und jahr zuweisen ($_REQUEST)
$email = $_SESSION['email'];
$monat = $_REQUEST['month'];
$jahr = $_REQUEST['year'];

// PDO object
$pdo = getPdo();

$result = getMonthData($pdo, $monat, $jahr); // ergebnis aus sql1

// echo ergebnis
echo json_encode($result);
