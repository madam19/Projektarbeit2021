<?php
session_start();
require_once "functions.php";

//$email = $_REQUEST['emailUser'];
$email = $_SESSION['email'];

//         connect to Sql
$pdo = getPdo();
$sql = "SELECT * FROM users, zeit WHERE users.email =:email"; //
$result = getUserData($pdo, $sql, $email);
$hidden = "hidden";
// conect with BD
//var_dump($result);

echo "<div class='container '><br><h2>" . $result[0]["FamilienName"] . " " . $result[0]["Vorname"] . "<br></h2>";
echo " Deine email:  " . $result[0]["email"] . "<br>" . " Deine Arbeitsmodell " . $result[0]["AM_ID"] . "<br>";
echo "<strong><h5> Personal-Nr. " . $result[0]["personalNR"] . " " . "</h5><br>";
echo "<h5> Deine Rolle: " . $result[0]["rolles_ID"];

if ($result[0]["rolles_ID"] == "1") {
  $hidden = "visible";
};
$usersArbeitsModel = $result[0]["AM_ID"];
//    echo $usersID;

$_SESSION['usersArbeitsModel'] = $usersArbeitsModel;


// login erfolgreich
//$_SESSION['authorized'] = true;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="../css/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>MyData</title>
</head>

<body style="background-color: lightgray">
  <!--   warnungen, wenn bis heute keine ausfüllende Daten     -->
  <div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item" style="background-color: rgba(255, 99, 71, 0.4)">
      <h2 class="accordion-header" id="panelsStayOpen-headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne" style="background-color: rgba(255, 99, 71, 0.4)">
          WARNUNGEN
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body">
          <span>
            <strong>Sie haben im vergangenen Zeitraum noch nicht ausgefüllte Daten. </strong>
            Bitte tragen Sie die Datum ein.......
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="container row">
    <button id="employee" type="button" class="btn btn-secondary btn-lg m-3" <?= $hidden ?>>Mitarbeiter</button>
    <button id="checkMonth" type="button" class="btn btn-secondary btn-lg m-3" <?= $hidden ?>>Kontrolieren Monat</button>
    <button id="checkYear" type="button" class="btn btn-secondary btn-lg m-3" <?= $hidden ?>>Jahresbericht</button>
    <button id="zeituebersicht" type="button" class="btn btn-secondary btn-lg m-3">meine Zeit um Monate</button>
  </div>




  <!-- script now-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossOrigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/main.js"></script>




  <script>
    //setup handlers
    $("body").on("click", "#zeituebersicht", function() {
      // console.log("zeitenübersicht");
      window.location.assign("zeituebersicht.php");
    });


    //show all employee
    $("body").on("click", "#employee", function() {
      // console.log("zeitenübersicht");
      window.location.assign("alleMitarbeiter.php");
    });

    //checkMonth
    $("body").on("click", "#checkMonth", function() {
      //         $pdo = null;   //php
      //        session_end();
      window.location.assign("checkMonth.php");
    });

    //checkYear
    $("body").on("click", "#checkYear", function() {
      //         $pdo = null;   //php
      //        session_end();
      window.location.assign("../index.php");
    });

    //exit
    $("body").on("click", "#raus", function() {
      //         $pdo = null;   //php
      //        session_end();
      window.location.assign("../index.php");
    });
  </script>
  <div class="container">

    <!--     // Verbindung schliessen-->
    <!--    ?>-->
    <br>
    <button id="raus" type="reset">Raus von here!</a></button>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>