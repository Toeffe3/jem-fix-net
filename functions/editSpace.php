<?php
	haveAccessTo(__FILE__);

	switch ($_GET["spaces"]) {
		case 'new':

			$action = $url;
			$inputs = [
				["info", ""],
				"name" => ["text", "", "", 0],
				"redirect" => ["hidden",$prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];

			if($_POST["submit"]) {

			}
			break;

		case 'edit':
			
			break;

		case 'delete':
			
			break;
	}

	include_once "overlay.php";
