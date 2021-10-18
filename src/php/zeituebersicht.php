<?php
session_start();
require_once "functions.php";
$email = $_SESSION['email'];

$pdo = getPdo();
$sql = "SELECT * FROM users, zeit WHERE users.email =:email"; //
$result = getUserData($pdo, $sql, $email);


echo "<div class='container '><br><h2>" . $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br></h2>";
echo " Deine email:  " . $result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
echo "<strong><h5> Personal-Nr. " . $result[0] ["personalNR"] . " " . "</h5><br>";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossOrigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <title>Monat Uebersicht</title>
</head>

<body style="background-color: lightgray">
<div class="container">
    <!--   display month-->
    <input id="month" type="month" name="month" value="">
    <button type="submit" id="ok"> ok</button>
</div>
<script>
    //set the default date
    let nowdate = new Date();
    $("#month").val(nowdate.getFullYear() + "-" + ((nowdate.getMonth() + 1) < 10 ? "0" + nowdate.getMonth() + 1 : nowdate.getMonth() + 1));

    // if click on ok - create table
    $(document).ready(function () {
        $("#ok").click(function () {

                let datum = new Date($('#month').val());
                let month = datum.getMonth() + 1;
                // console.log(result);
                let year = datum.getFullYear();

                let url = "../php/queryZeiten.php";  // das php script liegt hier

                //
                // console.log("MONTH: " + month );
                // console.log("YEAR: " + year );

                //
                $.post(
                    url,
                    {
                        month: month,
                        year: year
                    },
                    function handler(result) {
                        // console.log("handler in ok click, result: ");
                        // console.log(result);
                        // let data = (JSON.parse(result));
                        createTable(result, month, year);
                    }
                );
            },
        );
    });
    $("body").on("click", "#speichernDaten", function () {
        // console.log("speichernDaten");
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
            function handler(result) {
                createTable(result, month, year);


            })


    });
    $("body").on("click", "#reset", function () {
        window.location.assign("mydata.php");
    });



</script>
<button id="reset" type="reset" class="btn btn-secondary btn-lg m-3">Zuruck</button>
<button id="speichernDaten" type="button" class="btn btn-secondary btn-lg m-3 position-absolute end-0">Speichern
</button>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>

