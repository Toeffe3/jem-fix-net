<?php ?>

<div id="overlay" onclick="window.location.href='<?php echo $prevpage;?>'">
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" onclick="event.stopPropagation()">
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
							foreach($value[1] as $okey => $option) echo '<option value="'.$okey.'">'.$option.'</option>';
							echo '</select>'.($value[3]==1?"*":"").'<td></tr>';
							break;

						case "textarea":
							echo '<tr><td>'.$value[2].': </td></tr><tr><td colspan="2"><textarea name="'.$key.'">'.$value[1].'</textarea></td></tr>';
							break;

						case "richtext":
							$enablerichscript = true;
							echo'<tr><td>'.$value[2].': </td></tr><tr><td colspan="2"><div style="display: grid; grid-template-columns: repeat(10, 1fr);">'.
								'<img src="assets/icons/yellow/bold.png" height="50px" onclick="bold()" />'.
								'<img src="assets/icons/yellow/italic.png" height="50px" onclick="italic()" />'.
								'<img src="assets/icons/yellow/highlight.png" height="50px" onclick="highlight()" />'.
								'<img src="assets/icons/yellow/link.png" height="50px" onclick="link()" />'.
								'<img src="assets/icons/yellow/ol.png" height="50px" onclick="ol()" />'.
								'<img src="assets/icons/yellow/ul.png" height="50px" onclick="ul()" />'.
								'<img src="assets/icons/yellow/line.png" height="50px" onclick="line()" />'.
								'<img src="assets/icons/yellow/h1.png" height="50px" onclick="h1()" />'.
								'<img src="assets/icons/yellow/h2.png" height="50px" onclick="h3()" />'.
								'<img src="assets/icons/yellow/h3.png" height="50px" onclick="h6()" />'.
							'</div></td></tr><tr><td colspan="2"><textarea class="rich" name="'.$key.'">'.$value[1].'</textarea></td></tr>';
							break;

						case "fileexplorer":
							$lastfolder = "";
							echo "<tr style='height:350px;display:block;overflow-y:scroll;'><td>";
							foreach($value[1] as $folder => $files) {
								echo '<b>'.$folder.'</b>:<ul>';
									foreach($files as $file)
										echo '<li style="list-style: none;"><a href="#'.$file.'">'.$file.'</a></li>';
								echo '</ul>';	
							}
							echo "</td></tr>";
							break;

						default:
							echo "<tr>".($value[2]==""?"":"<td>".$value[2].": </td>").'<td'.($value[2]==""?" colspan=2":"").'><input type="'.$value[0].'" name="'.$key.'" value="'.$value[1].'" placeholder="'.$value[2].'" '.($value[3]==1?"required":"").'" '.(!empty($value[4])?"max=".$value[4]." ":"".!empty($value[5])?"min=".$value[5]:"").'/>'.($value[3]==1?"*":"").'</td></tr>';
							break;
					}

				}
			?>
		</table>
	</form>
</div>
<?php if(isset($enablerichscript)) { ?>
	<script type="text/javascript">

		function bold()		{insertAround("\\*\\*");}
		function italic()	{insertAround("\\_");}
		function highlight(){insertAround("``");}
		function link()		{insertAround("\\[insertalink\\]\\(", "\\)",[1,12-sel[1]]);}
		function line()		{insertAround("", "\n?\n?---\n?");}
		function h1()		{insertAround("# ", "\n?");}
		function h3()		{insertAround("### ", "\n?", [4,4]);}
		function h6()		{insertAround("###### ", "\n?", [7,7]);}
		function ul()		{insertAround("\n?  * ", "\n?", [5,5]);}
		function ol()		{insertAround("\n?  x. ", "\n?", [6,6]);}

		var rte = document.getElementsByClassName('rich')[0];
		rte.onblur = function() {
			dir = rte.selectionStart<rte.selectionEnd,
			sel = [dir?rte.selectionStart:rte.selectionEnd, !dir?rte.selectionStart:rte.selectionEnd],
			txt = [rte.value.slice(0,sel[0]),rte.value.slice(sel[0],sel[1]),rte.value.slice(sel[1])];
		}

		function insertAround(regexpbefore, regexpafter=regexpbefore, offset = undefined, chars = [regexpbefore.replace(/\\/g,"").replace(/\?/g,""),regexpafter.replace(/\\/g,"").replace(/\?/g,"")]) {
			console.log(regexpafter," --- ", regexpafter.replace(/\?/,""));
			let r=[new RegExp(regexpbefore+"( *?)$"),new RegExp(regexpbefore+"(.*?)"+regexpafter),new RegExp("^( *?)"+regexpafter)];
			if(txt[0].match(r[0])&&txt[2].match(r[2])){rte.value=txt[0].replace(r[0],"$1")+txt[1]+txt[2].replace(r[2],"$1");offset?"":offset=[-chars[0].length,-chars[1].length]}
			else if(txt[1].match(r[1])){rte.value=txt[0]+txt[1].replace(r[1],"$1")+txt[2];offset?"":offset=[0,-chars[1].length-1];}
			else{rte.value=txt[0]+chars[0]+txt[1]+chars[1]+txt[2];offset?"":offset=[chars[0].length,chars[1].length];}
			rte.focus();
			rte.selectionStart=sel[0]+offset[0];
			rte.selectionEnd=sel[1]+offset[1];
		}
	</script>
<?php } ?>
