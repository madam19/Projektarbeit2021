<?php
session_start();
require_once "functions.php";
var_dump($_REQUEST['id']);


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
  <title>KorregierenMitarbeiter</title>
</head>

<body>


  <!-- такие же поля как и в добавить, только с получение данных с сервера
 -->

  <body style="background-color: lightgray">
  <div class="container pt-5">

      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">FamilienName</span>
          <input type="text" class="form-control" placeholder="FamilienName" aria-label="Username"
                 aria-describedby="basic-addon1">
      </div>

      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">VorName</span>
          <input type="text" class="form-control" placeholder="Vorname" aria-label="Username"
                 aria-describedby="basic-addon1">
      </div>

      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">email</span>
          <input type="text" class="form-control" placeholder="Name_Vorname" aria-label="emailUser"
                 aria-describedby="basic-addon2">
          <span class="input-group-text" id="basic-addon2">@krammerinnovation.de</span>
      </div>

      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">password</span>
          <input type="text" class="form-control" placeholder="password" aria-label="emailUser"
                 aria-describedby="basic-addon2">

      </div>


      <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupSelect01">arbeitsmodel</label>
          <select class="form-select" id="inputGroupSelect01">
              <option value="1">Arbeitsmodel 1 - 20 Stunde pro Woche</option>
              <option value="2">Arbeitsmodel 2 - 37,5 Stunde pro Woche</option>
              <option value="3" selected>Arbeitsmodel 3 - 40 Stunde pro Woche</option>

          </select>
      </div>


      <div class="input-group mb-3 end">
          <div class="input-group-text">
              <input class="form-check-input mt-0" type="checkbox" value="2" aria-label="user">
          </div>
          <span class="input-group-text" id="basic-addon2">admin </span>

      </div>

      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">PersonalNummer</span>
          <input type="text" class="form-control" placeholder="12345" aria-label="personalNR"
                 aria-describedby="basic-addon1">
      </div>

      <div class="input-group mb-3">


          <label class="input-group-text" for="inputGroupSelect01">Abteilung</label>
          <select class="form-select" id="inputGroupSelect01">

              <option value="1">Personalabteilung</option>
              <option value="2">Entwicklung</option>
              <option value="2">Grafik</option>
          </select>


      </div>
      <button type="button" class="btn btn-secondary btn-lg m-3">Speichern </button>

      <button type="reset"><a href="alleMitarbeiter.php">Zuruck</a></button>
  </div>


  </div>

  <script>
      console.log(user_ID);

      $.post(
          "emendEmlployee.php", {
              user_ID: user_ID
          },
          function handler(result) {
              // console.log("handler in ok click, result: ");
              // console.log(result);
              // let data = (JSON.parse(result));

          })

  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
          crossorigin="anonymous">


  </script>


  </body>

</html>
