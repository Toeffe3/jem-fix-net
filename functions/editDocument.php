<?php
    switch ($_GET["document"]) {
    	case 'new':
            $current_tags = array();
            $directory = dir(__DIR__."/../documents/");
            while(false !== ($folder = $directory->read()))
                if($folder != "." && $folder != ".." && !preg_match('/\./', $folder))
                    $current_tags[$folder] = $folder;

            $action = $url;
            $inputs = [
                "doc" => ["file","","", 1],
                "tag" => ["select", $current_tags,"Tag: ", 1],
                "docname" => ["text","", "Angiv visningsnavn", 0],
                "redirect" => ["hidden", $prevpage, "", 0],
                "submit" => ["submit", "Opret", "", 0]
		    ];

            if($_POST["submit"]) {
                $name = !empty($_GET["docname"])? $_GET["docname"] : $_FILES['doc']['name'];
                if(move_uploaded_file($_FILES['doc']['tmp_name'], __DIR__."/../documents/".$_POST["tag"]."/".$name)) {
                    //TODO: Create DB-entry ($_FILES['doc']['type'])
                    echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
                } else {
                    echo "<script>alert('Fejl ved upload af fil')</script>";        
				}
			}
            break;

    	case 'edit':
            
            break;
    }
    
    include_once "overlay.php";