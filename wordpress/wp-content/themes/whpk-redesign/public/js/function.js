

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

	if (forced.target){
		forced.stopPropagation();
		forced.preventDefault();
	}

	if(forced == 2 || (strm_local.muted && forced != 1)){
		strm_local.muted = false;
		$('#listen-item').css("color", "#2fab2f");
		$('.bar-listen').css("color", "#2fab2f");
		localStorage.setItem("playing", "1");
		return;
	} else if (forced == 1 || !strm_local.muted ){
		strm_local.muted = true;
		$('#listen-item').css("color", "#000");
		$('.bar-listen').css("color", "#000");
		localStorage.setItem("playing", "0");
		return;
	}
}

function togglePlayVis(forced){
	var p = $('.playing');

	if(forced == 1 || (p.hasClass('playing-open') && forced != 2)){
		p.css("right", -1 * (p[0].offsetWidth - 35) + "px");
		setTimeout(function(){
			p.css("right", -1 * (p[0].offsetWidth - 35) + "px");
		}, 400); // needed for mobile text-wrapping
		p.removeClass('playing-open');
		p.find('svg').removeClass('fa-arrow-circle-right').addClass('fa-arrow-circle-left');
		localStorage.setItem("play-visible", "0");
		return;
	} else if(forced == 2 || !p.hasClass('playing-open')) {
		p.addClass('playing-open');
		p.css("right", "0px");
		p.find('svg').addClass('fa-arrow-circle-right').removeClass('fa-arrow-circle-left');
		localStorage.setItem("play-visible", "1");
		return;
	}
}

function do_loaded(){
	var playing  = localStorage.getItem("playing");

	$('#listen-item-bar').text("LISTEN").removeClass("strm-loading").css("left", "45px");
	$('#listen-item').text("LISTEN").removeClass("strm-loading").css("left", "0px");

	if(playing == "1"){
		listenStuff(2);
	} else {
		listenStuff(1);
	}

	$('.listen').click(listenStuff);
	$('.bar-listen').click(listenStuff);
}

function closeModal(){
	var text = $('.modal-text')[0].innerText.replace(/(\n|\t| )/g, "")

	$('#main-cont').removeClass('modal-enabled');
	$('.custom-modal').addClass('hidden');

	localStorage.setItem('old-msg', text);
	localStorage.setItem('hide-modal', "1");
}

jQuery(document).ready(function( $ ) {
	/** Front end stuff **/

	var strm = document.getElementById("whpk-play");

	strm.muted = true;

	var play_vis = localStorage.getItem("play-visible");

	if(play_vis == "0"){
		togglePlayVis(1);
	} else {
		togglePlayVis(2);
	}

	document.getElementById("whpk-play").addEventListener('canplaythrough', do_loaded, false);

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

	modaltxt = $('.modal-text');

	if(modaltxt[0] && modaltxt[0].innerText.replace(/(\n|\t| )/g, "") != localStorage.getItem("old-msg")) {
		$('#main-cont').addClass('modal-enabled');
		$('.custom-modal').removeClass('hidden');
		localStorage.setItem('hide-modal', "0");
		localStorage.setItem('old-msg', modaltxt[0].innerText.replace(/(\n|\t| )/g, ""));
	} else if (localStorage.getItem("hide-modal") == "1") {
		closeModal();
	}

	$('.toggle-arrow').on('click', togglePlayVis);

	$('.close-modal').on('click', closeModal);

	/** wp-admin stuff **/
});
