<?php
	haveAccessTo(__FILE__);
	include __DIR__."/../assets/lib/Markdown/Michelf/MarkdownExtra.inc.php";
	use Michelf\Markdown;
	$sql = mysqli_query($conn, "SELECT * FROM `posts` WHERE `post` < 0 ORDER BY `post` DESC");
	while($post = mysqli_fetch_assoc($sql))
		$posts[] = $post;
?>
<div id="hr" class="bg-gray">
  <div class="taller box bg-white">
		<h1 style="display: inline">Formularer</h1><?php if($_SESION["perm"] >= 4 || $_SESSION["perm"] == -1) echo '<a href="?post=edit&id=-1" class="edit icon" style="position: relative;top: -5px;left: 10px;">&ltRet&gt</a>';?>
		<?php echo Markdown::defaultTransform($posts[0]["text"]); ?>
	</div>

  <div class="tall box bg-white">
		<h1 style="display: inline">Genveje</h1><?php if($_SESION["perm"] >= 4 || $_SESSION["perm"] == -1) echo '<a href="?post=edit&id=-2" class="edit icon" style="position: relative;top: -5px;left: 10px;">&ltRet&gt</a>';?>
		<?php echo Markdown::defaultTransform($posts[1]["text"]); ?>
	</div>

  <div class="small box bg-white">
		<h1 style="display: inline">Rettighedder og pligter</h1><?php if($_SESION["perm"] >= 4 || $_SESSION["perm"] == -1) echo '<a href="?post=edit&id=-3" class="edit icon" style="position: relative;top: -5px;left: 10px;">&ltRet&gt</a>';?>
		<?php echo Markdown::defaultTransform($posts[2]["text"]); ?>
	</div>

	<div class="small box bg-white">
		<h1 style="display: inline">MUS</h1><?php if($_SESION["perm"] >= 4 || $_SESSION["perm"] == -1) echo '<a href="?post=edit&id=-4" class="edit icon" style="position: relative;top: -5px;left: 10px;">&ltRet&gt</a>';?>
		<?php echo Markdown::defaultTransform($posts[3]["text"]); ?>
	</div>

	<div class="tall box bg-white">
		<h1 style="display: inline">Personalegoder</h1><?php if($_SESION["perm"] >= 4 || $_SESSION["perm"] == -1) echo '<a href="?post=edit&id=-5" class="edit icon" style="position: relative;top: -5px;left: 10px;">&ltRet&gt</a>';?>
		<?php echo Markdown::defaultTransform($posts[4]["text"]); ?>
	</div>

	<div class="small box bg-white">
		<h1 style="display: inline">Persondata forordning</h1><?php if($_SESION["perm"] >= 4 || $_SESSION["perm"] == -1) echo '<a href="?post=edit&id=-6" class="edit icon" style="position: relative;top: -5px;left: 10px;">&ltRet&gt</a>';?>
		<?php echo Markdown::defaultTransform($posts[5]["text"]); ?>
	</div>
</div>
