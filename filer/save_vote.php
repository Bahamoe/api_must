<?php
session_start();
include("connect.php");

$results = $conn->query("INSERT INTO voters (user_id, img_id) VALUES '{$_SESSION['user_id']}',");

?>