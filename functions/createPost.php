<?php
    declare(strict_types = 1);
    session_start();
    if (!defined(__DIR__)) define(__DIR__, dirname(__FILE__));
    include __DIR__."/../dbcon.php";

    if(!empty($_SESSION["initials"]) && !empty($_POST["from"]) && !empty($_POST["title"]) && !empty($_POST["text"])) {

        //TODO: Add permission check
        
        $id = mysqli_fetch_assoc(mysqli_querry($conn, "SELECT `id` from `employees` WHERE `initiales` ='".$_SESSION["initials"]."' LIMIT 1"));
        if(mysqli_querry($conn, "INSERT INTO `posts` (`userid`, `from`, `title`, `text`) VALUES (".$id.", ".$_POST["from"].", ".$_POST["title"].", ".$_POST["text"].")"))
             echo "Opslag oprettet";
		else
            echo "Fejl ved oprettelse af post<br>".mysqli_error($conn); 

	} else
        echo "Alle felter er ikke blevet udfyldt";