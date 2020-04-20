<?php
	haveAccessTo(__FILE__);
	$leaderpost = mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 1");
?>
<div id="page" class="bg-gray">
	<div class="large box bg-white">
		<h4>Nyt fra ledelsen</h4>
		<div class="posts">
			<?php
				while($post = mysqli_fetch_assoc($leaderpost)) {
					echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["post"].'>'.$post["title"].'</a></div>';
				}
			?>
		</div>
	</div>
	<div class="taller box bg-yellow">
		<h4>Hurtig adgang</h4>
		<div id="functions">
		<li><a href="?leder&post=new">Opret ny opslag</a></li>
		  <li><a href="?leder&post=edit">Rediger eller fjern opslag</a></li>
		  <li><br></li>
		  <li><a href="?leder&document=new">Upload dokument</a></li>
		  <li><a href="?leder&document=edit">Rediger dokument</a></li>
		  <li><a href="?leder&document=remove">Fjern dokument</a></li>
		  <li><br></li>
		  <li><a href="?leder&folder=new">Opret nyt TAG</a></li>
		  <li><a href="?leder&folder=edit">Rediger TAG</a></li>
		  <li><a href="?leder&folder=edit&remove">Fjern TAG</a></li>
		  <li><br></li>
		  <li><a href="?leder&cyklisk=new">Ny cyklisk*</a></li>
		  <li><a href="?leder&cyklisk=edit">Rediger cyklisk*</a></li>
		  <li><a href="?leder&cyklisk=edit&remove">Fjern cyklisk*</a></li>
		  <li><br></li>
		  <li><a href="?leder&space=new">Nyt space*</a></li>
		  <li><a href="?leder&space=edit">Rediger space*</a></li>
		  <li><a href="?leder&space=edit&remove">Fjern space*</a></li>
		  <li><br></li>
		  <li><a href="?leder&users=new">Opret ny bruger</a></li>
		  <li><a href="?leder&users=edit">Rediger bruger</a></li>
		  <li><a href="?leder&users=delete">Fjern bruger</a></li>
		</div>
	</div>
</div>
