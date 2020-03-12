<?php
    $leaderpost = mysqli_query($conn,"SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 1");
?>
<div id="page" class="bg-gray">
    <div class="box bg-white">
        Nyt fra ledelsen
        <div class="posts">
            <?php
                while($post = mysqli_fetch_assoc($leaderpost)) {
                    echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["id"].'>'.$post["title"].'</a></div>';
                }
            ?>
        </div>
    </div>
    <div class="tall box bg-yellow">
        Hurtig adgang
        <div id="functions">
          <li><a href="#">Opret ny bruger</a></li>
          <li><a href="#">Opret ny post</a></li>
          <li><a href="#">Rediger post</a></li>
          <li><a href="#">Upload dokument</a></li>
          <li><a href="#">Rediger tags(Mapper)</a></li>
          <li><a href="#">Fjern bruger</a></li>
        </div>
    </div>
</div>
