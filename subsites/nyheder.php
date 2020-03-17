<?php
    $posts = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 0");
    $leaderpost = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 1");
    $cykliskpost = mysqli_query($conn, "SELECT * FROM `posts` INNER JOIN `employees` ON `userid` = `id` WHERE `from` = 2");
    
    $pins = mysqli_query($conn, "SELECT * FROM `pinned` WHERE `userid` = ".$_SESSION["user"]);
?>
<div id="page" class="bg-gray">
    <div class="small box bg-white">
        Aktuelt fra indkøb
        <div class="posts">
            <?php while($post = mysqli_fetch_assoc($cykliskpost)) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["post"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="small box bg-white">
        Øvrige nyheder
        <div class="posts">
            <?php while($post = mysqli_fetch_assoc($posts)) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["post"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="tall box bg-yellow">
        Min butik
    </div>
    <div class="large box bg-white">
        Nyt fra ledelsen
        <div class="posts">
            <?php while($post = mysqli_fetch_assoc($leaderpost)) {
                echo '<div class="post">['.$post["initials"].']: <a href=?nyheder&id='.$post["post"].'>'.$post["title"].'</a></div>';
            } ?>
        </div>
    </div>
    <div class="tall box bg-yellow">
        Hurtig adgang <a onclick="addpin()">Tilføj</a>
        <?php
            while($pin = mysqli_fetch_assoc($pins)) {
                echo '<br><span><a href="?'.$pin["link"].'">'.$pin["customlabel"].'</a> <a href="?pin=delete&id='.$pin["reference"].'">&ltfjern&gt</a></span>';
			}
        ?>
    </div>
</div>
<script>
    function addpin() {
        var link = prompt("Indsæt link:", "posts=new");
        if(link == null && link == "") return false;
        var navn = prompt("Kaldenavn for '"+link+"':", "Opret post");
        if(navn == null && navn == "") return false
        window.location.href="?pin=new&link="+link+"&name="+navn;
    }
</script>
