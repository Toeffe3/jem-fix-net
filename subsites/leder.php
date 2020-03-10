<h1>Leder</h1>
<?php
    $leaderpost = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 1"));
?>
<div id="page" class="bg-gray">
    <div class="small box bg-white">
        Nyt fra ledelsen
        <div class="posts">
            <?php foreach ($leaderpost => $post) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["id"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="panel bg-yellow">
        Hurtig adgang
        <div class="functions">
          <a href="#">Opret ny bruger</a>
          <a href="#">Opret ny post</a>
          <a href="#">Rediger post</a>
          <a href="#">Upload dokument</a>
          <a href="#">Rediger tags(Mapper)</a>
        </div>
    </div>
</div>
