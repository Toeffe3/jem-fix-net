<?php
    declare(strict_types = 1);
    session_start();
    if (!defined(__DIR__)) define(__DIR__, dirname(__FILE__));
    include __DIR__."/dbcon.php";

    if(isset($_SESSION["user"])) {
        include_once "header.php";
        include_once "subsites/login.php";
    } else include_once "subsites/login.php";
