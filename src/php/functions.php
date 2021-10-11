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
    ]);     // query execution and search
    $result = $stmt->fetchAll();
    return $result;
}


function sendUserZeiten($pdo, $sql, $user_Id, $datum, $kommen, $gehen, $pause, $abwesungsGrundID){

    /*
    INSERT INTO zeit(zeit.users_ID, zeit.Datum, zeit.kommenZeit, zeit.gehenZeit, zeit.pause, zeit.abwesungsGrund_Id, zeit.akzeptiert)
    VALUES (1,'2021-09-20','09:12','17:15','00:30',1,0)
    ON DUPLICATE KEY UPDATE zeit.kommenZeit ='09:12', zeit.gehenZeit='17:15',zeit.pause='00:30',zeit.abwesungsGrund_Id=1,zeit.akzeptiert=0;
    */
/*
    $sql = "INSERT INTO zeit(zeit.users_ID, zeit.Datum, zeit.kommenZeit, zeit.gehenZeit, zeit.pause, zeit.abwesungsGrund_Id, zeit.akzeptiert)
 VALUES (:user_Id,:datum,:kommen,:gehen,:pause,:abwesungsGrund,0) 
ON DUPLICATE KEY UPDATE zeit.kommenZeit =:kommen,zeit.gehenZeit=:gehen,zeit.pause=:pause,zeit.abwesungsGrund_Id=:abwesungsGrund,zeit.akzeptiert=0;";
*/
    $stmt = $pdo -> prepare($sql);
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





