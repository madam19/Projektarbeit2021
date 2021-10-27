<?php
session_start();
require_once "functions.php";
$abteilung = $_REQUEST["abteilung"];

$pdo = getPdo();
if ($abteilung == "0") {
  $sql = "SELECT users.users_ID, users.FamilienName, users.Vorname, users.email, users.password, users.personalNR, arbeitsmodell.stundenWoche AS 'stunden',
users.AM_ID, arbeitsmodell.AM_Name AS 'arbeitsmodell', rolles.rollesName AS 'rolle', abteilung.NameAbteilung AS 'abteilung' FROM users, arbeitsmodell, rolles, abteilung
WHERE arbeitsmodell.AM_ID=users.AM_ID AND users.Abteilung_ID=abteilung.Abteilung_ID AND users.rolles_ID=rolles.rolles_ID;"; // get all users
  $result = getAllUser($pdo, $sql);
} else {
  $sql = "SELECT users.users_ID, users.FamilienName, users.Vorname, users.email, users.password, users.personalNR, arbeitsmodell.stundenWoche AS 'stunden',
users.AM_ID, arbeitsmodell.AM_Name AS 'arbeitsmodell', rolles.rollesName AS 'rolle', abteilung.NameAbteilung AS 'abteilung' FROM users, arbeitsmodell, rolles, abteilung
WHERE arbeitsmodell.AM_ID=users.AM_ID AND users.Abteilung_ID=abteilung.Abteilung_ID AND users.Abteilung_ID=:abteilung AND users.rolles_ID=rolles.rolles_ID;";
  // get users this abteilung
  $result = getSectionUser($pdo, $sql, $abteilung);
};



echo json_encode($result);
