<?php
    switch ($_GET["folder"]) {
    	case 'new':
            $action = $url;
            $inputs = [
                "tagname" => ["text","Navn p� tag", 1],
                "redirect" => ["hidden",$prevpage, 0],
                "submit" => ["submit", "Opret", 0]
		    ];
            if($_POST["submit"]) {
                mkdir(__DIR__."/../documents/".$_POST["tagname"]);
                //TODO: Sucess/fail feedback
                echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
			}
            break;

    	case 'edit':
            $current_tags = array();
            $directory = dir(__DIR__."/../documents/");
            while(false !== ($folder = $directory->read()))
                if($folder != "." && $folder != ".." && !preg_match('/\./', $folder))
                    $current_tags[$folder] = $folder;
            
            $action = $url;
            $inputs = [
                "seltag" => ["select", $current_tags, "V�lg tag: ", 1],
                "redirect" => ["hidden",$prevpage, "", 0]
            ];

            if(isset($_GET["remove"])) {
                $inputs["confirm"] = ["text", "", "Skriv navnet for at bekr�fte", 1];
                $inputs["delete"] = ["submit", "Fjern (Slet alle dokumenter med dette tag)", "", 0];
            } else {
                $inputs["newname"] = ["text", "", "Nyt navn", 0];
                $inputs["access"] = ["select", [0=>"Alle",1=>"Brt. Ansatte",2=>"Leder",3=>"Butikschef"], "Adgang", 0];
                $inputs["submit"] = ["submit", "�ndre", "", 0];
            }

            //TODO: Sucess/fail feedback
            if($_POST["submit"]) {
                if(!empty($_GET["newname"])) rename(__DIR__."/../documents/".$_POST["seltag"], __DIR__."/../documents/".$_POST["newname"]);
                if(!empty($_GET["access"])) echo "SQL skal inds�ttes her! ".$_GET["access"];
                echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
			} else if($_POST["delete"]) {
                if($_POST["seltag"] == $_POST["confirm"])
                    rmdir(__DIR__."/../documents/".$_POST["seltag"]);
                echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
			}
            break;
    }
    
    include_once "overlay.php";