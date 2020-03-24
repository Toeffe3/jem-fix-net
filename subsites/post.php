<?php
	include __DIR__."/../assets/lib/Markdown/Michelf/MarkdownExtra.inc.php";
	use Michelf\Markdown;
	$post = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `post` = ".$_GET["id"]." LIMIT 1"));
	$textcontent = Markdown::defaultTransform($post["text"]);
?>
<div id="page" class="bg-gray">
	<div class="full box bg-white">
		<a href="<?php echo $prevpage; ?>"><- Tilbage</a><br>
		<h1 style="display: inline"><?php echo $post["title"];?></h1>
		<h3 style="display: inline">af <a href=?user&id=<?php echo $post["userid"];?>><?php echo $post["fullname"];?></a></h3>
		<h2><?php echo $post["date"];?></h2>
		<div class="postcontent"><?php echo $textcontent?></div>
	</div>
</div>