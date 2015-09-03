<?php
include("connect.php");
//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	//Get page number from Ajax POST
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
	}else{
		$page_number = 1; //if there's no page number, set it to 1
	}
	
	//get total number of records from database for pagination
	$results = $conn->query("SELECT COUNT(img_id) FROM images");
	$get_total_rows = $results->fetch_row(); //hold total records in variable
	//break records into pages
	$total_pages = ceil($get_total_rows[0]/$item_per_page);
	
	//get starting position to fetch the records
	$page_position = (($page_number-1) * $item_per_page);
	
	//SQL query that will fetch group of records depending on starting position and item per page. See SQL LIMIT clause
	$results = $conn->query("SELECT * FROM images ORDER BY img_id DESC LIMIT $page_position, $item_per_page");
	
	//Display records fetched from database.
	
	echo '<div class="image_contrib">';
	while($row = $results->fetch_assoc()) {
		echo '<div class="new_image">';
		echo '<img src="' . $row["img_link"] . '"></img>';
		echo '<div class="img_panel">';
		echo '<div class="votecount"><div class="heart"></div><p>0</p></div>';
		echo '<div class="share"></div>';
		echo '<button id="'. $row['img_id'] .'" class="btn_vote">Rösta</button>';
		echo '</div>';
		echo '</div>';
	}  
	echo '</div>';
	
	
	echo '<div class="pagination_wrapper">';
	/* We call the pagination function here to generate Pagination link for us. 
	As you can see I have passed several parameters to the function. */
	echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
	echo '</div>';
	echo '<div class="pagination_wrapper_lower">';
	/* We call the pagination function here to generate Pagination link for us. 
	As you can see I have passed several parameters to the function. */
	echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
	echo '</div>';
}
################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<div class="pagination">';
        
        $right_links    = $current_page + 1; 
        $previous       = $current_page - 1; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)?1:$previous;
            $pagination .= '<div class="previous"><a href="#" data-page="'.$previous_link.'" title="Previous">&laquo; FÖREGÅENDE</a></div>'; //previous link   
            $first_link = false; //set first link to false
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<div class="right_links"><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></div>';
            }
        }
        if($current_page <= $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<div class="page"><p>SIDA '.$current_page.' AV '.$total_pages.'</p></div><div class="next"><a href="#" data-page="'.$next_link.'" title="Next">NÄSTA &raquo;</a></div>'; //next link
        }
        
        $pagination .= '</div>'; 
    }
    return $pagination; //return pagination links
    mysqli_close($conn);
}
?>
<script type="text/javascript">
	$(document).ready(function(){
	});
	$(".btn_vote").click(function(){
		var voted_image = $(this).attr("id");
		console.log(voted_image);
	});
</script>

