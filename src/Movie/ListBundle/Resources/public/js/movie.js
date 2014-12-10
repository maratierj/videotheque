$(document).ready( function() 
{
	$(".navbar-toggle").mouseover(function(){
		$(".icon-bar").css("background-color","rgba(66,139,202,1)");
	});
	$(".navbar-toggle").mouseout(function(){
		$(".icon-bar").css("background-color","rgba(137,137,137,1)");
	});
        
        $(".movie-last-add").click(function(e){
            e.preventDefault(); // Empêche le navigateur de suivre le lien.
            var id = $(this).attr("id");
            viewDetail(id);
        });
});