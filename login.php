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
} else if (!empty($_POST["initials"]) && !empty($_POST["password"])) {
    $email = $_POST['initials'];
    $pass = md5($_POST['password']);
    $login = mysqli_query($conn, "SELECT * FROM `users` WHERE `initials` = '$email' AND `password` = '$pass'");
    if (mysqli_num_rows($login) == 1) {
        $acc = mysqli_fetch_assoc($login);
        $_SESSION["user"] = $acc["id"];
        $_SESSION["initials"] = $acc["initials"];
        header('Location: http://jemfixnet.dk?login=sucess');
    } else header('Location: http://jemfixnet.dk?login=failure');
} else {?>
    <div class="bg-grey dark white" id="login" >
        <form class="" action="index.php" method="post">
            <img src="logo.png" alt="LOGO"><br>
            <span>Initialer</span><input type="text" name="initials" placeholder="DND"><br>
            <span>Password</span><input type="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Log ind">
        </form>
    </div>
<?php }
