<?php
	//TODO: Add permission check

	switch ($_GET["pin"]) {
		case 'new':
			$functions = [
				"" => "(Ingen)",
				"?login=logout" => "Log af",
				"?post=new" => "Opret opslag",
				"?post=edit" => "Ret opslag",
				"?document=new" => "Upload dokument"
			];

			$action = $url;
			$inputs = [
				["info", "Opret en genvej til en fil eller side."],
				"name" => ["text", "", "Kaldenavn", 0],
				"ulink" => ["text", "", "Link", 0],
				["info", "<br>Eller opret genvej til én af følgene funktioner"],
				"flink" => ["select", $functions, "Funktion", 0],
				"redirect" => ["hidden",$prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];
			if($_POST["submit"] && ( (!empty($_POST["flink"]) && !empty($_POST["name"]) )||!empty($_POST["ulink"]))) {
				$url = !empty($_POST["flink"])?$_POST["flink"]:$_POST["ulink"];
				if(mysqli_query($conn, "INSERT INTO `pinned` (`userid`, `link`, `customlabel`) VALUES ('".$_SESSION["user"]."', '".$_POST["link"]."', '".$_POST["name"]."')"))
					echo "<script>window.location.href='".$prevpage."?sucess'</script>";
				else
					echo "<script>window.location.href='".$prevpage."?error'</script>";
				break;
			}

		case 'edit':

			break;

		case 'delete':
			if(mysqli_query($conn, "DELETE FROM `pinned` WHERE `reference` = ".$_GET["id"]))
				echo "<script>window.location.href='".$prevpage."?sucess'</script>";
			else
				echo "<script>window.location.href='".$prevpage."?error'</script>";
			break;
	}

	include_once "overlay.php";
