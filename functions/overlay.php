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
								$enablerichscript = true;
								echo'<tr><td>'.$value[2].': </td></tr>'.
										'<tr><td colspan="2"><div style="display: grid; grid-template-columns: repeat(10, 1fr);">'.
											'<img src="assets/icons/yellow/bold.png" height="50px" onclick="bold()" />'.
											'<img src="assets/icons/yellow/italic.png" height="50px" onclick="italic()" />'.
											'<img src="assets/icons/yellow/highlight.png" height="50px" onclick="highlight()" />'.
											'<img src="assets/icons/yellow/link.png" height="50px" onclick="link()" />'.
											'<img src="assets/icons/yellow/ol.png" height="50px" onclick="ol()" />'.
											'<img src="assets/icons/yellow/ul.png" height="50px" onclick="ul()" />'.
											'<img src="assets/icons/yellow/line.png" height="50px" onclick="line()" />'.
											'<img src="assets/icons/yellow/h1.png" height="50px" onclick="h1()" />'.
											'<img src="assets/icons/yellow/h2.png" height="50px" onclick="h2()" />'.
											'<img src="assets/icons/yellow/h3.png" height="50px" onclick="h3()" />'.
										'</div></td></tr>'.
										'<tr><td colspan="2"><textarea class="rich" name="'.$key.'"></textarea></td></tr>';
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
<?php if(isset($enablerichscript)) { ?>
	<script type="text/javascript">
		var rte = document.getElementsByClassName('rich')[0];
		rte.onblur = function() {
			dir = rte.selectionStart<rte.selectionEnd,
			sel = [dir?rte.selectionStart:rte.selectionEnd, !dir?rte.selectionStart:rte.selectionEnd],
			txt = [rte.value.slice(0,sel[0]),rte.value.slice(sel[0],sel[1]),rte.value.slice(sel[1])];
		}

		function bold() {
			insertInbetween("\\*\\*");
		}

		function italic() {
			insertInbetween("\\_");
		}

		function highlight() {
			insertInbetween("``");
		}

		function line() {
			insertAtStart("---", "\n---\n");
		}

		function insertInbetween(regexp, chars = regexp.replace(/\\/g,""), offset = 0) {
			let r=[new RegExp(regexp+"( *?)$"),new RegExp(regexp+"(.*?)"+regexp),new RegExp("^( *?)"+regexp)];
			if(txt[0].match(r[0])&&txt[2].match(r[2])){rte.value=txt[0].replace(r[0],"$1")+txt[1]+txt[2].replace(r[2],"$1");offset=[-chars.length,-chars.length]}
			else if(txt[1].match(r[1])){rte.value=txt[0]+txt[1].replace(r[1],"$1")+txt[2];offset=[0,-chars.length-1];}
			else{rte.value=txt[0]+chars+txt[1]+chars+txt[2];offset=[chars.length,chars.length];}
			rte.focus();
			rte.selectionStart=sel[0]+offset[0];
			rte.selectionEnd=sel[1]+offset[1];
		}

		function insertAtStart(regexp, chars = regexp.replace(/\\/g,"")) {
			let offset=-(chars.length), r=[new RegExp(regexp+"( *?)$"),new RegExp(regexp+"(.*?)"+regexp),new RegExp("^( *?)"+regexp)];
					 if(txt[0].match(r[0]))rte.value=txt[0].replace(r[0],"$1")+txt[1]+txt[2];
			else if(txt[1].match(r[1]))rte.value=txt[0]+txt[1].replace(r[1],"$1")+txt[2];
			else if(txt[2].match(r[2]))rte.value=txt[0]+txt[1]+txt[2].replace(r[2],"$1");
			else{rte.value=txt[0]+chars+txt[1]+txt[2];offset=chars.length;}
			rte.focus();
			rte.selectionStart=sel[0]+offset;
			rte.selectionEnd=sel[1]+offset;
		}
	</script>
<?php } ?>
