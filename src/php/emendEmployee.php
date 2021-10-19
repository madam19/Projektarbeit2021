<?php
session_start();
require_once "functions.php";

$users_ID = $_REQUEST['id'];

$pdo = getPdo();
    $sql = "SELECT users.users_ID, users.FamilienName, users.Vorname, users.email, users.password, users.personalNR, arbeitsmodell.stundenWoche AS 'stunden',
users.AM_ID, arbeitsmodell.AM_Name AS 'arbeitsmodell', rolles.rollesName AS 'rolle', abteilung.NameAbteilung AS 'abteilung' FROM users, arbeitsmodell, rolles, abteilung
WHERE users.users_ID = :users_ID AND arbeitsmodell.AM_ID=users.AM_ID AND users.Abteilung_ID=abteilung.Abteilung_ID AND users.rolles_ID=rolles.rolles_ID";
    // get data this users


    $result = getUserDataID($pdo, $sql, $users_ID);



echo json_encode($result);