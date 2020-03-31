<?php
	switch ($_GET["users"]) {
		case 'new':
			
			$action = $url;
			$inputs = [
				"name" => ["text", "", "Fulde navn", 1],
				"initials" => ["text", "", "Initialer", 1],
				"password" => ["password", "", "Kodeord", 0],
				"perm" => ["select", $perms, "rettigheder", 1],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];
			
			if($_POST["submit"])
				mysqli_query($conn, "INSERT INTO `employees` (`permission`, `fullname`, `initials`, `password`, `picture`) VALUES ('".$_GET["permission"]."', '".$_GET["name"]."', '".$_GET["initials"]."', '".$_GET["pass"]."', '".$_GET["picture"]."')");
			break;

		case 'edit':
			mysqli_query($conn, "UPDATE `employees` SET `password` = '". $_GET["pass"] ."' WHERE `id` = '". $_GET["id"] ."'");
			break;

		case 'delete':
			mysqli_query($conn, "DELETE FROM `employees` WHERE `id`='".$_GET["id"]."'");
			break;

	}

	include_once "overlay.php";