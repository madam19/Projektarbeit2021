<?php
session_start();
require_once "php/functions.php";

if (isset($_REQUEST['fehler'])) {
    $message = "Bitte Daten prüfen!";
} else {
    $message = "";
}



if (isset($_REQUEST['submit'])) {
// form wurde gesendet
    $email = $_REQUEST['emailUser'];
    $password = $_REQUEST['passwordUser'];

//    var_dump($email);
//    var_dump($password);

    $pdo = getPdo();
// sql
    $sql = "SELECT users.email, users.password FROM users WHERE users.email =:email AND users.password =:password";
    $result = getUser($pdo, $sql, $email, $password);
// eingabe richtig
//    var_dump($result);
    if (empty($result)){ // eingabe falsch
        // zurück auf index?fehler
        //  // header mit ?fehler
        header('Location: http://localhost:8080/Projektarbeit2021/src/index.php?fehler=1');
        $pdo = null;   // Verbindung schliessen
    } else {
             // $_SESSION setzen

        $_SESSION['email'] = $email;
        //$email = $_REQUEST['emailUser'];
//         connect to Sql
        $pdo = getPdo();
        $sql = "SELECT * FROM users WHERE users.email =:email"; //
        $result = getUserData($pdo, $sql, $email);
  // header auf startseite
        header('Location: http://localhost:8080/Projektarbeit2021/src/php/myData.php');


}

//echo $_REQUEST['submit'];
//    die();
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- name site-->
    <title>Arbeitszeit</title>
    <!-- reset styles -->
    <link rel="stylesheet" href="./css/reset.min.css">
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--add сss-file-->

</head>

<body>


<div class="container w-100 bg-secondary">
    <h1> Arbeitszeit</h1>
    <!-- add image -->
    <?php
    if (!$message == "") {
        echo '<div style="background: red;line-height: 30px; height: 30px" class="row"><p>' . $message . '</p></div>';
    }
    ?>
    <div class="row">
        <div class="col-6 p-5">
            <img src="./image/zeit.jpg" class="img-fluid" alt="time">
        </div>
        <!-- Form email and password-->
        <div class="col-6 p-5">
            <div class="row">
                <form action="?submit" method="post">

                    <!--input email-->
                    <div class="mb-3">
                        <input type="email" class="form-control" name="emailUser" id="inputEmail1"
                               placeholder="deine@email.de"
                               value=""

                        >
                    </div>
                    <!-- input password -->
                    <div class="mb-3">
                        <input type="password" name="passwordUser" placeholder="Password"
                               value=""
                        >
                    </div>
                    <button type="submit" class="btn btn-dark" data-bs-toggle="modal" style="cursor: pointer">Enter
                    </button>




                </form>
            </div>


        </div>


    </div>


</div>


<!--<button type="reset"><a href="../index.php">Zuruck</a></button>-->
<script src="./js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>