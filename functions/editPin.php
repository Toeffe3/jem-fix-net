<?php
	//TODO: Add permission check

	switch ($_GET["pin"]) {
		case 'new':
			if(mysqli_query($conn, "INSERT INTO `pinned` (`userid`, `link`, `customlabel`) VALUES ('".$_SESSION["user"]."', '".$_GET["link"]."', '".$_GET["name"]."')"))
				echo "<script>window.location.href='".$prevpage."?sucess'</script>";
			else
				echo "<script>window.location.href='".$prevpage."?error'</script>";
			break;

		case 'edit':
			
			break;

		case 'delete':
			if(mysqli_query($conn, "DELETE FROM `pinned` WHERE `reference` = ".$_GET["id"]))
				echo "<script>window.location.href='".$prevpage."?sucess'</script>";
			else
				echo "<script>window.location.href='".$prevpage."?error'</script>";
			break;
	
		default:
		
			break;
	}