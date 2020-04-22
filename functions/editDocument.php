<?php
	haveAccessTo(__FILE__);
	function getExtension($mime_type) {
		$extensions = array(
			'video/3gpp2'                                                               => '3g2',
            'video/3gp'                                                                 => '3gp',
            'video/3gpp'                                                                => '3gp',
            'application/x-compressed'                                                  => '7zip',
            'audio/x-acc'                                                               => 'aac',
            'audio/ac3'                                                                 => 'ac3',
            'audio/x-aiff'                                                              => 'aif',
            'audio/aiff'                                                                => 'aif',
            'audio/x-au'                                                                => 'au',
            'video/x-msvideo'                                                           => 'avi',
            'video/msvideo'                                                             => 'avi',
            'video/avi'                                                                 => 'avi',
            'application/x-troff-msvideo'                                               => 'avi',
            'application/macbinary'                                                     => 'bin',
            'application/mac-binary'                                                    => 'bin',
            'application/x-binary'                                                      => 'bin',
            'application/x-macbinary'                                                   => 'bin',
            'image/bmp'                                                                 => 'bmp',
            'image/x-bmp'                                                               => 'bmp',
            'image/x-bitmap'                                                            => 'bmp',
            'image/x-xbitmap'                                                           => 'bmp',
            'image/x-win-bitmap'                                                        => 'bmp',
            'image/x-windows-bmp'                                                       => 'bmp',
            'image/ms-bmp'                                                              => 'bmp',
            'image/x-ms-bmp'                                                            => 'bmp',
            'application/bmp'                                                           => 'bmp',
            'application/x-bmp'                                                         => 'bmp',
            'application/x-win-bitmap'                                                  => 'bmp',
            'text/x-comma-separated-values'                                             => 'csv',
            'text/comma-separated-values'                                               => 'csv',
            'application/vnd.msexcel'                                                   => 'csv',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx',
            'application/x-msdownload'                                                  => 'exe',
            'image/gif'                                                                 => 'gif',
            'application/x-gtar'                                                        => 'gtar',
            'application/x-gzip'                                                        => 'gzip',
            'text/html'                                                                 => 'html',
            'text/calendar'                                                             => 'ics',
            'image/jpeg'                                                                => 'jpeg',
            'image/pjpeg'                                                               => 'jpeg',
            'application/json'                                                          => 'json',
            'text/json'                                                                 => 'json',
            'text/x-log'                                                                => 'log',
            'audio/x-m4a'                                                               => 'm4a',
            'audio/mp4'                                                                 => 'm4a',
            'application/vnd.mpegurl'                                                   => 'm4u',
            'audio/midi'                                                                => 'mid',
            'video/quicktime'                                                           => 'mov',
            'video/x-sgi-movie'                                                         => 'movie',
            'audio/mpeg'                                                                => 'mp3',
            'audio/mpg'                                                                 => 'mp3',
            'audio/mpeg3'                                                               => 'mp3',
            'audio/mp3'                                                                 => 'mp3',
            'video/mp4'                                                                 => 'mp4',
            'video/mpeg'                                                                => 'mpeg',
            'application/oda'                                                           => 'oda',
            'audio/ogg'                                                                 => 'ogg',
            'video/ogg'                                                                 => 'ogg',
            'application/ogg'                                                           => 'ogg',
            'application/pdf'                                                           => 'pdf',
            'application/octet-stream'                                                  => 'pdf',
            'application/pgp'                                                           => 'pgp',
            'application/x-httpd-php'                                                   => 'php',
            'application/php'                                                           => 'php',
            'application/x-php'                                                         => 'php',
            'text/php'                                                                  => 'php',
            'text/x-php'                                                                => 'php',
            'application/x-httpd-php-source'                                            => 'php',
            'image/png'                                                                 => 'png',
            'image/x-png'                                                               => 'png',
            'application/powerpoint'                                                    => 'ppt',
            'application/vnd.ms-powerpoint'                                             => 'ppt',
            'application/vnd.ms-office'                                                 => 'ppt',
            'application/msword'                                                        => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'application/x-photoshop'                                                   => 'psd',
            'image/vnd.adobe.photoshop'                                                 => 'psd',
            'application/x-rar'                                                         => 'rar',
            'application/rar'                                                           => 'rar',
            'application/x-rar-compressed'                                              => 'rar',
            'text/rtf'                                                                  => 'rtf',
            'text/richtext'                                                             => 'rtx',
            'image/svg+xml'                                                             => 'svg',
            'application/x-shockwave-flash'                                             => 'swf',
            'application/x-tar'                                                         => 'tar',
            'application/x-gzip-compressed'                                             => 'tgz',
            'image/tiff'                                                                => 'tiff',
            'text/plain'                                                                => 'txt',
            'audio/x-wav'                                                               => 'wav',
            'audio/wave'                                                                => 'wav',
            'audio/wav'                                                                 => 'wav',
            'video/x-ms-wmv'                                                            => 'wmv',
            'video/x-ms-asf'                                                            => 'wmv',
            'application/xhtml+xml'                                                     => 'xhtml',
            'application/excel'                                                         => 'xl',
            'application/msexcel'                                                       => 'xls',
            'application/x-msexcel'                                                     => 'xls',
            'application/x-ms-excel'                                                    => 'xls',
            'application/x-excel'                                                       => 'xls',
            'application/x-dos_ms_excel'                                                => 'xls',
            'application/xls'                                                           => 'xls',
            'application/x-xls'                                                         => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx',
            'application/vnd.ms-excel'                                                  => 'xlsx',
            'application/xml'                                                           => 'xml',
            'text/xml'                                                                  => 'xml',
            'text/xsl'                                                                  => 'xsl',
            'application/x-compress'                                                    => 'z',
            'application/x-zip'                                                         => 'zip',
            'application/zip'                                                           => 'zip',
            'application/x-zip-compressed'                                              => 'zip',
            'application/s-compressed'                                                  => 'zip',
            'multipart/x-zip'                                                           => 'zip'
        );
		return $extensions[$mime_type];
	}

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
				$name = !empty($_POST["docname"])? $_POST["docname"] : $_FILES['doc']['tmp_name'];
				if(mysqli_query($conn, "INSERT INTO `documents` (`mime`, `path`, `displayname`) VALUES ('".($_FILES['doc']['type'])."','".$_POST["tag"]."/".$name.".".getExtension($_FILES['doc']['type'])."','".$name."')"))
				    if(move_uploaded_file($_FILES['doc']['tmp_name'], __DIR__."/../documents/".$_POST["tag"]."/".$name.".".getExtension($_FILES['doc']['type'])))
						echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				    else echo "<script>alert('Fejl ved upload af fil')</script>";        
				else echo "<script>alert('Fejl i databasen ved upload af fil')</script>";
			}

			break;

		case 'edit':
			ignoreRedirect();

            $current_tags = array(NULL => "-- uændret --");
			$directory = dir(__DIR__."/../documents/");
			while(false !== ($folder = $directory->read()))
				if($folder != "." && $folder != ".." && !preg_match('/\./', $folder)) {
					$current_tags[$folder] = $folder;
					$subdirectory = dir(__DIR__."/../documents/".$folder."/");
					while(false !== ($file = $subdirectory->read()))
						if($file != "." && $file != "..")
							$current_files[$folder][] = $file;
				}

			$action = $url;
			$inputs = [
				["info", "Vælg det dokument du vil ændre"],
				"sel" => ["fileexplorer", $current_files, "leder&document=edit", 1],
				"name" => ["text", "", "Ændre navn + .", 0],
				"tag" => ["select", $current_tags, "Ændre tag", 0],
				"redirect" => ["hidden", $prevpage, "", 0],
				"submit" => ["submit", "Ændre", "", 0]
			];

			if($_POST["submit"]) {

				$from = __DIR__."/../documents/".$_GET["sel"];
                echo $_GET["sel"]."<br>";

				$tag = !empty($_POST["tag"])?$_POST["tag"]:explode("/", $_GET["sel"])[0];
				$name = !empty($_POST["name"])?$_POST["name"]:explode("/", $_GET["sel"])[1];
                $dname = explode(".", $name)[0];
				$to = __DIR__."/../documents/".$tag."/".$name;

                echo $tag."/".$name."<br>";
                echo $name;

				if(mysqli_query($conn, "UPDATE `documents` SET `path` = '".$tag."/".$name."', `displayname` = '".$dname."' WHERE `path` = '".$_GET["sel"]."'"))
				    if(rename($from, $to))
						echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				    else echo "<script>alert('Fejl ved flytning af fil')</script>"; 
				else echo "<script>alert('Fejl i databasen ved flytning af fil')</script>";
				       
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

			if($_POST["submit"])
				if(mysqli_query($conn, "DELETE FROM `documents` WHERE `path` = '".$from."'"))
				    if(unlink(__DIR__."/../documents/".$_GET["tag"]."/".$_GET["sel"]))
						echo "<script>window.location.href='".$_POST["redirect"]."'</script>";
				    else echo "<script>alert('Fejl ved sletning af fil')</script>"; 
				else echo "<script>alert('Fejl i databasen ved flytning af fil')</script>";

			break;
	}
	
	include_once "overlay.php";
