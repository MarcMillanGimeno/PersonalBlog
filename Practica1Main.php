<?php
/**
 * Created by PhpStorm.
 * User: Marc Millán
 * Date: 15/03/2017
 * Time: 13:04
 */
session_start();
$inicioSesion = false;
$ddbb = new PDO('mysql:host=localhost;dbname=usersddbb', 'root', '');
$ddbb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (isset($_COOKIE['codeCookie'])) {
    $Cookieexist = false;
    $codeCookie = $_COOKIE['codeCookie'];
    $StringQuery = "SELECT name_user FROM sesionuser WHERE clave_sesion = " . "'" . $codeCookie . "'" . " LIMIT 1";
    $check = $ddbb->query($StringQuery);
    $check->execute();
    foreach ($check as $row) {
        $Cookieexist = true;
        $userCookie = $row['name_user'];
        $inicioSesion = true;
        break;
    }

    if ($Cookieexist){
        $StringQuery = "SELECT username FROM users WHERE id = " . "'" . $userCookie . "'" . " LIMIT 1";
        $checkname = $ddbb->query($StringQuery);
        $checkname->execute();
        foreach ($checkname as $row) {
            $userName = $row['username'];
            $_SESSION['name'] = $userName;
            break;
        }
    } else {
        setcookie("codeCookie","",time()-3600*60*24*7,"/");
    }
}
if ($inicioSesion == true){
    $StringQuery = "SELECT * FROM posts ORDER BY posted DESC LIMIT 1000";
}else{
    $StringQuery = "SELECT * FROM posts ORDER BY posted DESC LIMIT 10";
}
$queryPost = $ddbb->query($StringQuery);
$queryPost->execute();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Practica1</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="./mainStyle.css">

  </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">BLOG - Practica 1</a>
                </div>
                <?php if ($inicioSesion == false) {?>
                    <div id="navbar" class="navbar-collapse collapse">
                        <form action='signIn.php' class="navbar-form navbar-right" method="POST">
                            <div class="form-group">
                                <input id="name" name="name" type="text" placeholder="User name"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="passwordUser" name="passwordUser" type="password" placeholder="Password"
                                       class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Sign in</button>

                            <a class="btn btn-danger" href="./Practica1Registre.html" role="button">Sign up !!</a>

                        </form>
                    </div>
                    <?php
                    }else{
                        ?>
                    <div id="navbar" class="navbar-collapse collapse">
                        <form action='signOut.php' class="navbar-form navbar-right" method="POST">
                            <h3>
                                Hi <strong><?php echo $userName; ?></strong>
                            </h3>
                            <a class="btn btn-danger" href="./signOut.php" role="button">Sign OUT</a>
                        </form>
                    <?php
                    }
                    ?>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav">
                    <h4>Marc Millán's Blog</h4>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#section1">Home</a></li>
                        <li><a href="#section2">Posts Recents</a></li>
                        <li><a href="#section3">Posts favorites</a></li>
                        <li><a href="#section3">Most popular post</a></li>
                    </ul><br>
                </div>

                <?php if ($inicioSesion == true) {?>
                <form role="form" id = "container_posts" method="post" action = "postEntries.php">
                    <div class="form-group">
                        <h3>Create a post:</h3>
                        <h4>Title post : </h4><input rows = "2" id="titlePost" name="titlePost" type="text" placeholder="Write the title of the post" class="form-control">
                        <textarea class="form-control" rows="3" id = "textArea" name="textArea" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                <br><br>
                <?php } ?>

                <div class="col-sm-9">
                    <h4><small>RECENT POSTS</small></h4>
                    <hr>

                    <?php foreach ($queryPost as $row) { ?>

                        <h2><?php echo $row['title']; ?></h2>
                        <h5><span class="glyphicon glyphicon-time"></span> Post by <strong><?php echo $row['user_creator']; ?></strong>, <?php echo $row['posted']; ?>.</h5>
                        <p><?php echo $row['content']; ?></p>
                        <br><br>
                    <?php } ?>

                </div>
            </div>
        </div>

        <footer class="container-fluid">
            <p>Marc Millán Gimeno  - (ls29307) &ctdot; Projectes Web &copy;</p>
        </footer>

    </body>
</html>
