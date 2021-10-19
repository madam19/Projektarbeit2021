<?php
session_start();
require_once "functions.php";

// http://localhost:8080/Projektarbeit2021/src/php/sendZeit?kommenZeit=1&gehenZeit=2&pause=3&datum=4&abwesungsGrundID=5&users_ID=7
/*
if(!isset($_SESSION['authorized']) || $_SESSION['authorized'] === false){
    session_destroy();
    //header() -> startseite
}*/

$kommen = $_REQUEST['kommenZeit'];
$gehen = $_REQUEST['gehenZeit'];
$pause =$_REQUEST['pause'];
$datum = $_REQUEST['datum'];
$abwesungsGrundID = $_REQUEST['abwesungsGrundID'];
$user_Id = $_SESSION['users_ID'];


//
//echo "usersID: ". $user_Id;
//die();


$pdo = getPdo();

$sql = "INSERT INTO zeit(zeit.users_ID, zeit.Datum, zeit.kommenZeit, zeit.gehenZeit, zeit.pause, zeit.abwesungsGrund_Id, zeit.akzeptiert)
 VALUES (:user_Id,:datum,:kommen,:gehen,:pause,:abwesungsGrund,0) 
ON DUPLICATE KEY UPDATE zeit.kommenZeit =:kommen,zeit.gehenZeit=:gehen,zeit.pause=:pause,zeit.abwesungsGrund_Id=:abwesungsGrund,zeit.akzeptiert=0;";

/*echo $sql;
die();*/

$result = sendUserZeiten($pdo, $sql, $user_Id, $datum, $kommen, $gehen, $pause, $abwesungsGrundID);
// echo ergebnis
 echo json_encode($result);
