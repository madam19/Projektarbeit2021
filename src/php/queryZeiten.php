<?php
session_start();
require_once "functions.php";

// monat und jahr zuweisen ($_REQUEST)
$email = $_SESSION['email'];
$monat = $_REQUEST['month'];
$jahr = $_REQUEST['year'];


// PDO object
$pdo = getPdo();


// query 1: users daten
$sql1 = "SELECT * FROM users WHERE email = :email"; // userdaten abfragen
//
$daten =  getUserData($pdo, $sql1, $email); // ergebnis aus sql1

$result["userdaten"] = $daten;


// [
//    "users_ID" => $daten ->users_ID,
//    "FamilienName"=>$daten->FamilienName,
//    "Vorname"=>$daten->Vorname,
//    "email" => $daten->email,
//    "personalNR"=>$daten->personalNR,
//    "Abteilung_ID"=>$daten->Abteilung_ID,
//    "AM_ID"=>$daten->AM_ID,
//    "rolles_ID"=>$daten->rolles_ID
//];


// sql query: email and date
   $sql2 ="SELECT * FROM zeit, users WHERE users.email = :email AND users.users_ID= zeit.users_ID AND MONTH (zeit.Datum)= :monat AND YEAR(zeit.Datum)  = :jahr";

//$stmt = $pdo->prepare($sql);

        $daten2 = getUserZeiten($pdo, $sql2, $email, $monat, $jahr);

$result["zeiten"] = $daten2;
// echo ergebnis
echo json_encode($result);


//SELECT zeit.users_ID as `users_ID`, zeit.Datum as `Datumatum`, zeit.kommenZeit as 'kommenZeit', zeit.gehenZeit as 'gehenZeit', zeit.pause as 'pause',
//(SELECT abwesungsgrund.abwesungsGrund_name FROM abwesungsGrund) AS `abwesungsGrund` , `akzeptiert` FROM `zeit` WHERE 1