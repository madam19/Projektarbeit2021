<?php
session_start();
require_once "functions.php";
$users_ID = $_REQUEST['users_ID'] ?? "";
$FamilienName = $_REQUEST['FamilienName'] ?? "";
$Vorname = $_REQUEST['Vorname'] ?? "";
$email = $_REQUEST['email'] ?? "";
$password = $_REQUEST['password'] ?? "";
$personalNR = $_REQUEST['personalNR'] ?? "";
$Abteilung = $_REQUEST['abteilung'] ?? "";
$arbeitsModell = $_REQUEST['ArbeitsModell'] ?? "3";

if (isset($_REQUEST['rolles']) && $_REQUEST['rolles']=="on")
{
    $rolles ="1";
//    var_dump($rolles);
} else {
    $rolles = "2";
}
//var_dump($rolles);
//die();
//echo "<pre>";
$pdo = getPdo();
if ($users_ID === "") {
    insertUser($pdo, $FamilienName, $Vorname, $email, $password,
        $personalNR, $Abteilung, $arbeitsModell, $rolles);
    echo "new";
} else {
    updateUser($pdo, $users_ID, $FamilienName, $Vorname, $email, $password,
        $personalNR, $Abteilung, $arbeitsModell, $rolles);
    echo "updating";
};
// get data this users

//echo "</pre>";

header('Location: http://localhost:8080/Projektarbeit2021/src/php/alleMitarbeiter.php');