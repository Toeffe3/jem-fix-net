<?php
session_start();
if (!defined(__DIR__)) define(__DIR__, dirname(__FILE__));
include __DIR__."/dbcon.php";

if (isset($_GET["logout"])) {
  session_start();
  session_unset();
  session_destroy();
  $_SESSION = array();
  header('Location: http://jemfixnet.dk?login=logout');
} else if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
  $email = $_POST['email'];
  $pass = md5($_POST['pass']);
  $login = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$email' AND `password` = '$pass'");
  if (mysqli_num_rows($login) == 1) {
    $acc = mysqli_fetch_assoc($login);
    $_SESSION["user"] = $acc["id"];
    $_SESSION["email"] = $acc["email"];
    header('Location: http://jemfixnet.dk?login=sucess');
  } else header('Location: http://jemfixnet.dk?login=failure');
} else {?>
<!DOCTYPE html>
<html lang="da" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form class="" action="index.php" method="post">
      <input type="email" name="email" placeholder="ansat@jemfixnet.dk"><br>
      <input type="password" name="pass" placeholder="Kodeord"><br>
      <input type="submit" value="Log ind">
    </form>
  </body>
</html>
<?php }
