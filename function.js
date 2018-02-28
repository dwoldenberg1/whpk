$(function(){
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
});