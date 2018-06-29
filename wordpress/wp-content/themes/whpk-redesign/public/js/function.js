jQuery(document).ready(function( $ ) {
	/** Front end stuff **/

	var strm = document.getElementById("whpk-play");

	strm.volume = 0;

	var playing  = getCookie("playing");
	var play_vis = getCookie("play-visible");

	if(play_vis == "0"){
		togglePlayVis(1);
	} else {
		togglePlayVis(2);
	}

	function do_loaded(){
		var strm_local = document.getElementById("whpk-play");

		$('#listen-item').text("LISTEN").removeClass("strm-loading").css("left", "0px");
		$('#listen-item-bar').text("LISTEN").removeClass("strm-loading").css("left", "45px");

		if(playing == "1"){
			listenStuff(2);
			strm_local.volume = 1;
		} else {
			listenStuff(1);
			strm_local.volume = 0;
		}

		$('.listen').click(listenStuff);
		$('.bar-listen').click(listenStuff);
	}

	strm.addEventListener('canplaythrough', do_loaded, false);

	function listenStuff(forced){
		var strm_local = document.getElementById("whpk-play");

		var l = $('.listen');

		if(forced == 2){
			l.addClass("pulse");
		} else if (forced == 1) {
			l.removeClass("pulse");
		} else {
			l.toggleClass("pulse");
		}
		if(forced == 2 || (!strm_local.volume && forced != 1)){
			strm_local.volume = 1;
			$('#listen-item').css("color", "#2fab2f");
			$('.bar-listen').css("color", "#2fab2f");
			setCookie("playing", "1", 60);
			return;
		} else if (forced == 1 || strm_local.volume ){
			strm_local.volume = 0;
			$('#listen-item').css("color", "#000");
			$('.bar-listen').css("color", "#000");
			setCookie("playing", "0", 60);
			return;
		}
	}

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

	$('.toggle-arrow').on('click', togglePlayVis);

	function togglePlayVis(forced){
		var p = $('.playing');

		if(forced == 1 || (p.hasClass('playing-open') && forced != 2)){
			p.css("right", -1 * (p[0].offsetWidth - 35) + "px");
			setTimeout(function(){
				p.css("right", -1 * (p[0].offsetWidth - 35) + "px");
			}, 400); // needed for mobile text-wrapping
			p.removeClass('playing-open');
			p.find('svg').removeClass('fa-arrow-circle-right').addClass('fa-arrow-circle-left');
			setCookie("play-visible", "0", 60);
			return;
		} else if(forced == 2 || !p.hasClass('playing-open')) {
			p.addClass('playing-open');
			p.css("right", "0px");
			p.find('svg').addClass('fa-arrow-circle-right').removeClass('fa-arrow-circle-left');
			setCookie("play-visible", "1", 60);
			return;
		}
	}

	/** wp-admin stuff **/
});

/* Straight outa w3schools baby */

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
