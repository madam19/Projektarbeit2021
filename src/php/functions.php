<?php

function getPdo(){
    $dsn = 'mysql:dbname=knmde_db85;host=dedi154.your-server.de;charset=utf8';
    $user = 'knmde_85';
    $pass = "gM5FGuqWab52QzqT";

    $pdo = new PDO($dsn, $user, $pass);
    return $pdo;
}

function getUserZeiten($pdo, $query, $email){
    /** @var PDO $pdo */
    $stmt = $pdo -> prepare($query);
    $stmt->execute([":email" => $email]);     //
    $result = $stmt->fetchAll();
    return $result;
}

function getTagDE($date) {

  /* setlocale($date, "de_DE");
   (strftime("%A, $tag"));*/
    $tag = date('l', strtotime($date));

    return  $tag;
}

function inputDaten ($str, $placeholder){
    ?>
    <input type="text" name="$str"  placeholder= " <?php echo $placeholder ?> " onkeydown="handleInput(this)" onblur="sendValue()"
           value="<?=$_GET['$str'] ?? ''?>" >
    <?php
    return $_GET;
}



