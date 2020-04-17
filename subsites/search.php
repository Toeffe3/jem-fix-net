<?php
	haveAccessTo(__FILE__);
?>
<form method="GET" action="" style="padding: 20px 40px 0px 40px;" >
	<input type="hidden" name="search">
	<input class="search bar" type="text" name="q" placeholder="S�g efter dokumenter" style="font-family: 'Bahnschrift';">
	<input class="search icon red button" type="submit">
</form>
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
		<br>
		<h2>Br�dtekst</h2>
		<table>
			<tr><td>Dene funktion er ikke tilg�ngelige endnu...</td></tr>
		</table>
	</div>
</div>