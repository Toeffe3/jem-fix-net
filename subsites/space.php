<?php
    $spaces = mysqli_query($conn, "SELECT * FROM `spaces`");
?>
<div id="page" class="bg-gray">
    <div class="full box bg-white">
        <h1>Spaces</h1><br>
        <table id="cyklisk">
            <tr>
                <th>Lager id</th>
                <th>Space id</th>
                <th>Række</th>
                <th>Hylde</th>
                <th>Celle</th>
                <th>Antal</th>
                <th>Del af en cyklisk</th>
            </tr>

            <?php
                while($space = mysqli_fetch_assoc($spaces)) {
                    echo '<tr><th>'.$space["stoargeid"].'</th><th>'.$space["spaceid"].'</th><th>'.$space["row"].'</th><th>'.$space["shelf"].'</th><th>'.$space["cell"].'</th><th>'.$space["count"].'</th><th>'.$space["incyklisk"].'</th></tr>';
                }
            ?>

        </table>
    </div>
</div>
