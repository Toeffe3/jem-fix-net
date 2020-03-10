<?php
    declare(strict_types = 1);
    session_start();
    if (!defined(__DIR__)) define(__DIR__, dirname(__FILE__));
    include __DIR__."/dbcon.php";

    include_once "header.php";

    if(isset($_SESSION["user"])) {
        if($_GET["login"]=="sucess") echo '<script>window.href.location="?nyheder"</script>';
        if(isset($_GET["space"])) include_once "subsites/space.php";
        else if(isset($_GET["cyklisk"])) include_once "subsites/cyklisk.php";
        else if(isset($_GET["nyheder"])) include_once "subsites/nyheder.php";
        else if(isset($_GET["leder"])) include_once "subsites/leder.php";
        else if(isset($_GET["hr"])) include_once "subsites/hr.php";
    } else include_once "subsites/login.php";

    include_once "footer.php";
