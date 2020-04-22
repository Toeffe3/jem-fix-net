<?php
	haveAccessTo(__FILE__);

	switch ($_GET["spaces"]) {
		case 'new':

			$action = $url;
			$inputs = [
				["info", "Opret et nyt space."],
				"stoargeid"=> ["text", "", "Extern nummer", 1],
				"spaceid" => ["text", "", "Intern nummer", 0],
				"redirect" => ["hidden",$prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];

			if($_POST["submit"]) {
				if(mysqli_query($conn, "INSERT INTO `spaces` (`stoargeid`, `spaceid`, `x`, `y`, `w`, `h`) VALUES ('".$_POST["stoargeid"]."','".(empty($_POST["spaceid"])?"?":$_POST["spaceid"])."',20,20,65,35)"))
					 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				else echo "<script>alert('Fejl ved oprettelse af space')</script>";
			}
			break;
	}

	include_once "overlay.php";
