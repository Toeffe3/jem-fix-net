<?php
	haveAccessTo(__FILE__);
	switch ($_GET["post"]) {
		case 'new':

			$categories = [
				"0" => "Øvrige",
				1 => "Ledelsen",
				2 => "Indkøb"
			];

			$action = $url;
			$inputs = [
				["info", "Opret et nyt opslag"],
				"title" => ["text", "","Titel på opslag", 1],
				"category" => ["select", $categories,"Kategori", 1],
				"text" => ["richtext", "", "Brødtekst", 1],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];
			

			if($_POST["submit"])
				if(!empty($_SESSION["user"]) && !empty($_POST["title"]) && !empty($_POST["text"])) {
					$text = mysqli_real_escape_string($conn, htmlspecialchars($_POST["text"], ENT_QUOTES, "UTF-8"));
					$text = trim(preg_replace('/\s\s+/', '<br>', $text));
					if(mysqli_query($conn, "INSERT INTO `posts` (`userid`, `from`, `title`, `text`) VALUES ('".$_SESSION["user"]."', '".$_POST["category"]."', '".$_POST["title"]."', '".$text."')"))
						 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
					else echo "<script>alert('Fejl ved oprettelse af opslag')</script>";
				} else {
					echo "bhu";
				}
			break;

		case 'edit':

			//kjshkjahk


			/*if($_POST["submit"]) {
				if(!empty($_SESSION["initials"]) && !empty($_POST["postid"])) {

					$perm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `id`, `permession` from `employees` WHERE `initials` ='".$_SESSION["initials"]."' LIMIT 1"));
					$puid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `post`, `userid` from `POST` WHERE `post` ='".$_POST["postid"]."' LIMIT 1"));
					if($perm["permission"] == -1 || $perm["id"] == $puid["userid"]) {
		
						if(isset($_POST["delete"]))
							if(mysqli_query($conn, "DELETE FROM `posts` WHERE post = ".$puid["post"]))
									 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
								else echo "<script>alert('Fejl - kunne ikke fjerne opslag')</script>";

						else {
							if(!empty($_POST["title"]))
								if(mysqli_query($conn, "UPDATE `posts` (`title`) VALUES (".$_POST["title"].") WHERE post = ".$puid["post"]))
									 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
								else echo "<script>alert('Fejl - kunne ikke redigere opslag')</script>";
							if(!empty($_POST["text"]))
								if(mysqli_query($conn, "INSERT INTO `posts` (`text`) VALUES (".$_POST["text"].") WHERE post = ".$puid["post"]))
									 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
								else echo "<script>alert('Fejl - kunne ikke redigere opslag')</script>";
						}
					} else echo "<script>alert('Du har ikke redigheder til at ændre dette opslag')</script>";
				}
			}*/
			break;

	}

	include_once "overlay.php";
