

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MyData</title>
</head>

<body>


<?php
// kontrol email and password

$errors = [];
$email = $_REQUEST['emailUser'];
$dsn = 'mysql:dbname=knmde_db85;host=dedi154.your-server.de;charset=utf8';
$user = 'knmde_85';
$pass = "gM5FGuqWab52QzqT";

$pdo = new PDO($dsn, $user, $pass);

$sql = "SELECT * FROM users WHERE users.email =:email"; //
/*$stmt = $pdo -> prepare("SELECT * FROM test");*/
$stmt = $pdo -> prepare($sql);
$stmt->execute([":email" => $email]);     //
$result = $stmt->fetchAll();

var_dump($result);

if (empty($result) ){
    $errors[] = "Prüfen Sie bitte Daten!";
   }

if (empty($errors)) {
    echo  "<br>". $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br>";
    echo  " Deine email:  " .$result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
    echo  "Personal-Nr. ". $result[0] ["personalNR"] . " " .  "<br>";
    }  else {
    echo $errors[0];
    }

//    foreach ($pdo->query($sql) as $row) {
//        echo $row['FamilienName'] . " " . $row['Vorname'] . "<br />";
//        echo "E-Mail: " . $row['email'] . "<br /><br />";
//        echo "Anwesenheit: " . $row['Datum'] . "<br /><br />";
//}




$pdo = null;   // Verbindung schliessen
?>
    <button type="reset"><a href="index.php">Zuruck</a></button>

</body>

</html>

