<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>tavla</title>
	<meta charset="utf-8" />
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="../js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php include("connect.php"); ?>
	<div id="super-wrapper">
		<div id="meny-bar">
			<a href="tavla.php"><button class="meny-button">TÄVLA</button></a>
			<a href="alla-bidrag.php"><button class="meny-button">ALLA BIDRAG</button></a>
			<a href="topplista.php"><button class="meny-button">TOPPLISTA</button></a>
			<a href="vinnare.php"><button class="meny-button">VINNARE</button></a>
			<a href="regler.php"><button class="meny-button">REGLER & PRISER</button></a>
		</div>
		<div id="content-wrapper">