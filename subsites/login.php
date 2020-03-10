<?php
if (isset($_GET["logout"])) {
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    echo '<script>window.href.location="http://jemfixnet.dk?login=logout"</script>';
} else if (!empty($_POST["initials"]) && !empty($_POST["password"])) {
    $initi = $_POST['initials'];
    $pass = md5($_POST['password']);
    $login = mysqli_query($conn, "SELECT * FROM `employees` WHERE `initials` = '$initi' AND `password` = '$pass'");
    if (mysqli_num_rows($login) == 1) {
        $acc = mysqli_fetch_assoc($login);
        $_SESSION["user"] = $acc["id"];
        $_SESSION["initials"] = $acc["initials"];
        echo '<script>window.href.location="http://jemfixnet.dk?login=sucess"</script>';
    } else echo '<script>window.href.location="http://jemfixnet.dk?login=failure"</script>';
} else {?>
    <div class="bg-grey dark white" id="login">
        <center>
            <form class="" action="index.php" method="post">
                <span>Initialer</span> <input type="text" name="initials" placeholder="JFN"><br>
                <span>Password</span> <input type="password" name="password" placeholder="Password"><br>
                <input type="submit" value="Log ind">
            </form>
        </center>
    </div>
<?php }
