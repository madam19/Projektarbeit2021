<?php
session_start();
require_once "functions.php";

// monat und jahr zuweisen ($_REQUEST)
$email = $_SESSION['email'];
$monat = $_REQUEST['month'];
$jahr = $_REQUEST['year'];
//var_dump($_REQUEST);

// PDO object
$pdo = getPdo();


// query 1: users daten
$sql1 = "SELECT * FROM users, userArbeitsModell, arbeitsmodell WHERE users.email = :email AND userArbeitsModell.fk_users_ID=users.users_ID AND arbeitsmodell.AM_ID=userArbeitsModell.fk_ArbeitsModel;";
//
$daten = getUserData($pdo, $sql1, $email); // ergebnis aus sql1

$result["userdaten"] = $daten;


// sql query: email and date
   $sql2 ="SELECT * FROM zeit, users WHERE users.email = :email AND users.users_ID= zeit.users_ID AND MONTH (zeit.Datum)= :monat AND YEAR(zeit.Datum)  = :jahr";

//$stmt = $pdo->prepare($sql);

        $daten2 = getUserZeiten($pdo, $sql2, $email, $monat, $jahr);

$result["zeiten"] = $daten2;
// echo ergebnis

echo json_encode($result);

