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
//    echo $usersID;
    $_SESSION['users_ID'] = $usersID;
// echo $usersID;
//echo "</div>"
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
                    // console.log(month);
                    let year = datum.getFullYear();

                    let url = "../php/queryZeiten.php";  // das php script liegt hier
                    //
                    $.post(
                        url,
                        {
                            month: month,
                            year: year
                        },
                        function createTable(result) {
                            // console.log(result);
                            let data = JSON.parse(result);

                            console.log(data);
                            let controlData = false; // default - new monat
                            let akzept = false; //kontrolieren akzept

                            // kontroll exist data in Db and accept
                            if (data.length != 0) {
                                controlData = true;
                                (data[0]['akzeptiert'] == '1') ? akzept = true : '';//kontrolieren akzept
                            }
                            //building a table by month
                            let head = ["Datum", "Tag", "kommenZeit", "gehenZeit", "pause", "sollStunde", "ISTStunde", "IstArbeitszeit",
                                "Saldo", "abwesungsGrund", "GesamtSaldo", "Akzept"];

                            let headText = ["Datum", "Wochentag", "kommen Zeit", "gehen Zeit", "pause", "soll Stunde", "IST Stunde", "Ist Arbeitszeit",
                                "Saldo", "abwesungs Grund", "Gesamt Saldo", "Akzept"];

                            //building a table by month V1

                            let body = document.body,
                                table = document.createElement("table");
                            $('table').empty(); //remove table, if had
                            //  document.body.innerHTML = "";
                            // table.className = 'table table-bordered border-primary';
                            let styleTable = 'background-color: #F5F5CA; width: 100%';
                            // table.style.width = '100%' ;
                            table.style = styleTable;
                            table.setAttribute('border', '2px');

                            let row = table.insertRow();

                            // create head table
                            for (let i = 0; i < headText.length; i++) {
                                let cell = row.insertCell();
                                cell.innerHTML = headText[i];
                                cell.setAttribute('border', '2px');
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


                            let disabled = akzept ? "disabled" : '';
                            let styles = akzept ? "background-color: darkseagreen; color: green;" : "background-color:  #efe1c8; font-weight: bold; color: red;";
                            // i try highlight line

                            // $( "#target" ).click(function() {
                            //     styles = 'background-color: olive;';
                            // });
                            let dayToday;

                            //make table from days
                            for (let i = 1; i < arrDays.length; i++) {
                                row = table.insertRow();  // ellement array day - row
                                row.id = arrDays[i];


                                for (let j = 1; j <= headText.length; j++) {   // element head  - cell
                                    let cell = row.insertCell();
                                    let text = arrDays[i];
                                    cell.className = (headText[j - 1]).replace(/ /g, '');


                                    switch (j) {
                                        case 2: // wochentag per date
                                            let days = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
                                            let dat = new Date(arrDays[i]); //

                                            text = days[dat.getDay()];

                                            // if Sa-So come next row
                                            dayToday = text;

                                            if (text == 'Sonntag' || text == 'Samstag') {
                                                j = headText.length;
                                            }

                                            break;
                                        case 3: // kommen Zeit
                                            text = '<input data-id="kommenZeit" data-datum="' + arrDays[i] + '" type="time" name="$str" style= "' + styles + '" value= "00:00" onkeydown="handleInput(this)" onblur="saveDay()"' + disabled + '>';


                                            break;
                                        case 4: // gehenZeit
                                            text = '<input data-id="gehenZeit" data-datum="' + arrDays[i] + '" type="time" name="$str" style= "' + styles + '" value= "00:00" onkeydown="handleInput(this)" onblur="saveDay()"' + disabled + '>';
                                            break;
                                        case 5: //pause
                                            text = '<input data-id="pause" data-datum="' + arrDays[i] + '" type="time" name="$str" style= "' + styles + '" value= "00:30" onkeydown="handleInput(this)" onblur="saveDay()"' + disabled + '>';

                                            break;
                                        case 6: //soll Stunde
// в зависимости от модели работы и дня // depending on working model and day
//                                             if (data[i - 1]['AM_ID'] == 2) {
//                                                 if
//                                                     text = 'arbeitsModel 2';
                                            // text = data[i]['pause'];
//
//                                                 } else { // no exist -  new month
//                                                     text = '--- ';
//                                                     // '<input data-id="pause" data-datum="' + arrDays[i] + '" type="time" name="$str"  placeholder= "00:30:00" onkeydown="handleInput(this)" onblur="sendZeit()">'
//
//                                                 }

                                            text = "08:00";

                                            // '<input data-id="sollStunde" data-datum="' + arrDays[i] + '" type="time" name="$str"  value= "08:00" onkeydown="handleInput(this)" onblur="sendZeit()">';

                                            break;
                                        case
                                        7
                                        :// ist stunde
                                            text = " ";

                                            // text = $('#' + arrDays[i] + '');
                                            break;
                                        case
                                        8
                                        : // ist Arbeitzeit - berechnet
                                            text = " ";
                                            break;
                                        case
                                        9
                                        : // Saldo - berechnet

                                            text = " ";
                                            break;
                                        case
                                        10
                                        :// anwesung Grung wenn gibt's


                                            text =
                                                '<select data-datum="' + arrDays[i] + '"name="abwendungsGrund" onchange="saveDay()">' +
                                                ' <option value=" "> </option>' +
                                                '<option value="krank">krank</option>' +
                                                '<option value="Urlaub">Urlaub</option>'

                                            ;


                                            break;
                                        case
                                        11
                                        : //Gesamt Saldo
                                            text = " ";
                                            break;
                                        case
                                        12
                                        :// akzeptirt
                                            (controlData) ? text = 'noch nicht' : text = 'akzeptiert';
                                            break;


                                    }

                                    cell.innerHTML = text;
                                }
                            }
                            body.appendChild(table);

                            // window.setTimeout(setData, 2000, data, headText, head);

                            for (let i = 0; i < data.length; i++) {
                                let rowId = data[i]['Datum'];

                                for (let j = 0; j < headText.length; j++) {
                                    let cellClass = headText[j];
                                    $('#' + rowId + ' [data-id="' + head[j] + '"]').val(data[i][head[j]]);


                                    switch (j) {
                                        case 3 : //kommen Zeit
                                            // let kommenZeitB = $('#' + rowId + ' [data-id="' + head[j] + '"]').val(data[i][head[j]]);
                                            $('#' + rowId + ' [data-id="' + head[j] + '"]').val(data[i][head[j]]);

                                            break;
                                        case 4: //gehenZeit
                                            // let gehenZeitB = $('#' + rowId + ' [data-id="' + head[j] + '"]').val(data[i][head[j]]);

                                            break;
                                        case 5: //pause
                                            // let pauseB = $('#' + rowId + ' [data-id="' + head[j] + '"]').val(data[i][head[j]]);

                                        case 6: //soll Stunde

                                            break;
                                        case 7: //IST
                                            // let istStunde = gehenZeitB - kommenZeitB - pauseB;
                                            // $('#' + rowId + ' [data-id="' + head[j] + '"]').val(istStunde);
                                        case 10:

                                            //try save select
                                            if (head[j] == "abwesungsGrund" && data[i]["abwesungsGrund_Id"] == "2") {
                                                // $("#2021-10-06 select").val("Urlaub");
                                                $('#' + rowId + ' select ').val("krank");

                                            } else if (head[j] == "abwesungsGrund" && data[i]["abwesungsGrund_Id"] == "3") {
                                                $('#' + rowId + ' select ').val("Urlaub");
                                            }
                                            break;

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

                            }

                        }
                    );


                },
            );

            function setData(data, headText, head) {
                for (let i = 0; i < data.length; i++) {
                    let rowId = data[i]['Datum'];

                    for (let j = 0; j < headText.length; j++) {
                        let cellClass = headText[j];

                        /*if(head[j] === "kommenZeit"){
                            console.log('#' + rowId + ' [data-id="' + head[j] + '"]');
                            console.log(data[i][head[j]]);
                        }*/


                        //console.log($('#' + rowId + ' [data-id="' + head[j] + '"]'));
                        //$('#' + rowId + ' [data-id="' + head[j] + '"]').val(data[i][head[j]]);
                        $('#' + rowId + ' [data-id="' + head[j] + '"]').val('12:34');


                    }

                }
            }
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
    echo "
 <strong>$errors[0]</strong>";
}


$pdo = null;   // Verbindung schliessen
?>
<br>
<button type="reset"><a href="../index.php">Zuruck</a></button>


</body>

</html>

