<?php require 'header.php'; ?>
<?php
	$results = $conn->query("SELECT * FROM images ORDER BY votes DESC LIMIT 9");
	/*SELECT Group, COUNT(*) FROM table GROUP BY Group ORDER BY COUNT(*) DESC*/
	//Display records fetched from database.
	echo '<div id="top_images">';
	echo '<div class="image_contrib">';
	while($row = $results->fetch_assoc()) {
		echo '<div class="new_image">';
		echo '<img src="' . $row["img_link"] . '"></img>';
		echo '<div class="img_panel">';
		if($row['votes'] == 0){
			echo '<div class="votecount"><div class="heart"></div><p>0</p></div>';
		}else{
			echo '<div class="votecount"><div class="redheart"></div><p>'. $row['votes'] .'</p></div>';
		}
		echo '<div class="share"></div>';
		echo '<button id="'. $row['img_id'] .'" class="btn_vote">Rösta</button>';
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
	echo '</div>';
	mysqli_close($conn);
?>
<img src="../images/Topplista_Ny.png">

<script type="text/javascript">
	$(document).ready(function(){
		markedButton('#button3');
	});
</script>

<?php require 'footer.php'; ?>