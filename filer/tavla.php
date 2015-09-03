<?php require 'header.php'; ?>

<img src="../images/Start_ny.png">

<?php
	$results = $conn->query("SELECT * FROM images ORDER BY img_id ASC LIMIT 9");
	
	//Display records fetched from database.
	echo '<div id="latest_images">';
	echo '<div class="image_contrib">';
	while($row = $results->fetch_assoc()) {
		echo '<div class="new_image">';
		echo '<img src="' . $row["img_link"] . '"></img>';
		echo '<div class="img_panel">';
		echo '<div class="votecount"><div class="heart"></div><p>0</p></div>';
		echo '<div class="share"></div>';
		echo '<button>Rösta</button>';
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
	echo '</div>';
	mysqli_close($conn);
?>
<script type="text/javascript">
	$(document).ready(function(){
		markedButton('#button1');
	});
</script>

<?php require 'footer.php'; ?>