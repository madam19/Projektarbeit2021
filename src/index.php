

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
    <!--add сss-file-->

</head>

<body>

    <div class="frist-block">
        <h1> Arbeitszeit</h1>
        <!-- add image -->
        <div class="main">
            <div class="image">
                <img src="./image/zeit.jpg" alt="time" class="imagetime">

            </div>
            <div class="inputData">

                <form action="mydata.php" method="post">
                    <!--input email-->
                    <input type="email" name="emailUser" placeholder="deine@email.de"
                           value="<?=$_POST['emailUser'] ?? ''?>"
                    ><br>
                    <!-- input password -->
                    <input type="password" name ="passwordUser" placeholder="Password"
                           value="<?=$_POST['passwordUser'] ?? ''?>"
                    ><br>


                    <button type="submit">Enter</button>

                </form>

            </div>

        </div>
    </div>


    <script src="./js/main.js"></script>

</body>

</html>