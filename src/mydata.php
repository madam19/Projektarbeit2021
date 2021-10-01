

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MyData</title>
</head>

<body>


<?php
require_once "functions.php";
// connect to Sql



$errors = [];
$email = $_REQUEST['emailUser'];
/*$dsn = 'mysql:dbname=knmde_db85;host=dedi154.your-server.de;charset=utf8';
$user = 'knmde_85';
$pass = "gM5FGuqWab52QzqT";*/

$pdo = getPdo();
//$pdo = new PDO($dsn, $user, $pass);

$sql = "SELECT * FROM users WHERE users.email =:email"; //

$result = getUserZeiten($pdo, $sql, $email);

if (empty($result) ){
    $errors[] = "Prüfen Sie bitte Daten!";
   }
//if the password and email are correct, then we display the data on the screen
if (empty($errors)) {
    echo  "<br><strong>". $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br></strong>";
    echo  " Deine email:  " .$result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
    echo  "<strong> Personal-Nr. ". $result[0] ["personalNR"] . " " .  "<br></strong>";
// draw table
?>
<table border="1" >
    <thead>
    <tr>
        <th>Datum</th>
        <th>Tag</th>
        <th>kommen Zeit</th>
        <th>gehen Zeit</th>
        <th>Pause</th>
        <th>Soll Stunde </th>
        <th>IST Arbeitszeit</th>
        <th>Saldo</th>
        <th>abwesungsGrund</th>
        <th> Gesamt +/- </th>
        <th>Akzeptieren</th>

    </tr>
    </thead>
    <tbody>
    <?php
   $sql ="SELECT * FROM zeit, users, arbeitsmodell WHERE users.email = :email AND users.users_ID= zeit.users_ID 
                                           AND users.AM_ID = arbeitsmodell.AM_ID" ;
    $result = getUserZeiten($pdo, $sql, $email);


// display time from tabelle zeit

    foreach ($result as $row){

        //make a request for employee time

        echo "<tr style='text-align: center'>";
        if ($row['akzeptiert'] ==1) {    // first check is accepted or not
        echo "<td>" . $row['Datum'] . "</td>";
        echo "<td>" .getTagDE($row['Datum']) . "</td>";   // tag
        echo "<td>" . $row['kommenZeit'] . "</td>";
        echo "<td>" . $row['gehenZeit'] . "</td>";
        echo "<td>" . $row['pause'] . "</td>";
        echo "<td>" . " " . "</td>"; // Soll Stunde
        echo "<td>" . " " . "</td>"; // ist Stunde
        echo "<td>" . " " . "</td>"; // Saldo

        echo "<td>";// wenn anwesend - leere, sonst schreiben Grund

        if ($row['abwesungsGrund_Id'] == 1) {
            echo " ";
        } elseif ($row['abwesungsGrund_Id'] == 2) {
            echo "Urlaub";
        } elseif ($row['abwesungsGrund_Id'] == 3) {
            echo "krank ";
        }
        echo "</td>";

        echo "<td>" . " " . "</td>"; // Gesamte Saldo

        echo "<td>"."Ja </td>";  //akzeptiert




    } else {

        // if accepted not, we can correct
            echo "<td>" . $row['Datum'] . "</td>";

            echo "<td>" .  getTagDE($row['Datum']) . "</td>";   // tag
            echo "<td>";
            inputDaten ($row['kommenZeit']);
                echo "</td>";
            echo "<td>" ; inputDaten ($row['gehenZeit'] ); echo "</td>";
            echo "<td>" ; inputDaten($row['pause']) ; echo "</td>";
            echo "<td>" . " " . "</td>"; // Soll Stunde
            echo "<td>" ;// ist Stunde
             /* $pause= $row['gehenZeit'] - $row['kommenZeit']-$row['pause'] ;
              echo $pause; */
            echo "</td>";
            echo "<td>" . " " . "</td>"; // Saldo

            echo "<td>";// wenn anwesend - leere, sonst schreiben Grund

            if ($row['abwesungsGrund_Id'] == 1) {
                echo " ";
            } elseif ($row['abwesungsGrund_Id'] == 2) {
                echo "Urlaub";
            } elseif ($row['abwesungsGrund_Id'] == 3) {
                echo "krank ";
            }
            echo "</td>";

            echo "<td>" . " " . "</td>"; // Gesamte Saldo

            echo "<td>"."noch nicht </td>";// akzeptiert nicht



    }

        echo "</tr>";



    }

    ?>
    </tbody>
</table>
    <button type="add"><a >Add</a></button>   <!-- add data-->
    </div>
    <div class="inputNewData">

        <form action="/" method="get">
            <!--  -->



       <!--     <button type="submit">Save</button>-->

        </form>

    </div>

    <?php







}  else {
    echo "
 <strong>$errors[0]</strong>";
    }






$pdo = null;   // Verbindung schliessen
?>
    <button type="reset"><a href="index.php">Zuruck</a></button>
    <button type="reset"><a href="#">Save</a></button>
</body>

</html>

