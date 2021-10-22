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
     $stmt = $pdo->prepare($query);
    $stmt->execute();     // query execution and search
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserData($pdo, $query, $email)
{
      $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":email" => $email

    ]);     // query execution and search
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//
}

function getUserDataID($pdo, $users_ID)
{
    $query = "SELECT users.users_ID, users.FamilienName, users.Vorname, users.email, users.password, users.personalNR,users.Abteilung_ID, arbeitsmodell.stundenWoche AS 'stunden',
users.AM_ID, users.rolles_ID,  arbeitsmodell.AM_Name AS 'arbeitsmodell', rolles.rollesName AS 'rolle', abteilung.NameAbteilung AS 'abteilung', userArbeitsModell.Montag, userArbeitsModell.Dienstag, userArbeitsModell.Mittwoch, userArbeitsModell.Donnerstag, userArbeitsModell.Freitag 
FROM users, arbeitsmodell, rolles, abteilung, userArbeitsModell
WHERE users.users_ID = :users_ID AND arbeitsmodell.AM_ID=users.AM_ID AND users.Abteilung_ID=abteilung.Abteilung_ID AND users.rolles_ID=rolles.rolles_ID AND users.users_ID=userArbeitsModell.fk_users_ID;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        "users_ID" => $users_ID

    ]);     // query execution and search
    return $stmt->fetchAll();
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


function sendUserZeiten($pdo, $user_Id, $datum, $kommen, $gehen, $pause, $abwesungsGrundID)
{

    $sql = "INSERT INTO zeit(zeit.users_ID, zeit.Datum, zeit.kommenZeit, zeit.gehenZeit, zeit.pause, zeit.abwesungsGrund_Id, zeit.akzeptiert)
 VALUES (:user_Id,:datum,:kommen,:gehen,:pause,:abwesungsGrund,0) 
ON DUPLICATE KEY UPDATE zeit.kommenZeit =:kommen,zeit.gehenZeit=:gehen,zeit.pause=:pause,zeit.abwesungsGrund_Id=:abwesungsGrund,zeit.akzeptiert=0;";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "user_Id" => $user_Id,
        "datum" => $datum,
        "kommen" => $kommen,
        "gehen" => $gehen,
        "pause" => $pause,
        "abwesungsGrund" => $abwesungsGrundID
    ]);     // query execution and search


}


function getMonthData($pdo, $monat, $jahr)
{
// query alle mitarbeiter in diesem Zeit raum
    $sql = "SELECT * FROM zeit, users
WHERE EXTRACT(YEAR FROM zeit.Datum) = :jahr AND EXTRACT(MONTH FROM zeit.Datum) = :monat;"; // userdaten abfragen
//

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "monat" => $monat,
        "jahr" => $jahr

    ]);     // query execution and search

    return $stmt->fetchAll();
}

function getSectionUser($pdo, $sql, $abteilung)
{

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":abteilung" => $abteilung
    ]);     // query execution and search
    $result = $stmt->fetchAll();
    return $result;
}

function inputEmployee($input, $key)
{
    if (!isset($input[0][$key])) {
        $result = "";
    } else {
        $result = $input[0][$key];
    }
    return $result;
}




function insertUser($pdo, $FamilienName, $Vorname, $email, $password,
                      $personalNR, $Abteilung, $arbeitsModell, $rolles)
{
    $sql = "INSERT INTO users(users.FamilienName, users.Vorname, users.email, users.password, users.personalNR,
                  users.Abteilung_ID, users.AM_ID, users.rolles_ID)
            VALUES (:FamilienName,:Vorname,:email,:password,:personalNR,:Abteilung, :arbeitsModell, :rolles);";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "FamilienName" => $FamilienName,
        "Vorname" => $Vorname,
        "email" => $email,
        "password" => $password,
        "personalNR" => $personalNR,
        "Abteilung" => $Abteilung,
        "arbeitsModell" => $arbeitsModell,
        "rolles" => $rolles


    ]);     // query execution and search

}

function updateUser($pdo, $users_ID, $FamilienName, $Vorname, $email, $password,
                      $personalNR, $Abteilung, $arbeitsModell, $rolles )
{

    $sql = "UPDATE users SET users.FamilienName = :FamilienName,users.Vorname=:Vorname, users.email=:email,
                        users.password= :password, users.personalNR =:personalNR, users.Abteilung_ID= :Abteilung, 
                        users.AM_ID = :arbeitsModell, users.rolles_ID =:rolles WHERE users.users_ID=:users_ID;";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "users_ID" => $users_ID,
        "FamilienName" => $FamilienName,
        "Vorname" => $Vorname,
        "email" => $email,
        "password" => $password,
        "personalNR" => $personalNR,
        "Abteilung" => $Abteilung,
        "arbeitsModell" => $arbeitsModell,
        "rolles" => $rolles


    ]);

}
 function updateWorkTime($pdo,$users_ID, $arbeitsModell, $Montag, $Dienstag, $Mittwoch, $Donnerstag, $Freitag )
 {
     $sql = "INSERT INTO userArbeitsModell(fk_ArbeitsModel, fk_users_ID, Montag, Dienstag, Mittwoch, Donnerstag, Freitag)
 VALUES (:arbeitsModell,:users_ID,:Montag,:Dienstag,:Mittwoch,:Donnerstag,:Freitag) 
ON DUPLICATE KEY UPDATE Montag =:Montag , Dienstag=:Dienstag, Mittwoch=:Mittwoch, Donnerstag=:Donnerstag, Freitag=:Freitag;";

     $stmt = $pdo->prepare($sql);
     $stmt->execute([
         "users_ID" =>$users_ID,
         "arbeitsModell" => $arbeitsModell,
         "Montag" => $Montag,
         "Dienstag" => $Dienstag,
         "Mittwoch" => $Mittwoch,
         "Donnerstag" => $Donnerstag,
         "Freitag" => $Freitag]);


 }