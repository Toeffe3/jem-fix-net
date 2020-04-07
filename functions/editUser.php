<?php
	
	$perms = [
		0 => "Kun visning",
		1 => "Ansat",
		2 => "Ansat med rettigheder",
		3 => "Højtstillede ansat",
		4 => "Manager",
		5 => "Butikschef",
	   -1 => "Admin"
	];

	$users = array();
	$sql = mysqli_query($conn, "SELECT * FROM `employees` WHERE 1");
	while($user = mysqli_fetch_assoc($sql))
		$users[$user["id"]] = $user["initials"].": ".$user["fullname"];

	switch ($_GET["users"]) {
		case 'new':
			
			$action = $url;
			$inputs = [
				["info", "Opret en ny bruger, hvis der ikke angives noget kodeord vil det blive sat til: <b>1234</b>, og kan ændres på enhvert tidspunkt."],
				"name" => ["text", "", "Fulde navn", 1],
				"initials" => ["text", "", "Initialer", 1],
				"password" => ["password", "", "Kodeord", 0],
				"permission" => ["select", $perms, "rettigheder", 1],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];
			
			if($_POST["submit"])
				if(empty($_POST["password"]))
					mysqli_query($conn, "INSERT INTO `employees` (`permission`, `fullname`, `initials`) VALUES ('".$_POST["permission"]."', '".$_POST["name"]."', '".$_POST["initials"]."')");
				else
					mysqli_query($conn, "INSERT INTO `employees` (`permission`, `fullname`, `initials`, `password`) VALUES ('".$_POST["permission"]."', '".$_POST["name"]."', '".$_POST["initials"]."', '".md5($_POST["password"])."')");
			break;

		case 'edit':

			$action = $url;
			$inputs = [
				"id" => ["select", $users, "Vælg bruger", 1],
				"password" => ["password", "", "Nyt kodeord", 0],
				"name" => ["text", "", "Ændre navn", 0],
				"initials" => ["text", "", "Ændre initialer", 0, 3, 4],
				"permission" => ["select", $perms, "Ny rettighed", 0],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Ændre", "", 0]
			];
			
			if($_POST["submit"])
				mysqli_query($conn, "UPDATE `employees` SET `password` = '".md5($_POST["password"])."', `fullname` = '".$_POST["name"]."', `initials` = '".$_POST["initials"]."', `permission` = '".$_POST["permission"]."' WHERE `id` = '". $_POST["id"] ."'");

			break;

		case 'delete':

			$action = $url;
			$inputs = [
				"id" => ["select", $users, "Vælg bruger", 1],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Bekræft sletning af bruger", "", 0]
			];

			if($_POST["submit"])
				mysqli_query($conn, "DELETE FROM `employees` WHERE `id`='".$_POST["id"]."'");

			break;

	}

	include_once "overlay.php";