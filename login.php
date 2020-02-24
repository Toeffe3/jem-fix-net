<?php
session_start();
include __DIR__."/dbcon.php";
if(isset($_GET["logout"])) {
  session_start();
  session_unset();
  session_destroy():
  $_SESSION = array();
  header('Location: http://jemfixnet.dk/');
}
?>
<?php
if(!empty($_POST["email"]) && !empty($_POST["pass"]) && empty($_POST["user"])) {
  $email = $_POST['email'];
  $pass = md5($_POST['pass']);
  $login = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$email' AND `password` = '$pass'");
  if (mysqli_num_rows($login) == 1) {
    $acc = mysqli_fetch_assoc($login);
    $_SESSION["user"] = $acc["id"];
    $_SESSION["name"] = $acc["name"];
    header('Location: http://jemfixnet.dk/');
  } else {
    header('Location: http://jemfixnet.dk/');
  }
}else if(!empty($_SESSION["user"])) {
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form class="" action="index.html" method="post">
      <input type="text" name="" value="">
      <input type="password" name="" value="">
      <input type="submit" name="" value="">
    </form>
  </body>
</html>
<?php } ?>
