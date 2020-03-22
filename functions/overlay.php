<?php ?>

<div id="overlay">
	<form method="post" action="<?php echo $action; ?>">
		<p>Dette er en fyldtekst</p>
		<?php
			foreach($inputs as $key => $value) {
				$key = preg_replace("/\@\d*/","",$key);
				if($value[0]=="select") {
					echo '<select name="'.$key.'">';
					foreach($value[1] as $okey => $option) {
						echo '<option value="'.$okey.'">'.$option.'</option>';
					}
					echo '</select><br>';
				} else {
					echo '<input type="'.$value[0].'" name="'.$key.'" value="'.$value[1].'" '.($value[2]==1?"required":"").'" /><br>';
				}

			}
		?>
	</form>
</div>