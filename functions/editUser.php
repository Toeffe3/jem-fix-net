<?php
	switch ($_GET["users"]) {
    	case 'new'
						mysqli_query($conn, "INSERT INTO `employees` (`permission`, `fullname`, `initials`, `password`, `picture`) VALUES ('".$_GET["permission"]."', '".$_GET["name"]."', '".$_GET["initials"]."', '".$_GET["pass"]."', '".$_GET["picture"]."')");
            break;

    	case 'edit':
						mysqli_query($conn, "UPDATE `employees` SET `password` = '". $_GET["pass"] ."' WHERE `id` = '". $_GET["id"] ."'");
            break;

    	case 'delete':
            mysqli_query($conn, "DELETE FROM `employees` WHERE `id`='".$_GET["id"]."'");
            break;

	    default:
            //View user
            //$_GET["id"]
            break;
    }
?>
