jQuery(document).ready(function( $ ) {
	/** Front end stuff **/

	var strm = document.getElementById("whpk-play");

	strm.muted = true;

	function listenStuff(){
		$('.listen').toggleClass("pulse");
		if(strm.muted){
			strm.muted = false;
			$('#listen-item').css("color", "#2fab2f");
			$('.bar-listen').css("color", "#2fab2f");
		} else {
			strm.muted = true;
			$('#listen-item').css("color", "#000");
			$('.bar-listen').css("color", "#000");
		}
	}

	$('.listen').click(listenStuff);
	$('.bar-listen').click(listenStuff);

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

	/** wp-admin stuff **/
});