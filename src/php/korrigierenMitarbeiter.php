<?php
session_start();
require_once "functions.php";
$result [0] = array();
$users_ID = "";
$azm = "";
if (isset($_REQUEST['id'])) {
    $users_ID = $_REQUEST['id'];
    //var_dump($_REQUEST['id']);
    $pdo = getPdo();
    $sql = "SELECT users.users_ID, users.FamilienName, users.Vorname, users.email, users.password, users.personalNR,users.Abteilung_ID, arbeitsmodell.stundenWoche AS 'stunden',
users.AM_ID, users.rolles_ID,  arbeitsmodell.AM_Name AS 'arbeitsmodell', rolles.rollesName AS 'rolle', abteilung.NameAbteilung AS 'abteilung' FROM users, arbeitsmodell, rolles, abteilung
WHERE users.users_ID = :users_ID AND arbeitsmodell.AM_ID=users.AM_ID AND users.Abteilung_ID=abteilung.Abteilung_ID AND users.rolles_ID=rolles.rolles_ID";
    // get data this users

    $result = getUserDataID($pdo, $sql, $users_ID);
    $azm = $result[0]["AM_ID"];

}

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
    <title>KorrigierenMitarbeiter</title>
</head>

<body>


<!-- такие же поля как и в добавить, только с получение данных с сервера
-->

<body style="background-color: lightgray">
<div class="container pt-5">

    <form id="formEmployee" action="sendEmendEmployee.php" method="post">
        <input id="users_ID" type="hidden" name="users_ID" value="<?= $users_ID ?>">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">FamilienName</span>
            <input type="text" class="form-control" placeholder="FamilienName" aria-label="Username"
                   aria-describedby="basic-addon1" name="FamilienName"
                   value="<?= inputEmployee($result, 'FamilienName') ?>">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">VorName</span>
            <input type="text" class="form-control" placeholder="Vorname" aria-label="Username"
                   aria-describedby="basic-addon1" name="Vorname" value="<?= inputEmployee($result, 'Vorname') ?>">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">email</span>
            <input type="text" class="form-control" placeholder="Name_Vorname" aria-label="emailUser"
                   aria-describedby="basic-addon2" name="email" value="<?= inputEmployee($result, 'email') ?>">

        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">password</span>
            <input type="text" class="form-control" placeholder="password" aria-label="emailUser"
                   aria-describedby="basic-addon2" name="password" value="<?= inputEmployee($result, 'password') ?>">

        </div>

        <!--  if get arbeitsmodel, soll select-->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputSelectArbeitsModell">Arbeitsmodell</label>
            <select class="form-select" name="ArbeitsModell" id="inputSelectArbeitsModell">
                <option style="text-align: center"
                        value="0" <?php echo empty($result[0]) ? "selected" : "" ?>>Wählen aus.... </p></option>
                <?php
                //select from BD
                //           var_dump($azm);
                for ($i = 1; $i <= 3; $i++) {
                    if ($azm == $i) {
                        $active = "selected";
                    } else {
                        $active = "";
                    }
                    switch ($i) {
                        case 1:
                            $text = "Arbeitsmodel 1 - 20 Stunde pro Woche";
                            break;
                        case 2:
                            $text = "Arbeitsmodel 2 - 37,5 Stunde pro Woche";
                            break;
                        case 3:
                            $text = "Arbeitsmodel 3 - 40 Stunde pro Woche";
                            break;
                    }
                    echo '<option value="' . $i . '" ' . $active . '>' . $text . '</option>';
                }

                ?>
            </select>
            <label id = "summaTimeAllDay" class="input-group-text" for="inputSelectArbeitsModell"></label>
        </div>
        <!--  users_arbeitsmodell per WochenTag-->

        <div class="input-group mb-3">

            <table class="table table-primary table-striped table-active table-bordered border-primary">
                <thead>
                <tr class="table-primary">
                    <td class="table-primary">
                        <label class="table-primary" for="inputMontag">Montag</label>
                    </td>
                    <td class="table-primary">
                        <label class="table-primary" for="inputDienstag">Dienstag</label>
                    </td>
                    <td class="table-primary">
                        <label class="table-primary" for="inputMittwoch">Mittwoch</label>
                    </td>
                    <td class="table-primary">
                        <label class="table-primary" for="inputDonnerstag">Donnerstag</label>
                    </td>
                    <td class="table-primary">
                        <label class="table-primary" for="inputFreitag">Freitag</label>
                    </td>
                </thead>
                <tbody>
                <tr class="table-primary">
                    <td class="table-primary">
                        <input id="inputMontag" type="time" class="form-control" placeholder="Montag" aria-label="Montag"
                               aria-describedby="basic-addon2" name="Montag" value="08:00">
                                               </td>
                    <td class="table-primary">
                        <input id="inputDienstag" type="time" class="form-control" placeholder="Dienstag" aria-label="Dienstag"
                               aria-describedby="basic-addon2" name="Montag" value="08:00">
                       </td>
                    <td class="table-primary">
                        <input id="inputMittwoch" type="time" class="form-control" placeholder="Mittwoch" aria-label="Mittwoch"
                               aria-describedby="basic-addon2" name="Mittwoch" value="08:00">
                        </td>
                    <td class="table-primary">
                        <input id="inputDonnerstag" type="time" class="form-control" placeholder="Donnerstag" aria-label="Donnerstag"
                               aria-describedby="basic-addon2" name="Donnerstag" value="08:00">
                        </td>
                    <td class="table-primary">
                        <input id="inputFreitag" type="time" class="form-control" placeholder="Freitag" aria-label="Freitag"
                               aria-describedby="basic-addon2" name="Freitag" value="05:30">
                        </td>
                </tr>

                </tbody>


            </table>


        </div>
        <!--  if admin, soll select -->
        <div class="input-group mb-3 end">
            <div class="input-group-text">
                <input id="rolles" class="form-check-input mt-0" type="checkbox" name="rolles"
                    <?php if (isset($result[0]["rolles_ID"]) && $result[0]["rolles_ID"] == "1") {
                        echo "checked";
                        $rolles = "1";
                    } ?>
                       aria-label="user">
            </div>
            <span class="input-group-text" id="basic-addon2">admin</span>

        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">PersonalNummer</span>
            <input type="text" class="form-control" placeholder="12345" aria-label="personalNR"
                   aria-describedby="basic-addon1" name="personalNR"
                   value="<?= inputEmployee($result, 'personalNR') ?>">
        </div>


        <!--  if get departament, soll selected-->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputSelectAbteilung">Abteilung</label>
            <select class="form-select" name="abteilung" id="inputSelectAbteilung">
                <option style="text-align: center" value="0"
                ">Wählen aus.... </p></option>
                <?php
                //select from BD
                $abt = $result[0]["Abteilung_ID"];
                for ($i = 1; $i <= 3; $i++) {
                    if ($abt == $i) {
                        $active = "selected";
                    } else {
                        $active = "";
                    }
                    switch ($i) {
                        case 1:
                            $text = "Personalabteilung";
                            break;
                        case 2:
                            $text = "Entwicklung";
                            break;
                        case 3:
                            $text = "Grafik";
                            break;
                    }
                    echo '<option value="' . $i . '" ' . $active . '>' . $text . '</option>';
                }

                ?>

            </select>
        </div>

        <button type="submit" class="btn btn-secondary btn-lg m-3" value="submit">Speichern</button>
    </form>

    <button type="reset"><a href="alleMitarbeiter.php">Zuruck</a></button>

</div>


</div>


</div>

<script>

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">


</script>


</body>

</html>
