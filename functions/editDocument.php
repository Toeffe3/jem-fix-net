<?php
	haveAccessTo(__FILE__);
	switch ($_GET["document"]) {
		case 'new':
			$current_tags = array();
			$directory = dir(__DIR__."/../documents/");
			while(false !== ($folder = $directory->read()))
				if($folder != "." && $folder != ".." && !preg_match('/\./', $folder))
					$current_tags[$folder] = $folder;

			$action = $url;
			$inputs = [
				["info", "Vælg en fil der skal uploades, denne fil kan refereres til i opslag mm."],
				"doc" => ["file","","Fil", 1],
				"tag" => ["select", $current_tags,"Kategori", 1],
				"docname" => ["text","", "Visningsnavn", 0],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Opret", "", 0]
			];

			if($_POST["submit"]) {
				$name = !empty($_GET["docname"])? $_GET["docname"] : $_FILES['doc']['name'];
				if(move_uploaded_file($_FILES['doc']['tmp_name'], __DIR__."/../documents/".$_POST["tag"]."/".$name))	//TODO: Create DB-entry ($_FILES['doc']['type'])
					 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				else echo "<script>alert('Fejl ved upload af fil')</script>";        
			}

			break;

		case 'edit':
			ignoreRedirect();

			$directory = dir(__DIR__."/../documents/");
			while(false !== ($folder = $directory->read()))
				if($folder != "." && $folder != ".." && !preg_match('/\./', $folder)) {
					$subdirectory = dir(__DIR__."/../documents/".$folder."/");
					while(false !== ($file = $subdirectory->read()))
						if($file != "." && $file != "..")
							$current_files[$folder][] = $file;
				}

			$action = $url;
			$inputs = [
				["info", "Vælg det dokument du vil ændre"],
				"sel" => ["fileexplorer", $current_files, "leder&document=edit", 1],
				"name" => ["text", "", "Ændre navn inkl (.)", 0],
				"tag" => ["text", "", "Ændre tag", 0],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Ændre", "", 0]
			];

			if($_POST["submit"]) {


				$from = __DIR__."/../documents/".$_GET["tag"]."/".$_GET["sel"];

				$tag = !empty($_POST["tag"])?$_POST["tag"]:$_GET["tag"];
				$name = !empty($_POST["name"])?$_POST["name"]:$_GET["sel"];
				$to = __DIR__."/../documents/".$tag."/".$name;

				if(rename($from, $to))
					 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				else echo "<script>alert('Fejl ved flytning af fil')</script>"; 
				       
			}

			break;

		case "remove":
			ignoreRedirect();

			$directory = dir(__DIR__."/../documents/");
			while(false !== ($folder = $directory->read()))
				if($folder != "." && $folder != ".." && !preg_match('/\./', $folder)) {
					$subdirectory = dir(__DIR__."/../documents/".$folder."/");
					while(false !== ($file = $subdirectory->read()))
						if($file != "." && $file != "..")
							$current_files[$folder][] = $file;
				}

			$action = $url;
			$inputs = [
				["info", "Vælg det dokument du vil fjerne"],
				"sel" => ["fileexplorer", $current_files, "leder&document=remove", 1],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Fjern (kan ikke fortrydes)", "", 0]
			];

			if($_POST["submit"]) {
				if(unlink(__DIR__."/../documents/".$_GET["tag"]."/".$_GET["sel"]))
					 echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				else echo "<script>alert('Fejl ved sletning af fil')</script>"; 
			}

			break;
	}
	
	include_once "overlay.php";