<?php
/**
 * Created by PhpStorm.
 * User: Marc Millán
 * Date: 12/03/2017
 * Time: 0:33
 */


if (!empty($_POST)) {

    $isUserInDDBB = false;
    echo "$isUserInDDBB";
    $nameUser = $_POST['name'];
    $passW = $_POST['passwordUser'];

    $database = new PDO('mysql:host=localhost;dbname=usersddbb', 'root', '');
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stringIsInDDBB = "SELECT * FROM users WHERE username = " . "'" .$nameUser ."'" . " AND password = "."'" . $passW ."'" ." LIMIT 1";

    $checkUserInDDBB = $database->query($stringIsInDDBB);
    $checkUserInDDBB->execute();
    $rows = $checkUserInDDBB;

    foreach ($checkUserInDDBB as $row){
        $isUserInDDBB = true;
        $userId = $row['id'];
        break;
    }
    var_dump($isUserInDDBB );
    if ($isUserInDDBB){

        $long = 40;
        $cadena = 'qwertyuioplkmjnhbgvfcdxsza1234567890';
        $maxCombinations = strlen($cadena)-1;
        $claveUser = '';
        for($index = 0 ; $index < $long ; $index++)
            $claveUser .= $cadena{mt_rand(0,$maxCombinations)};

        $stringCookieCreate = "INSERT INTO sesionuser (name_user, clave_sesion) VALUES(" . "'" .$userId ."', " ."'" .$claveUser ."')";

        $insert = $database->query($stringCookieCreate);
        setcookie("codeCookie", $claveUser, time()+3600*60*24*7);
        header('Location: Practica1Main.php');
        exit();
    }
    header('Location: RepitSignIn.html');
}
?>
