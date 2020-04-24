<?php
	haveAccessTo(__FILE__);
	if(isset($_GET["update"])) {
		haveAccessTo("functions/editSpace.php");
		$post = json_decode(file_get_contents('php://input'), true);
		foreach($post as $key => $v)
			if(!mysqli_query($conn,
				"UPDATE `spaces` SET `x`='".$v["x"]."', `y`='".$v["y"]."', `w`='".$v["w"]."', `h`='".$v["h"]."' WHERE `stoargeid` = '".$key."'")
			) echo false; exit;
		echo true;
		exit;
	}
?>
<div id="page" class="bg-gray">
	<div class="full onethird box bg-white" style="max-height: 665px; overflow-y: auto">
		<h1>Spaces</h1><br>
		<table id="cyklisk">
			<tr>
				<th>Extern</th>
				<th>Intern</th>
			</tr>
			<?php
				$spaces = mysqli_query($conn, "SELECT * FROM `spaces`");
				while($space = mysqli_fetch_assoc($spaces))
					echo '<tr><th'.(isset($_GET["id"]) && $space["stoargeid"]==$_GET["id"]?" class='white bg-dark bg-red'":"").'>'.
						 '<a href="?space&id='.$space["stoargeid"].'">'.$space["stoargeid"].'</a></th>'.
						 '<th>'.$space["spaceid"].'</th></tr>';
			?>
		</table>
	</div>
	<div class="full twothird box bg-white" style="overflow-x: scroll">
		<h1>Kort</h1> - Klik og træk på kasser for at flytte dem.<br>
		<svg id="map" width="1000px" height="600px" viewBox="1000px 600px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<?php
				$sp = mysqli_query($conn, "SELECT * FROM `spaces`");
				while($p = mysqli_fetch_assoc($sp))
					echo '<rect x="'.$p['x'].'" y="'.$p['y'].'" width="'.$p['w'].'" height="'.$p['h'].'" class="spaces" id="'.$p["stoargeid"].'" style="fill:'. (isset($_GET["id"]) && $p["stoargeid"]==$_GET["id"]?"#C81C26":"#FFD500").';cursor: se-resize" onmousedown="lock=\'resize\';document.selSpace = event.target.id"/>'.
						 '<text x="'.($p['x']+$p['w']/2).'" y="'.($p['y']+$p['h']/2).'" dominant-baseline="middle" text-anchor="middle" id="t-'.$p["stoargeid"].'" style="cursor: move" onmousedown="lock=\'move\';document.selSpace = event.target.id.split(\'t-\')[1]">'.$p["stoargeid"].'</text>';
			?>
		</svg>
		<script>
			var map = document.getElementById("map");
			map.onmousemove = function(event) {
				if(document.selSpace) {
					let bg = document.getElementById(document.selSpace);
					let tx = document.getElementById("t-"+document.selSpace);
					let [x,y,w,h] = [bg.x.baseVal.value, bg.y.baseVal.value, bg.width.baseVal.value, bg.height.baseVal.value]
					let [mouseX, mouseY] = [event.layerX, event.layerY-55];
					if(lock == "resize") {
						bg.setAttribute("width",  mouseX-x);
						bg.setAttribute("height", mouseY-y);
						tx.setAttribute("width", (mouseX-x)/2);
						tx.setAttribute("height",(mouseY-y)/2);
					} else if (lock == "move") {
						bg.setAttribute("x", mouseX-w/2);
						bg.setAttribute("y", mouseY-h/2);
						tx.setAttribute("x", mouseX);
						tx.setAttribute("y", mouseY);   
					}
				}
			}
			map.onmouseup = function() {
				if(document.selSpace) {
					document.selSpace = undefined;
					lock = undefined;
					let spaces = document.getElementsByClassName("spaces");
					let newpos = {};
					for(space of spaces)
						newpos[space.id] = {
							"x": space.x.baseVal.value,
							"y": space.y.baseVal.value,
							"w": space.width.baseVal.value<20?20:space.width.baseVal.value,
							"h": space.height.baseVal.value<10?20:space.height.baseVal.value
						};
					var xhr = new XMLHttpRequest();
					xhr.open("POST", "?space&update", true);
					xhr.setRequestHeader('Content-Type', 'application/json');
					xhr.setRequestHeader('enctype', 'multipart/form-data');
					xhr.send(JSON.stringify(newpos));
					xhr.onreadystatechange = function() {
						if (xhr.readyState === 4) location.reload()
					}
				}
			}
		</script>
	</div>
</div>
