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

	function haveAccessTo($page) {
		global $conn, $prevpage;
		$page = preg_replace("/\/home\/jemfixne\/public_html(\/test)?\//", "", $page);
		if(preg_match("/subsites/", $page)) {
			$blocktype = "PAGE";
			$page = preg_replace("/subsites/", "", $page);
		} else if(preg_match("/functions/", $page)) {
			$blocktype = "FUNC";
			$page = preg_replace("/functions/", "", $page);
		} else if(preg_match("/documents/", $page)) 
			if(preg_match("/documents\/.+\//", $page)) {
				$blocktype = "DOC";
				$page = preg_replace("/documents\/.+\//", "", $page);
			} else {
				$blocktype = "TAG";
				$page = preg_replace("/documents/", "", $page);
			}
		else echo "INGEN ADGANGSREGLER FOR DENNE TYPE!";
		
		$userAccessLevel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `permission` FROM `employees` WHERE `id` = ".$_SESSION['user']))["permission"];
		$accessCheck = mysqli_query($conn, "SELECT * FROM `permissions` WHERE path LIKE '%".$page."%' AND `blocktype` LIKE '".$blocktype."'");
		$requiredAccessLevel = mysqli_fetch_assoc($accessCheck)['access'];
		if(mysqli_num_rows($accessCheck)>0) 
			if($userAccessLevel == -1) return true;
			else if($userAccessLevel >= $requiredAccessLevel) return true;

		echo '<div id="page"><div class="dark red bg-white full box"><a href="'.$prevpage.'"><span class="back icon"></span>Tilbage</a><br><br><h1>Du har ikke adgang til denne '.blocktotext($blocktype).'!</h1><p>Kontakt venligst din overordnet hvis du mener dette er en fejl.</p><p>'.ucfirst(blocktotext($blocktype)).': '.$page.'<br>Agdangsniveau: '.(isset($requiredAccessLevel)?$userAccessLevel.'/'.$requiredAccessLevel:'<b>Ikke sat!</b>').'</p></div></div>';
		include_once "footer.php";
		exit; //Prevent furthure loading of the page

	}

	function blocktotext($string) {
		switch ($string) {
			case 'PAGE': return 'side';
			case 'FUNC': return 'funktion';
			case 'TAG': return 'mappe';
			case 'DOC': return 'fil';
			default: return 'kategori';
		}
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
