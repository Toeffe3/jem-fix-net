<?php
	haveAccessTo(__FILE__);
	switch ($_GET["post"]) {
		case 'new':
			
			$key = $_SESSION["perm"]!=-1?$_SESSION["perm"]:9;
			if($key > 0) $categories[0] = "Øvrige";
			if($key > 1) $categories[1] = "Indkøb";
			if($key > 4) {
				$categories[2] = "Ledelsen";
				$categories[3] = "[Ledere] Ledelsen";
			}
			if($key > 3) {
				$categories[4] = "[HR] Formularer";
				$categories[5] = "[HR] Genveje";
				$categories[6] = "[HR] Personalegoder";
				$categories[7] = "[HR] Rettighedder og pligter";
				$categories[8] = "[HR] MUS";
				$categories[9] = "[HR] Persondata forordning";
			}

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
				}
			break;

		case 'edit':
			
			if(empty($_POST["id"])) {
				$posts = array();
				$postssql = mysqli_query($conn, "SELECT `post`, `title` FROM `posts` WHERE 1");
				while($postspre = mysqli_fetch_assoc($postssql)) $posts[$postspre["post"]] = $postspre["title"];

				$action = $url;
				$inputs = [
					["info", "Vælg et opslag"],
					"id" => ["select", $posts,"Opslagets titel", 1],
					"redirect" => ["hidden", $prevpage, "", 0],
					"sel" => ["submit", "Vælg", "", 0]
				];

			} else {
			
				$prefill = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `posts` WHERE `post` = ".$_POST["id"]));
				$action = $url;
				$inputs = [
					["info", "Opret et nyt opslag"],
					"title" => ["text", $prefill["title"],"Titel på opslag", 1],
					"text" => ["richtext", $prefill["text"], "Brødtekst", 1],
					"redirect" => ["hidden", $prevpage, "", 0],
					"id" => ["hidden", $_POST["id"], "", 0],
					"edit" => ["submit", "Ændre", "", 0],
					"delete" => ["submit", "Fjern (kan ikke fortrydes)", "", 0]
				];

			}

			if(isset($_POST["delete"]))
				if(mysqli_query($conn, "DELETE FROM `posts` WHERE `post` = ".$_POST["id"]))
						echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				else echo "<script>alert('Fejl - kunne ikke fjerne opslag')</script>";

			else if(isset($_POST["edit"]))
				if(mysqli_query($conn, "UPDATE `posts` SET `title` = '".$_POST["title"]."', `text` = '".$_POST["text"]."' WHERE `post` = ".$_POST["id"]))
						echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				else echo "<script>alert('Fejl - kunne ikke redigere opslag')</script>";

			break;

	}

	include_once "overlay.php";
