<?php ?>

<div id="overlay">
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<p>Dette er en fyldtekst</p>
		<?php
			foreach($inputs as $key => $value) {
				$key = preg_replace("/\@\d*/","",$key);
				if($value[0]=="select") {
					echo $value[2].'<select name="'.$key.'">';
					foreach($value[1] as $okey => $option) {
						echo '<option value="'.$okey.'">'.$option.'</option>';
					}
					echo '</select>'.($value[3]==1?"*":"").'<br>';
				} else {
					echo '<input type="'.$value[0].'" name="'.$key.'" value="'.$value[1].'" placeholder="'.$value[2].'" '.($value[3]==1?"required":"").'" />'.($value[3]==1?"*":"").'<br>';
				}

			}
		?>
	</form>
</div>