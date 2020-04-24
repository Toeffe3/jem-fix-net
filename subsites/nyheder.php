<?php
	haveAccessTo(__FILE__);
	include __DIR__."/../assets/lib/Markdown/Michelf/MarkdownExtra.inc.php";
	use Michelf\Markdown;
	$posts = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 0");
	$cykliskpost = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 1");
	$leaderpost = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 2");
	$minbutik = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `posts` WHERE `post` = 0 LIMIT 1"));
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
		<h4 style="display:inline">Min butik</h4><?php if($_SESION["perm"] >= 4 || $_SESSION["perm"] == -1) echo '<a href="?post=edit&id=0" class="edit icon" style="position: relative;top: -5px;left: 10px;">&ltRet&gt</a>';?><br>
		<?php echo Markdown::defaultTransform($minbutik["text"]); ?>
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
