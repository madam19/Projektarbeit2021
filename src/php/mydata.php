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
$email = $_REQUEST['emailUser'];
session_start();
$_SESSION['email'] = $email;
// connect to Sql
$errors = [];

$pdo = getPdo();

$sql = "SELECT * FROM users WHERE users.email =:email"; //
$result = getUser($pdo, $sql, $email);

if (empty($result)) {
    $errors[] = "Prüfen Sie bitte Daten!";
}
//if the password and email are correct, then we display the data on the screen
if (empty($errors)) {
    echo "<br><strong>" . $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br></strong>";
    echo " Deine email:  " . $result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
    echo "<strong> Personal-Nr. " . $result[0] ["personalNR"] . " " . "<br></strong>";


    ?>

    <!-- script now-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossOrigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script scr="../js/main.js"></script>

    <!--  // display month-->
    <!--input month-->
    <!--<form action="drawTable.php" method="post">-->

    <input id="month" type="month" name="month" value="">
    <button type="submit" id="ok"> ok</button>

    <script>
        $(document).ready(function () {
                $("#ok").click(function () {
                        //$("table").show();
                        let datum = new Date($('#month').val());
                        // console.log(datum);
                        let month = datum.getMonth() + 1;
                        let year = datum.getFullYear();


                        let url = "../php/queryZeiten.php";  // das php script liegt hier

                        $.post(
                            url,
                            {
                                month: month,
                                year: year
                            },
                            function createTable(result) {
                                let data = JSON.parse(result);

                                console.log(data);
                                let controlData = false;
                                (data.length) != 0 ? controlData = true : '';

                                //building a table by month
                                let head = ["Datum", "Tag", "kommenZeit", "gehenZeit", "pause", "sollStunde", "IST Stunde", "Ist Arbeitszeit",
                                    "Saldo", "abwesungs Grund", "GesamtSaldo", "Akzept"];

                                let headText = ["Datum", "Wochentag", "kommen Zeit", "gehen Zeit", "pause", "soll Stunde", "IST Stunde", "Ist Arbeitszeit",
                                    "Saldo", "abwesungs Grund", "Gesamt Saldo", "Akzept"];

                                //building a table by month V1

                                let body = document.body,
                                    table = document.createElement("table");

                                table.style.width = '100%';
                                table.setAttribute('border', '1');

                                let row = table.insertRow();
                                // create head table
                                for (let i = 0; i < headText.length; i++) {
                                    let cell = row.insertCell();
                                    cell.innerHTML = headText[i];
                                }
                                //make array Day in this month

                                let endMonth = new Date(year, month, 0).getDate(); // number day in this month
                                let nowDay = new Date(year, month, 1).getDate(); // 1 day
                                let arrDays = new Array();
                                for (let i = 1; i <= endMonth; i++) {
                                    // make format yyyy-mm-dd
                                    let dd = nowDay;
                                    dd < 10 ? dd = '0' + dd : '';  //add 0, if day < 10
                                    let mm = month;
                                    mm < 10 ? mm = '0' + mm : '';
                                    let day = year + "-" + mm + "-" + dd;
                                    //an attempt to output the day to an array. It turned out a lot of data
                                    // console.log(day);
                                    arrDays [i] = day;
                                    nowDay++;
                                }
                                // console.log(arrDays);
                                //make table from days


                                for (let i = 1; i < arrDays.length; i++) {
                                    row = table.insertRow();  // ellement array day - row
                                    row.id = arrDays[i];


                                    for (let j = 1; j <= headText.length; j++) {   // element head  - cell
                                        let cell = row.insertCell();
                                        let text = arrDays[i];
                                        cell.className = headText[j];//.replace(/\s+/g, '')

                                        switch (j) {
                                            case 2: // wochentag per date
                                                let days = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
                                                let dat = new Date(arrDays[i]); //

                                                text = days[dat.getDay()];
                                                if (text == 'Sonntag' || text == 'Samstag') {
                                                    j = headText.length;
                                                }

                                                break;
                                            case 3: // kommen Zeit

                                                // if ((controlData) && (data.includes(arrDays[i]))) {
                                                //wenn data existirt und gibt es diese Tag
                                                // {  == ) typeof (data[i][j])=='undefined')
                                                // text = '+++';
                                                // text = data[i]['kommenZeit'];

                                                // } else { // no exist -  new month
                                                text = '<input data-id="kommenZeit" data-datum="' + arrDays[i] + '" type="time" name="$str"  placeholder="08:00" onkeydown="handleInput(this)" onblur="sendZeit()">'


                                                // }

                                                break;
                                            case 4: // gehenZeit

                                                // if ((controlData) && (data.includes(arrDays[i]))) {
                                                //     //wenn data existirt
                                                //     // &&{ (data[i]["Datum"] == arrDays[i])&& typeof (data[i][j])=='undefined')
                                                //     text = '+++';
                                                //     // text = data[i]['gehenZeit'];
                                                //
                                                // } else { // no exist -  new month
                                                text = '<input data-id="gehenZeit" data-datum="' + arrDays[i] + '" type="time" name="$str"  placeholder= "16:30" onkeydown="handleInput(this)" onblur="sendZeit()">'

                                                // }
                                                break;
                                            case 5: //pause
                                                // if ((controlData) && (data.includes(arrDays[i]))) {
                                                //     //wenn data existirt
                                                //     // &&{ (data[i]["Datum"] == arrDays[i])&& typeof (data[i][j])=='undefined')
                                                //     text = '+++';
                                                //     // text = data[i]['pause'];
                                                //
                                                // } else { // no exist -  new month
                                                text = '<input data-id="pause" data-datum="' + arrDays[i] + '" type="time" name="$str"  placeholder= "00:30" onkeydown="handleInput(this)" onblur="sendZeit()">'

                                                // }
                                                break;
                                            case 6: //soll Stunde
// в зависимости от рабочей модели и дня // depending on working model and day
//                                                 if (data[i-1]['AM_ID'] == 2) {
//
//                                                     text = 'arbeitsModel 2';
//                                                     // text = data[i]['pause'];
//
//                                                 } else { // no exist -  new month
//                                                     text = '--- ';
//                                                     // '<input data-id="pause" data-datum="' + arrDays[i] + '" type="time" name="$str"  placeholder= "00:30:00" onkeydown="handleInput(this)" onblur="sendZeit()">'
//
//                                                 }
                                                text = '<input data-id="pause" data-datum="' + arrDays[i] + '" type="time" name="$str"  placeholder= "00:30" onkeydown="handleInput(this)" onblur="sendZeit()">'

                                                break;
                                            case 7: // ist Arbeitzeit - berechnet
                                                text = "berechnet";
                                                break;
                                            case 8: // Saldo - berechnet
                                                text = "berechnet";
                                                break;
                                            case 9: // anwesung Grung wenn gibt's
                                                if text = "berechnet";
                                                break;
                                            case 10: //Gesamt Saldo
                                                text = "berechnet";
                                                break;
                                            case 11: // akzeptirt
                                                text = "berechnet";
                                                break;
                                            case 12:
                                                !(controlData) ? text = 'noch nicht' : text = 'akzeptirt';
                                                break;


                                        }
                                        cell.innerHTML = text;
                                    }
                                }
                                // if (arrDays[i]= data[]['Datum'] ) {

                                //
                                //
                                //     cell.innerHTML = inputDaten((arrDays[i][headText[j]]);
                                // }else
                                //
                                //
                                //
                                //
                                //
                                //     if (data[i][head[j]]=null){
                                //         inputDaten (data[i][head[j]], );
                                //     } else {
                                //        = data[i][head[j]];
                                //     }
                                body.appendChild(table);
                            }
                        )
                    }
                );


            },
        );


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

    </div>

    <?php

} else {
    echo "
 <strong>$errors[0]</strong>";
}


$pdo = null;   // Verbindung schliessen
?>
<br>
<button type="reset"><a href="../index.php">Zuruck</a></button>
<button type="submit"><a href="#">Speichern</a></button>

</body>

</html>

