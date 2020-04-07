<?php
	declare(strict_types = 1);
	session_start();
	if (!defined(__DIR__)) define(__DIR__, dirname(__FILE__));
	include __DIR__."/dbcon.php";
	date_default_timezone_set("UTC"); //Overrides default Europe/Copenhagen (PHP throws errors that it is invalid)
	
	$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if(isset($_SESSION["prevpage"]) && isset($_SESSION["prevpage"][1])) {
		
		if($url != $_SESSION["prevpage"][1]) {
						   $prevpage = $_SESSION["prevpage"][1];
			$_SESSION["prevpage"][0] = $_SESSION["prevpage"][1];
		} else $prevpage = $_SESSION["prevpage"][0];
		$_SESSION["prevpage"][1] = $url;

	} else {
		$_SESSION["prevpage"] = array();
		$_SESSION["prevpage"][] = $url;
		$_SESSION["prevpage"][] = $url;
	}

	include_once "header.php";

	if(isset($_SESSION["user"])) {

		if(isset($_GET["users"])) include_once "functions/editUser.php";
		else if(isset($_GET["post"])) include_once "functions/editPost.php";
		else if(isset($_GET["document"])) include_once "functions/editDocument.php";
		else if(isset($_GET["folder"])) include_once "functions/editFolder.php";
		else if(isset($_GET["pin"])) include_once "functions/editPin.php";
		
		if(isset($_GET["login"])) include_once "subsites/login.php";
		else if(isset($_GET["nyheder"]))
			if(!empty($_GET["id"])) include_once "subsites/post.php";
			else include_once "subsites/nyheder.php";
		else if(isset($_GET["space"])) include_once "subsites/space.php";
		else if(isset($_GET["cyklisk"])) include_once "subsites/cyklisk.php";
		else if(isset($_GET["leder"])) include_once "subsites/leder.php";
		else if(isset($_GET["hr"])) include_once "subsites/hr.php";
		else if(isset($_GET["search"])) include_once "subsites/search.php";
		else include_once "subsites/nyheder.php";
	} else include_once "subsites/login.php";

	include_once "footer.php";
