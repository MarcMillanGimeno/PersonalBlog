<?php
/**
 * Created by PhpStorm.
 * User: Marc
 * Date: 15/03/2017
 * Time: 14:40
 */

if (isset($_COOKIE['codeCookie'])) {

    $ddbb = new PDO('mysql:host=localhost;dbname=usersddbb', 'root', '');
    $ddbb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $codeCookie = $_COOKIE['codeCookie'];
    $StringQuery = "DELETE FROM sesionuser WHERE clave_sesion = " . "'" . $codeCookie . "'";
    $check = $ddbb->query($StringQuery);
    $check->execute();

    setcookie("codeCookie", "", time() - 3600 * 60 * 24 * 7, "/");

    header('Location: Practica1Main.php');
}