<?php
/**
 * Created by PhpStorm.
 * User: Marc Millán
 * Date: 12/03/2017
 * Time: 15:34
 */


if(!empty($_POST)) {

    $nameUser = $_POST['name'];
    $passW = $_POST['passwordUser'];
    $eMail = $_POST['email'];
    $dateBirth = $_POST['bday'];

    $ddbb = new PDO('mysql:host=localhost;dbname=usersddbb', 'root', '');
    $ddbb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stringFreeUser = "SELECT username FROM users WHERE username = " . "'" .$nameUser ."'  LIMIT 1";

    $namePossible = $ddbb->query($stringFreeUser);
    $namePossible->execute();

    $reservedUser = false;
    $rows = $namePossible;
    foreach ($rows as $row){
        $reservedUser = true;
        break;
    }
    //Si el nombre de usuario solicitado no existe, sigo evaluando la petición, ahora el email
    if (!$reservedUser) {
        $stringFreeEmail = "SELECT email FROM users WHERE email = " . "'" .$eMail ."'  LIMIT 1";
        $emailPossible = $ddbb->query($stringFreeEmail);
        $emailPossible->execute();
        $rows = $emailPossible;
        foreach ($rows as $row){
            $reservedUser = true;
            break;
        }
        //Si email y nombre no están disponibles, lo registro en la bbdd
        if (!$reservedUser) {
            $statement = $ddbb->prepare("INSERT INTO users (username, email, birthdate, password) VALUES (:name,  :email, :birthdate, :password)");
            $statement->bindParam(':name', $nameUser, PDO::PARAM_STR);
            $statement->bindParam(':email', $eMail, PDO::PARAM_STR);
            $statement->bindParam(':birthdate', $dateBirth, PDO::PARAM_STR);
            $statement->bindParam(':password', $passW, PDO::PARAM_STR);

            if (!$statement) {
                print_r($ddbb->errorInfo());
            }
            $statement->execute();
        }
    }
    if ($reservedUser) {
        header("Location: usuarioExistente.html");
        exit();
    }
}
header('Location: Practica1Main.php');
?>