﻿<?php
	haveAccessTo(__FILE__);

	switch ($_GET["cyklisker"]) {
		case 'new':
			
			$spaces = array();
			$e = mysqli_query($conn, "SELECT * FROM `spaces` WHERE 1 ORDER BY spaceid ASC");
			while($r = mysqli_fetch_assoc($e)) {
				$spaces[$r["stoargeid"]] = $r["stoargeid"].(!empty($r["spaceid"])?" (".$r["spaceid"].")":"");
			}

			$action = $url;
			$inputs = [
				["info", "Opret en cyklisk. Hold <i>Ctrl</i> nede for at vælge flere fra listen."],
				"spaceid" => ["multiselect", $spaces, "Space(s)", 1],
				"start" => ["date", "", "Start dato", 1],
				"must" => ["date", "", "'Skal' dato", 1],
				"redirect" => ["hidden",$prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];

			if($_POST["submit"]) {
				if(mysqli_query($conn, "INSERT INTO `cyklisks` (`spaces`, `start`, `mustdate`) VALUES ('".implode(", ",$_POST["spaceid"])."','".$_POST["start"]."','".$_POST["must"]."')"))
					 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				else echo "<script>alert('Fejl ved oprettelse af cyklisk')</script>";
			}
			break;
	}

	include_once "overlay.php";