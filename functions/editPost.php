<?php
    declare(strict_types = 1);
    session_start();
    if (!defined(__DIR__)) define(__DIR__, dirname(__FILE__));
    include __DIR__."/../dbcon.php";

    if(!empty($_SESSION["initials"]) && !empty($_POST["postid"])) {

        $perm = mysqli_fetch_assoc(mysqli_querry($conn, "SELECT `id`, `permession` from `employees` WHERE `initiales` ='".$_SESSION["initials"]."' LIMIT 1"));
        $puid = mysqli_fetch_assoc(mysqli_querry($conn, "SELECT `post`, `userid` from `POST` WHERE `post` ='".$_POST["postid"]."' LIMIT 1"));
        if($perm["permission"] == -1 || $perm["id"] == $puid["userid"]) {
        
            if(isset($_POST["delete"]))

                if(mysqli_querry($conn, "DELETE FROM `posts` WHERE post = ".$puid["post"]))
                         echo "Fjernede opslaget";
                    else echo "Kunne ikke fjerne opslaget";

			else {

                if(!empty($_POST["title"]))
                    if(mysqli_querry($conn, "UPDATE `posts` (`title`) VALUES (".$_POST["title"].") WHERE post = ".$puid["post"])))
                         echo "Ændrede titelen";
                    else echo "Kunne ikke ændre titlen";
                
                if(!empty($_POST["text"]))
                    if(mysqli_querry($conn, "INSERT INTO `posts` (`text`) VALUES (".$_POST["text"].") WHERE post = ".$puid["post"])))
                         echo "Ædrede teksten";
                    else echo "Kunne ikke ændre teksten";
            
            }
            
        } else echo "Du har ikke rettigheder til at ændre dette opslag";
    } else echo "Fejl";