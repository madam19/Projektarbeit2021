<?php
//session_start();
//require_once "functions.php";

//         connect to Sql
//$pdo = getPdo();
//$sql = "SELECT * FROM users"; // get all users
//$result = getAllUser($pdo, $sql);
//echo ($result);
//


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
      <label class="input-group-text" for="inputGroupSelectAbteilung">Abteilung</label>
      <select class="form-select" id="inputGroupSelectAbteilung">
        <option value="0" selected>Alle</option>
        <option value="1">Personalabteilung</option>
        <option value="2">IT</option>

      </select>
    </div>
    <table class="table table-info table-striped table-bordered">
      <thead>
        <tr class="table-info">
          <td class="table-info">User_ID</td>
          <td class="table-info">FamilienName</td>
          <td class="table-info">Vorname</td>
          <td class="table-info">Personal Nummer</td>
          <td class="table-info">Abteilung</td>
          <td class="table-info">Arbeitsmodel</td>
          <td class="table-info">Rolles</td>
          <td class="table-info" style="width: 30px">Korrigieren</td>
        </tr>
      </thead>

      <?php
      for ($i = 1; $i < 10; $i++) {
      ?>
        <tr>
          <td><? echo "User_ID"; ?></td>
          <td><? echo "1FamilienName"; ?></td>
          <td><? echo "Vorname2"; ?></td>
          <td><? echo "0Personal Nummer"; ?></td>
          <td><? echo "1Abteilung"; ?></td>
          <td><? echo "2Arbeitsmodel"; ?></td>
          <td><? echo "Rolles"; ?></td>
          <td>
            <div id="emend">
              <img src="../image/icons-blue.png" alt="korrigieren" style="width: 30px;">
            </div>

          </td>
        </tr>
        <?php    }
        ?>;


    </table>

    <button type="reset"><a href="mydata.php">Zuruck</a></button>
    <button id="neuEmployee" type="button" class="btn btn-secondary btn-lg m-3 ">neuen Mitarbeiter hinzufügen</button>
  </div>
  <script>
    //  let dataUsers = (JSON.parse(result));
    // console.log(dataUsers);


    //wenn alle Abteilungen
    if ($(inputGroupSelectAbteilung).val() == "0") {

    };


    //add new employee
    $("body").on("click", "#neuEmployee", function() {

      window.location.assign("addNeuMitarbeiter.php");
    });

    //correct employee
    $("body").on("click", "#emend", function() {

      window.location.assign("korregierenMitarbeiter.php");
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>