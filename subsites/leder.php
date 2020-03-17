<?php
    //TODO: Add permission check
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
          <li><a href="?leder&users=new">Opret ny bruger</a></li>
          <li><a href="?leder&users=edit">Rediger bruger</a></li>
          <li><a href="?leder&users=edit&promt=remove">Fjern bruger</a></li>
          <li><br></li>
          <li><a href="?leder&post=new">Opret ny post</a></li>
          <li><a href="?leder&post=edit">Rediger post</a></li>
          <li><a href="?leder&post=edit&promt=remove">Fjern post</a></li>
          <li><br></li>
          <li><a href="?leder&document=new">Upload dokument</a></li>
          <li><a href="?leder&document=edit">Rediger dokument</a></li>
          <li><a href="?leder&document=edit&promt=remove">Fjern dokument</a></li>
          <li><br></li>
          <li><a href="?leder&folder=new">Opret nyt tag</a></li>
          <li><a href="?leder&folder=edit">Rediger tag</a></li>
          <li><a href="?leder&folder=edit&promt=remove">Fjern tag</a></li>
        </div>
    </div>
</div>
