<?php
	haveAccessTo(__FILE__);

	$allposts = mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` > 3");
	$posts = array();

	while($post = mysqli_fetch_assoc($allposts))
		$posts[$post["from"]][] = [$post["initials"], $post["post"], $post["title"]];
?>
<div id="hr" class="bg-gray">
  <div class="taller box bg-white">
		<h1>Formularer</h1>
		<?php if(!empty($posts[4])) foreach($posts[4] as $post) {
			echo '<div class="post">['.$post[0].']: <a href=?nyheder&id='.$post[1].'>'.$post[2].'</a></div>';
		} ?>
	</div>

  <div class="tall box bg-white">
		<h1>Genveje</h1>
		<?php if(!empty($posts[5])) foreach($posts[5] as $post) {
			echo '<div class="post">['.$post[0].']: <a href=?nyheder&id='.$post[1].'>'.$post[2].'</a></div>';
		} ?>
	</div>

  <div class="small box bg-white">
		<h1>Rettighedder og pligter</h1>
		<?php if(!empty($posts[6])) foreach($posts[6] as $post) {
			echo '<div class="post">['.$post[0].']: <a href=?nyheder&id='.$post[1].'>'.$post[2].'</a></div>';
		} ?>
	</div>

	<div class="small box bg-white">
		<h1>MUS</h1>
		<?php if(!empty($posts[7])) foreach($posts[7] as $post) {
			echo '<div class="post">['.$post[0].']: <a href=?nyheder&id='.$post[1].'>'.$post[2].'</a></div>';
		} ?>
	</div>

	<div class="tall box bg-white">
		<h1>Personalegoder</h1>
		<?php if(!empty($posts[8])) foreach($posts[8] as $post) {
			echo '<div class="post">['.$post[0].']: <a href=?nyheder&id='.$post[1].'>'.$post[2].'</a></div>';
		} ?>
	</div>

	<div class="small box bg-white">
		<h1>Persondata forordning</h1>
		<?php if(!empty($posts[9])) foreach($posts[9] as $post) {
			echo '<div class="post">['.$post[0].']: <a href=?nyheder&id='.$post[1].'>'.$post[2].'</a></div>';
		} ?>
	</div>
</div>
