<?php

function getPdo(){
    // подключение к бд
    $dsn = 'mysql:dbname=knmde_db85;host=dedi154.your-server.de;charset=utf8';
    $user = 'knmde_85';
    $pass = "gM5FGuqWab52QzqT";

    $pdo = new PDO($dsn, $user, $pass);
    return $pdo;
}
function getUser($pdo, $query, $email)
{
    /** @var PDO $pdo */
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":email" => $email

    ]);     // выполнение запроса и поиск
    $result = $stmt->fetchAll();
    return $result;
}

function getUserZeiten($pdo, $query, $email, $monat, $jahr){
    /** @var PDO $pdo */
    $stmt = $pdo -> prepare($query);
    $stmt->execute([
        ":email" => $email,
        ":monat" => $monat,
        ":jahr" => $jahr
    ]);     // выполнение запроса и поиск
    $result = $stmt->fetchAll();
    return $result;
}
function sendUserZeiten($pdo, $sql, $user_Id, $key, $value){

    $stmt = $pdo -> prepare($sql);
    $stmt->execute([
        ":user_Id" => $user_Id,
        ":key" => $key,
        ":value" => $value
    ]);     // выполнение запроса и поиск
    $result = $stmt->fetchAll();
    return $result;
}



//function inputDaten ($str, $placeholder){
//    ?>
<!--    <input type="text" name="$str"  placeholder= " --><?php //echo $placeholder ?><!-- " onkeydown="handleInput(this)" onblur="sendValue()"-->
<!--           value="--><?//=$_GET['$str'] ?? ''?><!--" >-->
<!--    --><?php
//    return $_GET;
//}



