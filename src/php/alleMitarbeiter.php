<?php
session_start();
require_once "functions.php";

// connect to Sql
$pdo = getPdo();
$sql = "SELECT users.users_ID, users.FamilienName, users.Vorname, users.email, users.password, users.personalNR, arbeitsmodell.stundenWoche AS 'stunden',
users.AM_ID, arbeitsmodell.AM_Name AS 'arbeitsmodell', rolles.rollesName AS 'rolle', abteilung.NameAbteilung AS 'abteilung' 
FROM users LEFT JOIN arbeitsmodell on users.AM_ID = arbeitsmodell.AM_ID
LEFT JOIN rolles ON users.rolles_ID = rolles.rolles_ID
LEFT JOIN abteilung on users.Abteilung_ID = abteilung.Abteilung_ID
WHERE arbeitsmodell.AM_ID=users.AM_ID AND users.Abteilung_ID=abteilung.Abteilung_ID AND users.rolles_ID=rolles.rolles_ID
ORDER BY users.users_ID ASC;"; // get all users
$result = getAllUser($pdo, $sql);
//var_dump($result);
// !wahrscheinlich bekommen wir abteilung von BD
//$departament =
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="../css/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossOrigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/main.js"></script>
  <title>AddNeuMitarbeiter</title>
</head>

<body style="background-color: lightgray">
  <div class="container">
    <div class="input-group mb-3 pt-5">
      <label class="input-group-text" for="selectAbteilung">Abteilung</label>
      <select class="form-select" id="selectAbteilung">
        <option value="0" selected>Alle</option>
        <option value="1">Personalabteilung</option>
        <option value="2">Entwicklung</option>
        <option value="2">Grafik</option>
      </select>
    </div>

    <table id="tableEmployee" class="table table-info table-striped table-bordered">
      <thead>
        <tr id="tableHead" class="table-info">
          <td class="table-info">User_ID</td>
          <td class="table-info">FamilienName</td>
          <td class="table-info">Vorname</td>
          <td class="table-info">Personal Nummer</td>
          <td class="table-info">email</td>
          <td class="table-info">Abteilung</td>
          <td class="table-info">Arbeitsmodel</td>
          <td class="table-info">stunde pro Woche</td>
          <td class="table-info">Rolles</td>
          <td class="table-info" style="width: 30px">Korrigieren</td>
        </tr>
      </thead>


    </table>
    <script>
      $(document).ready(function() {
        $.post(
          "queryEmployee.php", {
            abteilung: "0"
          },
          function handler(result) {
            createTableMitarbeiter(result);
          })
      })

      // createTableMitarbeiter(result);

      $("#selectAbteilung").change(function() {
        let abteilung = $("#selectAbteilung").val();
        //console.log(abteilung);
        // let url = ;
        $.post(
          "queryEmployee.php", {
            abteilung: abteilung
          },
          function handler(result) {
            createTableMitarbeiter(result);
          })

      });

      //add new employee
      $("body").on("click", "#neuEmployee", function() {

        window.location.assign("korrigierenMitarbeiter.php?new");
      });

      //correct employee
      $("body").on("click", "#emend", function(e) {
        let user_ID = $(this).parent;
        // alert(user_ID);
        window.location.assign("korrigierenMitarbeiter.php?id=" + user_ID);

      });
    </script>

    <button type="reset"><a href="mydata.php">Zuruck</a></button>
    <button id="neuEmployee" type="button" class="btn btn-secondary btn-lg m-3 ">neuen Mitarbeiter hinzuf??gen</button>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>