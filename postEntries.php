<?php
/**
 * Created by PhpStorm.
 * User: Marc Millán
 * Date: 12/03/2017
 * Time: 15:34
 */

session_start();
if(!empty($_POST)) {

    $titlePost = $_POST['titlePost'];
    $contentPost = $_POST['textArea'];
    echo $titlePost;
    echo $contentPost;

    $ddbb = new PDO('mysql:host=localhost;dbname=usersddbb', 'root', '');
    $ddbb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $statement = $ddbb->prepare("INSERT INTO posts (title, content, user_creator) VALUES (:title, :content, :name)");
    $statement->bindParam(':title', $titlePost, PDO::PARAM_STR);
    $statement->bindParam(':content', $contentPost, PDO::PARAM_STR);
    $statement->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);

    if (!$statement) {
        print_r($ddbb->errorInfo());
    }
    $statement->execute();

    header('Location: Practica1Main.php');
}
exit();
?>