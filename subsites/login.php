<?php
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
    $acc = mysqli_fetch_assoc($login);
    if (mysqli_num_rows($acc) == 1) {
        $_SESSION["user"] = $acc["id"];
        $_SESSION["initials"] = $acc["initials"];
        header('Location: http://jemfixnet.dk?login=sucess');
    } else header('Location: http://jemfixnet.dk?login=failure');
} else {?>
    <div class="bg-grey dark white" id="page">
        <form class="" action="index.php" method="post">
            <span class="box">Initialer</span> <input class="box" type="text" name="initials" placeholder="JFN"><br>
            <span class="box">Password</span> <input class="box" type="password" name="password" placeholder="Password"><br>
            <input class="box" type="submit" value="Log ind">
        </form>
    </div>
<?php }
