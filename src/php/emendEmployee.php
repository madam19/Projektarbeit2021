<?php
session_start();
require_once "functions.php";

$users_ID = $_REQUEST['id'];

$pdo = getPdo();
       // get data this users
  $result = getUserDataID($pdo,  $users_ID);

echo json_encode($result);