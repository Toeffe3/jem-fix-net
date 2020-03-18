<?php
	switch ($_GET["users"]) {
    	case 'new':
            //Create user
            break;

    	case 'edit':
            //Change password / other user settings
            //$_GET["id"]
            break;

    	case 'delete':
            //Delete user
            //$_GET["id"]
            break;
	
	    default:
            //View user
            //$_GET["id"]
            break;
    }
?>