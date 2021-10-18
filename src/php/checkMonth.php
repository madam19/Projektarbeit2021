<?php



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
  <title>checkMonth</title>
</head>

<body style="background-color: lightgray">





  <div class="container">
    <!--   display month-->
    <input id="month" type="month" name="month" value="">
    <button type="submit" id="ok"> ok</button>


    <button type="reset"><a href="mydata.php">Zuruck</a></button>
    <button id="saveData" type="button" class="btn btn-secondary btn-lg m-3 ">Speichern</button>
  </div>





  <script>
    //set the default date
    let nowdate = new Date();
    $("#month").val(nowdate.getFullYear() + "-" + ((nowdate.getMonth() + 1) < 10 ? "0" + nowdate.getMonth() + 1 : nowdate.getMonth() + 1));

    // if click on ok - create table
    $(document).ready(function() {
      $("#ok").click(function() {

        let datum = new Date($('#month').val());
        let month = datum.getMonth() + 1;
        // console.log(result);
        let year = datum.getFullYear();

        let url = "../php/queryMonthZeit.php"; // das php script liegt hier

        //
        // console.log("MONTH: " + month );
        // console.log("YEAR: " + year );

        //
        $.post(
          url, {
            month: month,
            year: year
          },
          function handler(result) {
            // console.log("handler in ok click, result: ");
            // console.log(result);
            // let data = (JSON.parse(result));
            createTableMonth(result, month, year);
          }
        );
      }, );
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>


</html>