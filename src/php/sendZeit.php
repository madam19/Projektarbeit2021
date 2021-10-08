<?php
require_once "functions.php";


$kommen = $_REQUEST['kommenZeit'];
$gehen = $_REQUEST['gehenZeit'];
$pause =$_REQUEST['pause'];
$datum = $_REQUEST['datum'];
$abwesungsGrund = $_REQUEST['abwesungsGrund'];

//echo $kommen." ".$gehen. " ". $pause." ".$datum. " ". $abwesungsGrund;
//die();

// monat und jahr zuweisen ($_REQUEST)



// PDO object

$pdo = getPdo();

//$query = "SELECT from Zeiten where user = ... and datum ="


// sql query , kontrol email, ID user and date
$sql = "SELECT IF(EXISTS (SELECT * FROM zeit WHERE zeit.users_ID=1 AND zeit.Datum =:datum )
THEN
  UPDATE zeit SET (zeit.users_ID=:user_Id,zeit.Datum=:datum,zeit.kommenZeit=:kommen,zeit.gehenZeit=:gehen,zeit.pause=:pause,zeit.abwesungsGrund_Id=:abwesungsGrund, zeit.akzeptiert='0')
          WHERE (zeit.users_ID=:user_Id AND zeit.Datum =:datum )
ELSE
    INSERT INTO zeit(`users_ID`, `Datum`, `kommenZeit`, `gehenZeit`, `pause`, `abwesungsGrund_Id`, `akzeptiert`) VALUES (:user_Id,:datum,:konnen,:gehen,:pause,:abwesungsGrund,'0')
;";

//$sql = "INSERT INTO zeit() VALUES () ON DUPLICATE KEY UPDATE ";


$result = sendUserZeiten($pdo, $sql, $user_Id, $key, $value);
// echo ergebnis


echo json_encode($result);