<?php
    //TODT: Lav $cykliskpost
    //TODT: Lav $leaderpost
    //TODT: Lav $posts
?>
<div id="page" class="bg-gray">
    <div class="small box bg-white">
        Aktuelt fra indkøb
        <div class="posts">
            <?php foreach ($cykliskpost => $post) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["id"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="small box bg-white">
        Øvrige nyheder
        <div class="posts">
            <?php foreach ($posts => $post) {
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
            <?php foreach ($leaderpost => $post) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["id"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="panel bg-yellow">
        Hurtig adgang
    </div>
</div>
