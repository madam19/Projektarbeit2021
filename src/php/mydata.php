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
session_start();

$email = $_REQUEST['emailUser'];
$_SESSION['email'] = $email;

//         connect to Sql
$pdo = getPdo();
$sql = "SELECT * FROM users WHERE users.email =:email"; //
$result = getUserData($pdo, $sql, $email);

// conect with BD
var_dump($result);


echo "<div class='container '><br><h2>" . $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br></h2>";
echo " Deine email:  " . $result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
echo "<strong> Personal-Nr. " . $result[0] ["personalNR"] . " " . "<br>";
echo "<br>";
?>
<!--   warnungen, wenn bis heute keine ausfüllende Daten     -->
<div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseOne">
                WARNUNGEN
            </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
             aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                   <span>
                       <strong>Sie haben im vergangenen Zeitraum noch nicht ausgefüllte Daten. </strong>
                       Bitte tragen Sie die Datum ein.......
                   </span>
            </div>
        </div>
    </div>
</div>

<?php

echo "<br></strong></div>" . "<br>";

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
<div class="container">

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
                $.post(
                    url,
                    {
                        month: month,
                        year: year
                    },
                    function handler(result) {
                        createTable(result, month, year);
                    }
                );
            },
        );


    });
</script>
<div class="container">

    <button type="submit"><a href="#">Speichern</a></button>




    $pdo = null;   // Verbindung schliessen
    ?>
    <br>
    <button type="reset"><a href="../index.php">Zuruck</a></button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


</body>

</html>

<!---->