$(document).ready( function() 
{
	$(".navbar-toggle").mouseover(function(){
		$(".icon-bar").css("background-color","rgba(66,139,202,1)");
	});
	$(".navbar-toggle").mouseout(function(){
		$(".icon-bar").css("background-color","rgba(137,137,137,1)");
	});
});