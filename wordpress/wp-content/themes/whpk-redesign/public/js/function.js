jQuery(document).ready(function( $ ) {
	var strm = document.getElementById("whpk-play");

	strm.muted = true;

	$('.listen').click(function(){
		$(this).toggleClass("pulse");
		if(strm.muted){
			strm.muted = false;
			$('#listen-item').css("color", "#2fab2f");
		} else {
			strm.muted = true;
			$('#listen-item').css("color", "#000");
		}
	});

	$('.bar-listen').click(function(){
		if(strm.muted){
			strm.muted = false;
			$('.bar-listen').css("color", "#2fab2f");
		} else {
			strm.muted = true;
			$('.bar-listen').css("color", "#000");
		}
	})

	if($(document).find("title").text().indexOf("home") == -1){
		$('.sticky-cont').css("background", "rgba(255, 255, 255, 1)");
	}

	$('.ham').click(function(){
		$(this).toggleClass("change");

		if($(this).hasClass("change")){
			$('.collapsed').css("display", "inherit");
		} else {
			$('.collapsed').css("display", "none");
		}
	});
});