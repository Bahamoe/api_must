$(document).ready(function() {
	//$('meny-button').addClass('unmarked-menu-button');
	$("#results" ).load( "../filer/fetch_images.php"); //load initial records
	
	//executes code below when user click on pagination links
	$("#results").on( "click", ".pagination a", function (e){
		e.preventDefault();
		var page = $(this).attr("data-page"); //get page number from link
		$("#results").load("../filer/fetch_images.php",{"page":page}, function(){ //get content from PHP page
		});
		
	});
});
function markedButton(button){

	$(button+' button').removeClass('meny-button').attr('id', 'marked-meny-button');
}