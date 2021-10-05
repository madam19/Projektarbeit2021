

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
$result = getUserZeiten($pdo, $sql, $email);

if (empty($result) ){
    $errors[] = "Prüfen Sie bitte Daten!";
   }
//if the password and email are correct, then we display the data on the screen
if (empty($errors)) {
    echo  "<br><strong>". $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br></strong>";
    echo  " Deine email:  " .$result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
    echo  "<strong> Personal-Nr. ". $result[0] ["personalNR"] . " " .  "<br></strong>";


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
        $(document).ready(function (){
        $("#ok").click(function(){
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
                    year:year
                },
                function createTable(result){
                    let data =  JSON.parse(result);
                    //let email =($_POST["email"]);
                  //  console.log (data);
                    //building a table by month
                    let head = ["Datum", "Tag", "kommen Zeit","gehen Zeit", "pause", "soll Stunde", "IST Stunde" , "Ist Arbeitszeit",
                            "Saldo", "abwesungs Grund", "GesamtSaldo", "Akzept"];
                    let body = document.body,
                        table = document.createElement("table");
                    table.style.width = '100%';
                    table.setAttribute('border', '1');
                    let row = table.insertRow();
                    // create head table
                      for (let i = 0; i < head.length; i++) {
                            let cell = row.insertCell();
                            cell.innerHTML = head [i];

                        }
                        body.appendChild(table);
                      // create table month
                    // let endMonth= new Date(year,month,0).getDate();
                    // let nowDay = new Date(year,month,1).getDate();
                    // for (let j = 0; j<data.length){




                        // let arrDays= new Array();
                        // for (nowDay; nowDay<=endMonth;  nowDay++) {
                        //записываем в формате yyyy-mm-dd
                        // let dd = nowDay;
                        // dd < 10 ? dd = '0' + dd : '';  //add 0, if day < 10
                        // let mm = month;
                        // mm <10 ? mm ='0' + mm: '';
                        // let day = year + "-" + mm + "-" + dd;
                        // an attempt to output the day to an array. It turned out a lot of data
                        // console.log (nowDay,month,year);
                        // let day = new Date(year, month-1, nowDay);
                        //     console.log (day);
                        //      arrDays [nowDay-1] = day;
                        // }
                        // console.log(arrDays);

                        // element.innerHTML = "2021-06-01";
                        // element.className = "";   document.getElementById("2021-06-01").append(element)*/


                },


            );


            // createTable(month, year);
            //
            // let endMonth= new Date(year,month,0).getDate();
            // let nowDay = new Date(year,month,1).getDate();
            // let arrDays= new Array();
            // for (nowDay; nowDay<=endMonth;  nowDay++) {
                //записываем в формате yyyy-mm-dd
                // let dd = nowDay;
                // dd < 10 ? dd = '0' + dd : '';  //add 0, if day < 10
                // let mm = month;
                // mm <10 ? mm ='0' + mm: '';
                // let day = year + "-" + mm + "-" + dd;
                // an attempt to output the day to an array. It turned out a lot of data
                // console.log (nowDay,month,year);
                // let day = new Date(year, month-1, nowDay);
            //     console.log (day);
            //      arrDays [nowDay-1] = day;
            // }
            // console.log(arrDays);


        });
        })

    </script>





    <!-- draw table-->
<!--    <table border="1" hidden>-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Datum</th>-->
<!--            <th>Tag</th>-->
<!--            <th>kommen Zeit</th>-->
<!--            <th>gehen Zeit</th>-->
<!--            <th>Pause</th>-->
<!--            <th>Soll Stunde </th>-->
<!--            <th>IST Arbeitszeit</th>-->
<!--            <th>Saldo</th>-->
<!--            <th>abwesungsGrund</th>-->
<!--            <th> Gesamt +/- </th>-->
<!--            <th>Akzeptieren</th>-->
<!---->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        </form>-->
<!---->
<!---->
<!--        -->
<?php


        //$month = "";











        // selection of values by email

        // display time from tabelle zeit
//        foreach ($result as $row){
            //make a request for employee time
//            echo "<tr style='text-align: center'>";
//
//
//
//            if ($row['akzeptiert'] ==1) {    // first check is accepted or not
//                echo "<td>" . $row['Datum'] . "</td>";
//                echo "<td>" .getTagDE($row['Datum']) . "</td>";   // tag
//                echo "<td>" . $row['kommenZeit'] . "</td>";
//                echo "<td>" . $row['gehenZeit'] . "</td>";
//                echo "<td>" . $row['pause'] . "</td>";
//                echo "<td>" . " " . "</td>"; // Soll Stunde
//                echo "<td>" . " " . "</td>"; // ist Stunde
//                echo "<td>" . " " . "</td>"; // Saldo
//
//                echo "<td>";// wenn anwesend - leere, sonst schreiben Grund

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
//                echo "<td>"."Ja </td>";  //akzeptiert
//
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
<!--        </tbody>-->
<!--    </table>-->



    </div>

    <?php







}  else {
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

