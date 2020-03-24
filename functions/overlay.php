<?php ?>

<div id="overlay">
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<table>
			<?php
				foreach($inputs as $key => $value) {
					$key = preg_replace("/\@\d*/","",$key);

					switch($value[0]) {
						case "info":
							echo '<tr><td colspan="2">'.$value[1].'</td></tr>';
							break;

						case "select":
							echo "<tr><td>".$value[2].': </td><td><select name="'.$key.'">';
							foreach($value[1] as $okey => $option) {
								echo '<option value="'.$okey.'">'.$option.'</option>';
							}
							echo '</select>'.($value[3]==1?"*":"").'<td></tr>';
							break;

							case "textarea":
								echo '<tr><td>'.$value[2].': </td></tr><tr><td colspan="2"><textarea name="'.$key.'"></textarea></td></tr>';
								break;
							
							case "richtext":
								echo '<tr><td>'.$value[2].': </td></tr><tr><td colspan="2"><textarea class="rich" name="'.$key.'"></textarea></td></tr>';
								break;

						default:
							echo "<tr>".($value[2]==""?"":"<td>".$value[2].": </td>").'<td'.($value[2]==""?" colspan=2":"").'><input type="'.$value[0].'" name="'.$key.'" value="'.$value[1].'" placeholder="'.$value[2].'" '.($value[3]==1?"required":"").'" />'.($value[3]==1?"*":"").'</td></tr>';
							break;
					}

				}
			?>
		</table>
	</form>
</div>