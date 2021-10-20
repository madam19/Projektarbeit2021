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
$rolles = $_REQUEST['rolles'] ?? "2";

var_dump($rolles );
die();

echo "<pre>";
var_dump($_REQUEST);


$pdo = getPdo();

if (isset($newUser)) {
    $sql = "INSERT INTO users(users.FamilienName, users.Vorname, users.email, users.password, users.personalNR,
                  users.Abteilung_ID, users.AM_ID, users.rolles_ID)
 VALUES (:FamilienName,:Vorname,:email,:password,:personalNR,:Abteilung, :arbeitsmodell, :rolles);";
    echo "new";
} else {
    $sql = "UPDATE users SET users.FamilienName = :FamilienName,users.Vorname=:Vorname, users.email=:email,
                        users.password= :password, users.personalNR =:personalNR, users.Abteilung_ID= :Abteilung, 
                        users.AM_ID = :arbeitsModell, users.rolles_ID =:rolles WHERE users.users_ID=:users_ID;";
    //echo "updating";
};

// get data this users

$result = sendUserData($pdo, $sql, $users_ID, $FamilienName, $Vorname, $email, $password, $arbeitsModell,
    $rolles, $Abteilung, $personalNR);


var_dump($result);
echo "</pre>";
//header('Location: http://localhost:8080/Projektarbeit2021/src/php/alleMitarbeiter.php');