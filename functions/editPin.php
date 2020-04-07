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

			if($_POST["submit"]) {
				if(!empty($_POST["ulink"]) && !empty($_POST["name"])) {
					$link = $_POST["ulink"];
					$name = $_POST["name"];
				} else if(!empty($_POST["flink"])) {
					$link = $_POST["flink"];
					$name = $functions[$link];
				}

				mysqli_query($conn, "INSERT INTO `pinned` (`userid`, `link`, `customlabel`) VALUES ('".$_SESSION["user"]."', '".$link."', '".$name."')");
				echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
			}
			break;

		case 'delete':
			mysqli_query($conn, "DELETE FROM `pinned` WHERE `reference` = ".$_GET["id"]);
			echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
			break;
	}

	include_once "overlay.php";
