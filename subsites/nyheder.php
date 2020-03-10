<?php
    $leaderpost = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 1"));
    $post = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 0"));
    $cykliskpost = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 2"));
?>
<div id="page" class="bg-gray">
    <div class="small box bg-white">
        Aktuelt fra indkøb
        <div class="posts">
            <?php foreach ($cykliskpost as $post) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["id"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="small box bg-white">
        Øvrige nyheder
        <div class="posts">
            <?php foreach ($posts as $post) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["id"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="panel bg-yellow">
        Min butik
    </div>
    <div class="box bg-white">
        Nyt fra ledelsen
        <div class="posts">
            <?php foreach ($leaderpost as $post) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["id"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="panel bg-yellow">
        Hurtig adgang
    </div>
</div>
