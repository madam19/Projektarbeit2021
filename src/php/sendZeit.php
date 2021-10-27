<?php
session_start();
require_once "functions.php";
// get all data
$kommen = $_REQUEST['kommenZeit'];
$gehen = $_REQUEST['gehenZeit'];
$pause = $_REQUEST['pause'];
$datum = $_REQUEST['datum'];
$abwesungsGrundID = $_REQUEST['abwesungsGrundID'];
$user_Id = $_SESSION['users_ID'];
/*
var_dump($_REQUEST);
var_dump($user_Id);
die();*/

$pdo = getPdo();

sendUserZeiten($pdo, $user_Id, $datum, $kommen, $gehen, $pause, $abwesungsGrundID);
// echo ergebnis
//echo $result;
//die();



/*array(5) {
    ["kommenZeit"]=>
  string(5) "17:00"
    ["gehenZeit"]=>
  string(5) "00:00"
    ["datum"]=>
  string(10) "2021-10-11"
    ["pause"]=>
  string(5) "00:30"
    ["abwesungsGrundID"]=>
  string(1) "1"
}*/
