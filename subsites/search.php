<?php
	haveAccessTo(__FILE__);
?>
<div id="page" class="bg-gray">
	<div class="full box bg-white">
		<h1>Resultater</h1><br>
		<h2>Overskrifter</h2>
		<table>
			<?php
				if(!empty($_GET["q"]))
					$documents = mysqli_query($conn, "SELECT * FROM `documents` WHERE `displayname` LIKE '%".$_GET["q"]."%'");
				else
					$documents = mysqli_query($conn, "SELECT * FROM `documents`");
	
				while($document = mysqli_fetch_assoc($documents)) {
					preg_match("/(^.*?)(".$_GET["q"].")(.*$)/i", $document["displayname"], $matches);
					echo "<tr><td><a href='documents/".$document["path"]."'>".$matches[1]."<span class='bg-yellow'>".$matches[2]."</span>".$matches[3]."</a></td></tr>";
				}
			?>
		</table>
		<h2>Brødtekst</h2>
	</div>
</div>