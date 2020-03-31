<?php  ?>
<!DOCTYPE html>
<html lang="da" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Jem&Fix INTRANET</title>
		<link rel="stylesheet" type="text/css" href="assets/grid.css">
		<link rel="stylesheet" type="text/css" href="assets/style.css">
		<link rel="stylesheet" type="text/css" href="assets/richtext.css">
		<link rel="stylesheet" type="text/css" href="assets/print.css" media="print">
	</head>
	<body class="bg-gray">
		<div id="header" class="bg-red white">
			<img src="assets/logo.png" alt="Jem&Fix" class="logo">
			<span>INTRANET</span>
			<div id="contact">
				Service telefon: <a href="tel:5999">5999</a><br>
				Kundeservice: <a href="tel:+45 79425942">+45 79425942</a><br>
			</div>
		</div>
		<div id="tabs" class="bg-dark bg-red yellow">
			<center>
				<a href="?space"><div class="<?php echo (isset($_GET['space'])?'links active':'links') ?>">Space</div></a>
				<a href="?cyklisk"><div class="<?php echo (isset($_GET['cyklisk'])?'links active':'links') ?>">Cyklisk</div></a>
				<a href="?nyheder"><div class="<?php echo (isset($_GET['nyheder'])?'links active':'links') ?>">Nyheder</div></a>
				<a href="?leder"><div class="<?php echo (isset($_GET['leder'])?'links active':'links') ?>">Ledere</div></a>
				<a href="?hr"><div class="<?php echo (isset($_GET['hr'])?'links active':'links') ?>">HR</div></a>
				<a href="?search"><div class="links search icon search yellow"></div></a>
			</center>
		</div>
