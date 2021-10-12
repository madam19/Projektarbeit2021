<?php
session_start();
require_once "functions.php";

// monat und jahr zuweisen ($_REQUEST)
$email = $_SESSION['email'];
$monat = $_REQUEST['month'];
$jahr = $_REQUEST['year'];


// PDO object

$pdo = getPdo();

//$query = "SELECT from Zeiten where user = ... and datum ="


// sql query , kontrol email, ID user and date
   $sql ="SELECT * FROM zeit, users, arbeitsmodell WHERE users.email = :email AND users.users_ID= zeit.users_ID 
                                           AND users.AM_ID = arbeitsmodell.AM_ID AND MONTH (zeit.Datum)= :monat AND YEAR(zeit.Datum)  = :jahr
                                          " ;

   //$stmt = $pdo->prepare($sql);

        $result = getUserZeiten($pdo, $sql, $email, $monat, $jahr);
// echo ergebnis

//$result = null;

echo json_encode($result);


//SELECT zeit.users_ID as `users_ID`, zeit.Datum as `Datumatum`, zeit.kommenZeit as 'kommenZeit', zeit.gehenZeit as 'gehenZeit', zeit.pause as 'pause',
//(SELECT abwesungsgrund.abwesungsGrund_name FROM abwesungsGrund) AS `abwesungsGrund` , `akzeptiert` FROM `zeit` WHERE 1