<?php
if (isset($_GET["logout"])) {
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    echo '<script>window.href.location="http://jemfixnet.dk?login=logout"</script>'
} else if (!empty($_POST["initials"]) && !empty($_POST["password"])) {
    $initi = $_POST['initials'];
    $pass = md5($_POST['password']);
    $login = mysqli_query($conn, "SELECT * FROM `employees` WHERE `initials` = '$initi' AND `password` = '$pass'");
    if (mysqli_num_rows($login) == 1) {
        $acc = mysqli_fetch_assoc($login);
        $_SESSION["user"] = $acc["id"];
        $_SESSION["initials"] = $acc["initials"];
        echo '<script>window.href.location="http://jemfixnet.dk?login=sucess"</script>'
    } else echo '<script>window.href.location="http://jemfixnet.dk?login=failure"</script>';
} else {?>
    <div class="bg-grey dark white" id="page">
        <form class="" action="index.php" method="post">
            <span class="box">Initialer</span> <input class="box" type="text" name="initials" placeholder="JFN"><br>
            <span class="box">Password</span> <input class="box" type="password" name="password" placeholder="Password"><br>
            <input class="box" type="submit" value="Log ind">
        </form>
    </div>
<?php }
