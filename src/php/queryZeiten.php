<?php
session_start();
require_once "functions.php";

// monat und jahr zuweisen ($_REQUEST)
$email = $_SESSION['email'];
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];

// PDO object

$pdo = getPdo();

//$query = "SELECT from Zeiten wherer user = ... and datum ="

// sql query
   $sql ="SELECT * FROM zeit, users, arbeitsmodell WHERE users.email = :email AND users.users_ID= zeit.users_ID 
                                           AND users.AM_ID = arbeitsmodell.AM_ID" ;
        $result = getUserZeiten($pdo, $sql, $email);
// echo ergebnis

//$result = null;

echo json_encode($result);