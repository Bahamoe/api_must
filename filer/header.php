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
			<button class="meny-button"><a href="tavla.php">TÄVLA</a></button>
			<button class="meny-button"><a href="alla-bidrag.php">ALLA BIDRAG</a></button>
			<button class="meny-button"><a href="topplista.php">TOPPLISTA</a></button>
			<button class="meny-button"><a href="vinnare.php">VINNARE</a></button>
			<button class="meny-button"><a href="regler.php">REGLER & PRISER</a></button>
		</div>
		<div id="content-wrapper">