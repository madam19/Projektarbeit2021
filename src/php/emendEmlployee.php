<?php
session_start();
require_once "functions.php";
$user = $_REQUEST["user"];

$pdo = getPdo();
    $sql = "SELECT users.users_ID, users.FamilienName, users.Vorname, users.email, users.password, users.personalNR, arbeitsmodell.stundenWoche AS 'stunden',
users.AM_ID, arbeitsmodell.AM_Name AS 'arbeitsmodell', rolles.rollesName AS 'rolle', abteilung.NameAbteilung AS 'abteilung' FROM users, arbeitsmodell, rolles, abteilung
WHERE users.users_ID = :user AND arbeitsmodell.AM_ID=users.AM_ID AND users.Abteilung_ID=abteilung.Abteilung_ID AND users.rolles_ID=rolles.rolles_ID";
    // get data this users


    $result = getSectionUser($pdo, $sql, $user);



echo json_encode($result);