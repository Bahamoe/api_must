<?php
session_start();
include("connect.php");
$image_id = $_POST["id"];
$user_id = $_SESSION['user_id'];


$sql = ("SELECT id FROM voters WHERE user_id=$user_id");// kanske fnuttar
$query = mysqli_query($conn, $sql);


if(mysqli_num_rows($query) == 0){
	//insert values to the table voters
	$sql1 = ("INSERT INTO voters (user_id, img_id) VALUES ('$user_id', '$image_id')");
	$query1 = mysqli_query($conn, $sql1);

	$sql2 = ("UPDATE images SET votes = votes + 1 WHERE img_id = $image_id");//kanske fnuttar
	$query2 = mysqli_query($conn, $sql2);

}elseif(mysqli_num_rows($query) > 0){
	$sql3 = ("SELECT img_id FROM voters WHERE user_id = $user_id");// kanske fnuttar
	$query3 = mysqli_query($conn, $sql3);

	$imgID = mysqli_fetch_assoc($query3);

	$sql4 = ("UPDATE images SET votes = votes - 1 WHERE img_id = '". $imgID['img_id'] ."'");
	$query4 = mysqli_query($conn, $sql4);


	$sql5 = ("INSERT INTO voters (img_id) VALUES ('$image_id')");
	$query5 = mysqli_query($conn, $sql5);


	$sql6 = ("UPDATE images SET votes = votes + 1 WHERE img_id = $image_id");
	$query6 = mysqli_query($conn, $sql6);
}

mysqli_close($conn);
?>