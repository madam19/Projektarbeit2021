<?php

function getPdo()
{
  // подключение к бд
  $dsn = 'mysql:dbname=knmde_db85;host=dedi154.your-server.de;charset=utf8';
  $user = 'knmde_85';
  $pass = "gM5FGuqWab52QzqT";

  return new PDO($dsn, $user, $pass);
}

function getUser($pdo, $query, $email, $password)
{
  /** @var PDO $pdo */
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    ":email" => $email,
    ":password" => $password
  ]);     // query execution and search
  return $stmt->fetchAll();
}

function getAllUser($pdo, $query)
{
  /** @var PDO $pdo */
  $stmt = $pdo->prepare($query);
  $stmt->execute([]);     // query execution and search
  return $stmt->fetchAll();
}

function getUserData($pdo, $query, $email)
{
  /** @var PDO $pdo */
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    ":email" => $email

  ]);     // query execution and search
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getUserZeiten($pdo, $query, $email, $monat, $jahr)
{

  /** @var PDO $pdo */
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    ":email" => $email,
    ":monat" => $monat,
    ":jahr" => $jahr
  ]);     // query execution and search
  return $stmt->fetchAll();
}


function sendUserZeiten($pdo, $sql, $user_Id, $datum, $kommen, $gehen, $pause, $abwesungsGrundID)
{


  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    "user_Id" => $user_Id,
    "datum" => $datum,
    "kommen" => $kommen,
    "gehen" => $gehen,
    "pause" => $pause,
    "abwesungsGrund" => $abwesungsGrundID
  ]);     // query execution and search
  $result = $stmt->fetchAll();
  return $result;
}


function getMonthData($pdo, $sql, $monat, $jahr)
{

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    "monat" => $monat,
    "jahr" => $jahr

  ]);     // query execution and search
  $result = $stmt->fetchAll();
  return $result;
}
