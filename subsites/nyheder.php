<?php
	$posts = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 0");
	$leaderpost = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 1");
	$cykliskpost = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 2");

	$pins = mysqli_query($conn, "SELECT * FROM `pinned` WHERE `userid` = ".$_SESSION["user"]);
?>
<div id="page" class="bg-gray">
	<div class="small box bg-white">
		<h4>Nyt fra ledelsen</h4>
		<div class="posts">
			<?php while($post = mysqli_fetch_assoc($leaderpost)) {
				echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["post"].'>'.$post["title"].'</a></div>';
			} ?>
		</div>
	</div>
	<div class="small box bg-white">
		<h4>Øvrige nyheder</h4>
		<div class="posts">
			<?php while($post = mysqli_fetch_assoc($posts)) {
				echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["post"].'>'.$post["title"].'</a></div>';
			} ?>
		</div>
	</div>
	<div class="tall box bg-yellow">
		<h4>Min butik</h4>
	</div>
	<div class="large box bg-white">
		<h4>Aktuelt fra indkøb</h4>
		<div class="posts">
			<?php while($post = mysqli_fetch_assoc($cykliskpost)) {
				echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["post"].'>'.$post["title"].'</a></div>';
			} ?>
		</div>
	</div>
	<div id="pins" class="small box bg-yellow">
		<h4 style="display:inline">Hurtig adgang</h4><a onclick="addpin()" href="?pin=new" class="add icon">&ltTilføj&gt</a>
		<?php
			while($pin = mysqli_fetch_assoc($pins)) {
				echo '<div class="options"><a href="'.$pin["link"].'">'.$pin["customlabel"].'</a><span><a href="?pin=delete&id='.$pin["reference"].'" style="display:none;" class="remove icon"> &ltfjern&gt</a></span></div>';
			}
		?>
	</div>
</div>
