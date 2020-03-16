<?php
    $cyklisker = mysqli_query($conn, "SELECT * FROM `cyklisks` ORDER BY `mustdate` ASC, `start` ASC");
?>
<div id="page" class="bg-gray">
    <div class="full box bg-white">
        Cyklisker
        <table style="width:100%">
            <tr>
                <th>Fuldendt</th>
                <th>Uge</th>
                <?php
                    for($i = intval(date("W")); $i < (intval(date("W"))+15); $i++)
                        echo '<th>'.$i.'</th>';
                ?>
            </tr>

            <?php
                while($cykliskider = mysqli_fetch_assoc($cyklisker)) {
                    $spaces = preg_split("/,/",$cykliskider["spaces"]);
                    $start = DateTime::createFromFormat('Y-m-d', $cykliskider["start"]);
                    $mustdate = DateTime::createFromFormat('Y-m-d', $cykliskider["mustdate"]);
                    
                    foreach($spaces as $space) {
                        echo '<tr>';
                        echo '<th>X</th><th>'.$space.'</th>';
                        for($i = intval(date("W")); $i < (intval(date("W"))+15); $i++) {
                            if($i == intval($mustdate->format('W'))) echo '<th>S</th>';
                            else if($i == intval($start->format('W'))) echo '<th>F</th>';
                            else '<th></th>';
						}
                        echo '</tr>';
				    }
                }
            ?>

        </table>
    </div>
</div>
