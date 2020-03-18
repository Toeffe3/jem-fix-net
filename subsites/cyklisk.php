<?php
    $cyklisker = mysqli_query($conn, "SELECT * FROM `cyklisks` ORDER BY `mustdate` ASC, `start` ASC");
?>
<div id="page" class="bg-gray">
    <div class="full box bg-white">
        <h1>Cyklisker</h1><br>
        <table id="cyklisk">
            <tr>
                <th>Fuldendt</th>
                <th>Space   /   Uge</th>
                <?php
                    for($i = (int)(date("W")); $i < 15+(date("W")); $i++)
                        echo '<th>'.$i.'</th>';
                ?>
            </tr>

            <?php
                while($cykliskider = mysqli_fetch_assoc($cyklisker)) {
                    $spaces = preg_split("/,/",$cykliskider["spaces"]);
                    $start = date_create($cykliskider["start"]);
                    $mustdate = date_create($cykliskider["mustdate"]);
                    
                    foreach($spaces as $space) {
                        echo '<tr><th>X</th><th><a href="?space&id='.$space.'">'.$space.'</a></th>';
                        for($j = (date("W")); $j < 15+(date("W")); $j++) {
                            if($j == (date_format($mustdate,'W')))
                                echo '<th>S</th>';
                            else if($j >= (date_format($start,'W')) && $j < (date_format($mustdate,'W')))
                                echo '<th>F</th>';
                            else
                                echo '<th> </th>';
						} echo '</tr>';
				    }
                }
            ?>

        </table>
        <div class="button bg-dark bg-gray white" style="float:right">Print</div>
    </div>
</div>
