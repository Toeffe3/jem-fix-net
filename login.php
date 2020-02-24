<?php
session_start();
if( !defined( __DIR__ ) ) define( __DIR__, dirname(__FILE__) );
include __DIR__."/dbcon.php";

if (isset($_GET["logout"])) {
  session_start();
  session_unset();
  session_destroy();
  $_SESSION = array();
  header('Location: http://jemfixnet.dk?login=logout');
}

if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
  $email = $_POST['email'];
  $pass = md5($_POST['pass']);
  $login = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$email' AND `password` = '$pass'");
  if (mysqli_num_rows($login) == 1) {
    $acc = mysqli_fetch_assoc($login);
    $_SESSION["user"] = $acc["id"];
    $_SESSION["email"] = $acc["email"];
    header('Location: http://jemfixnet.dk?login=sucess');
  } else {
    header('Location: http://jemfixnet.dk?login=failure');
  }
} else if (!empty($_SESSION["user"])) {
  echo '<!DOCTYPE html>';
  echo '<html lang="en" dir="ltr">';
  echo '<head>';
  echo '<meta charset="utf-8">';
  echo '<title>Login</title>';
  echo '</head>';
  echo '<body>';
  echo '<form class="" action="login.php" method="post">';
  echo '<input type="email" name="email" value="">';
  echo '<input type="password" name="" value="">';
  echo '<input type="submit" name="" value="">';
  echo '</form>';
  echo '</body>';
  echo '</html>';
}
