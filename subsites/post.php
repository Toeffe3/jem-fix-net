<?php
	$post = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `post` = ".$_GET["id"]));
?>
<div id="page" class="bg-gray">
    <div class="box bg-white">
        <a href="?nyheder"><- back</a>
        <h3>
            <?php echo $post["title"];?> af <a href=user?id=<?php echo $post["userid"];?>>
                <?php echo $post["fullname"];?>
            </a>
        </h3>
        <h5><?php echo $post["date"];?></h5>
        <p><?php echo $post["text"];?></p>
    </div>
</div>