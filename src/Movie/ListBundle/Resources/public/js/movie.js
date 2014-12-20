$(document).ready( function() 
{
	$(".navbar-toggle").mouseover(function(){
		$(".icon-bar").css("background-color","rgba(66,139,202,1)");
	});
	$(".navbar-toggle").mouseout(function(){
		$(".icon-bar").css("background-color","rgba(137,137,137,1)");
	});
        
        $(".movie-last-add").click(function(e){
            showLoader();
            e.preventDefault(); // Empêche le navigateur de suivre le lien.
            var id = $(this).attr("id");
            viewDetail(id);
        });
        
        $(".movie-home").click(function(e){
            showLoader();
            e.preventDefault(); // Empêche le navigateur de suivre le lien.
            homeMovie();
        });
        
        $(".movie-add").click(function(e){
            showLoader();
            e.preventDefault(); // Empêche le navigateur de suivre le lien.
            addMovie();
        });
        
        $(".movie-search").click(function(e){
            showLoader();
            e.preventDefault(); // Empêche le navigateur de suivre le lien.
            searchMovie();
        });
        
        $(".movie-list").click(function(e){
            showLoader();
            e.preventDefault(); // Empêche le navigateur de suivre le lien.
            listMovie(1);
        });
                
});

function hideLoader(){
    $(".loader-wrap").fadeOut(200);
}

function showLoader(){
    $(".loader-wrap").fadeIn(200);
}