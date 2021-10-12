<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>MyData</title>
</head>

<body>


<?php
require_once "functions.php";
$email = $_REQUEST['emailUser'];
//$usersID = $_REQUEST['users_ID'];
session_start();
$_SESSION['email'] = $email;

// connect to Sql
$errors = [];


$pdo = getPdo();

$sql = "SELECT * FROM users WHERE users.email =:email"; //
$result = getUser($pdo, $sql, $email);

if (empty($result)) {
    $errors[] = "Prüfen Sie bitte Daten!";
    //header() -> startseite
}
//if the password and email are correct, then we display the data on the screen
if (empty($errors)) {
//echo "<div style='border: black 1px solid'>"

    echo "<div class='container'><br><h2>" . $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br></h2>";
    echo " Deine email:  " . $result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
    echo "<strong> Personal-Nr. " . $result[0] ["personalNR"] . " " . "<br></strong></div>" . "<br>";
    $usersID = $result[0]["users_ID"];
    $usersArbeitsModel = $result[0]["AM_ID"];
    //    echo $usersID;
    $_SESSION['users_ID'] = $usersID;
    $_SESSION['usersArbeitsModel'] = $usersArbeitsModel;
//  echo $usersID;
//  echo "</div>"
    // login erfolgreich
    //$_SESSION['authorized'] = true;

    ?>

    <!-- script now-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossOrigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>

    <!--   display month-->

    <input id="month" type="month" name="month" value="">
    <button type="submit" id="ok"> ok</button>

    <script>
        $(document).ready(function () {
            $("#ok").click(function () {

                    let datum = new Date($('#month').val());
                    let month = datum.getMonth() + 1;
                    // console.log(result);
                    let year = datum.getFullYear();

                    let url = "../php/queryZeiten.php";  // das php script liegt hier

                    //
                    $.post(
                        url,
                        {
                            month: month,
                            year: year
                        },
                        function handler(result){
                            createTable(result,month, year);
                        }
                    );
                },
            );


        });
    </script>


<?php


//
//
//
//            } else {
//
//                // if accepted not, we can correct
//                echo "<td>" . $row['Datum'] . "</td>";
//
//                echo "<td>" .  getTagDE($row['Datum']) . "</td>";   // tag
//                echo "<td>";
//                inputDaten ($row['kommenZeit'], '8:00:00');
//                echo "</td>";
//                echo "<td>" ; inputDaten ($row['gehenZeit'], '16:00:00' ); echo "</td>";
//                echo "<td>" ; inputDaten($row['pause'], '0:30:00') ; echo "</td>";
//                echo "<td>" . " " . "</td>"; // Soll Stunde
//                echo "<td>" ;// ist Stunde
//                /* $pause= $row['gehenZeit'] - $row['kommenZeit']-$row['pause'] ;
//                 echo $pause; */
//                echo "</td>";
//                echo "<td>" . " " . "</td>"; // Saldo
//
//                echo "<td>";// wenn anwesend - leere, sonst schreiben Grund
//
//                if ($row['abwesungsGrund_Id'] == 1) {
//                    echo " ";
//                } elseif ($row['abwesungsGrund_Id'] == 2) {
//                    echo "Urlaub";
//                } elseif ($row['abwesungsGrund_Id'] == 3) {
//                    echo "krank ";
//                }
//                echo "</td>";
//
//                echo "<td>" . " " . "</td>"; // Gesamte Saldo
//
//                echo "<td>"."noch nicht </td>";// akzeptiert nicht
//
//
//
//            }
//
//            echo "</tr>";
//
//
//
//        }
//
?>
    <button type="submit"><a href="#">Speichern</a></button>
    </div>

    <?php

} else {
    echo " <strong>$errors[0]</strong>";
}


$pdo = null;   // Verbindung schliessen
?>
<br>
<button type="reset"><a href="../index.php">Zuruck</a></button>


</body>

</html>

