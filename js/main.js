$(document).ready(function() {
	$("#results" ).load( "../filer/fetch_imgages.php"); //load initial records
	
	//executes code below when user click on pagination links
	$("#results").on( "click", ".pagination a", function (e){
		e.preventDefault();
		var page = $(this).attr("data-page"); //get page number from link
		$("#results").load("../filer/fetch_imgages.php",{"page":page}, function(){ //get content from PHP page
		});
		
	});
});