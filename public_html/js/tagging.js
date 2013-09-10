// This is a different elements object to the youtube
// one because it is placed in a seperate scope
//   - Maybe change the name to distinguigh between the two?
//   - More elements could be cached, just using the main ones
var elements = {
	comment: $('#comment'),
	commentForm: $('#commentForm')
}


function jump(h){
    var url = location.href;
    location.href = "#"+h;
    history.replaceState(null,null,url)
}

function submitExpertise(form)
{
	//grab the radio button
	var expertise = $('input[name=expertise]:checked').val();

	//disable the form
	$("#expertiseForm :input").attr("disabled", true);

	//submit the data
	$.ajax({
		type: "POST",
		url: "ajax/startSession.php",
		data: {userID: uid, videoID: vid, expertise: expertise}
	}).done(function(msg) {
		var data = jQuery.parseJSON(msg);
		if(data.status !== "Success"){
			alert("Error")
		} else {
			sessionID = data.data.sessionID;
			//jump to the video
			$('#videoHolder').unblock();
			jump("video1");
		}
	});
}

function validateTag() // NOTE": had 'form' as param but removed because it is used nowehere in the function
{
	if(elements.comment.val() === '' || elements.comment.val() === 'Add Tag')
	{
		alert("Please Enter A Tag");
		elements.comment.focus();
	} else {
		submitComment();
	}
		
}

function selectComment(field){
	//clear the message box
	if(field.value=='Add Tag'){
		field.value=''
	};
}

function submitComment()
{
	var time = document.getElementById(playerID).getCurrentTime();
	var comment = elements.comment.val();

	$.ajax({
		type: "POST",
		url: "ajax/addComment.php",
		data: {
			sessionID: sessionID, 
			time: time, 
			comment: comment
		}
	}).done(function(msg) {
		var data = jQuery.parseJSON(msg);
		if(data.status !== "Success"){
			alert("Error")
		} else {
			//add to table
			$('#commentTable > tbody:first').prepend('<tr><td>'+convertSeconds(data.data.videoTime)+'</td><td>'+unescape(data.data.comment)+'</td></tr>');

			//add to graph
			var graph = $('#graph').highcharts();
	        graph.series[0].addPoint({x: time, y: 0, name: unescape(data.data.comment)});

	        //check is video is playing
	        if($('#auto_pause').prop('checked')){
		        var player = document.getElementById(playerID);
		        if(player.getPlayerState() == 2){
		        	player.playVideo();
		        }
		    }

	        //reset the form
	        elements.commentForm[0].reset();

    	}
	});

	elements.comment.focus();

}

function pad2(number) {
     return (number < 10 ? '0' : '') + number
}

function convertSeconds(seconds){
	var mins = Math.floor(seconds/60);
	var secs = Math.floor(seconds - (mins * 60));

	return mins + ":" + pad2(secs);
}

function detectFlash(){
	if(!$.flash.available){
		window.onbeforeunload = null;
		window.location.replace("noflash.php");
	}
}

//prevent submit from refreshing the page.
$(function() {
    elements.commentForm.submit(function() { return false; });
});

//define spacebar actions - play/pause.
document.onkeydown=function(e){
	//spacebar press - ensure 'comment' and the video is excluded.
	if((e.keyCode==32) && (document.activeElement.id != 'comment') && (document.activeElement.id != playerID)){
		var player = document.getElementById(playerID);
		if(player.getPlayerState() == 1){
			//video is playing - pause
			player.pauseVideo();
		} else if(player.getPlayerState() == 2){
			//video is paused - play
			player.playVideo();
		}
		return false;
	}
}; 

//define keypress actions for the comment box
elements.comment.keypress(function (e) {

	var $this = $(this),
		SPACE_KEY = 32,
		ENTER_KEY = 13; // If these keys are used elsewhere maybe store them in a settings obj at top of file?

	//check for error
	if($this.hasClass('error')) { 
		$this.removeClass('error');
	}

	//enter to submit the form
    if (e.keyCode === ENTER_KEY) {

    	e.preventDefault();
       	validateTag();
        document.getElementById('comment').value='';
        
        return false;

    } else if (e.keyCode === SPACE_KEY) {

    	e.preventDefault(); // shouldn't this be for the enter key as that triggers form submission?
    	//flash red
    	elements.comment.addClass('error');
    	alert("We've disabled the spacebar in this study. Please tag using single words, or hyphenated words only.");
    	
    	return false;

    } else {

    	if($('#auto_pause').prop('checked')){
	    	var player = document.getElementById(playerID);
	    	//if the video is playing, pause it
	    	if(player.getPlayerState() == 1) {
	    		//video is playing - pause
				player.pauseVideo();
	    	}
    	}

    }
});

function restartVideo(){
	var player = document.getElementById(playerID);
	player.playVideo();

	//hide the restart button
	$('#restart_video').css("display", "none");

	$('#tag_list').css("max-height", "352px");
}

/* -------------------- Leave page warning -------------------- */
window.onbeforeunload = function() {
    return "You are leaving the tagging process. In order to save your tags, please use the \'I've Finished\' button.";
};

/* -------------------- Document ready code -------------------- */
$(document).ready(function() {
    $('#end a').click(function() { window.onbeforeunload = null; });
});

/* -------------------- YouTube Embed Functions -------------------- */
(function(){
	
	$.fn.youTubeEmbed = function(settings){

		// Settings can be either a URL string,
		// or an object
		
		if(typeof settings == 'string'){
			settings = {'video' : settings}
		}
		
		// Default values
		var def = {
			width		: 620,
			progressBar	: true
		};
		
		settings = $.extend(def,settings);
		
		var elements = {
			originalDIV	: this,	// The "this" of the plugin
			container	: null,	// A container div, inserted by the plugin
			control		: null,	// The control play/pause button
			player		: null,	// The flash player
			progress	: null,	// Progress bar
			elapsed		: null	// The light blue elapsed bar
		};
		

		try{
			settings.videoID = settings.video.match(/v=(.{11})/)[1];
			
			// The safeID is a stripped version of the
			// videoID, ready for use as a function name
			settings.safeID = settings.videoID.replace(/[^a-z0-9]/ig,'');
		
		} catch (e){
			// If the url was invalid, just return the "this"
			return elements.originalDIV;
		}

		// Fetch data about the video from YouTube's API
		var youtubeAPI = 'http://gdata.youtube.com/feeds/api/videos/'+settings.videoID+'?v=2&alt=jsonc';
		jQuery.ajaxSetup({async:false});
		$.get(youtubeAPI,function(response){

			var data = response.data;
			if(data.error != null || data.accessControl.embed!="allowed"){
				
				// If the video was not found, or embedding is not allowed;
				return elements.originalDIV;
			}

			settings.ratio = 9/16;
			/*if(data.aspectRatio == "widescreen"){
				settings.ratio = 9/16;
			}*/
			
			settings.height = Math.round(settings.width*settings.ratio);
			
			elements.originalDIV.empty();

			// Creating a container inside the original div, which will
			// hold the object/embed code of the video
			elements.container = $('<div>',{
				class:'flashContainer',
				css:{
					width	: settings.width,
					height	: settings.height+35,
				}
			}).appendTo(elements.originalDIV);

			elements.container.css("background-color","#000000");
			// Embedding the YouTube chromeless player
			// and loading the video inside it:

			elements.container.flash({
				swf			: 'http://www.youtube.com/v/'+settings.videoID+'?enablejsapi=1&version=3&controls=0&showinfo=0&rel=0&modestbranding=1',
				id			: 'video_'+settings.safeID,
				height		: settings.height,
				width		: settings.width,
				allowScriptAccess:'always',
				wmode		: 'transparent',
				flashvars	: {
					"video_id"		: settings.videoID,
					"playerapiid"	: settings.safeID
				}
			});

			// We use get, because we need the DOM element itself, and not a jquery object:
			elements.player = elements.container.flash().get(0);

			elements.controls = $('<div id="controlContainer"></div>').appendTo(elements.container);
			
			elements.graph = $('<div id="graph" ></div>')
							   .appendTo(elements.controls);
			

			// If the user wants to show the progress bar:
			if(settings.progressBar){
				var seekBar;

				elements.progress =	$('<div class="progressBar" >')
									.appendTo(elements.controls);

				elements.buffered =	$('<div>',{class:'buffered'})
									.appendTo(elements.progress);

				elements.elapsed =	$('<div>',{class:'elapsed'})
									.appendTo(elements.progress);

				elements.seek =	$('<div>',{class:'seek'})
									.appendTo(elements.progress);
				

				elements.progress.click(function(e){
					// When a click occurs on the progress bar, seek to the
					// appropriate moment of the video.
					var ratio = (e.pageX-elements.progress.offset().left)/elements.progress.outerWidth();
					elements.elapsed.width(ratio*100+'%');
					elements.player.seekTo(Math.round(data.duration*ratio), true);
					
					//clear the interval
					window.clearInterval(interval);
					
					return false;
				});

				elements.progress.mousemove(function(e){
						
						elements.seek.css("visibility",'visible');
						var ratio = (e.pageX-elements.progress.offset().left)/elements.progress.outerWidth();
						elements.seek.width(ratio*100+'%');
					return false;
				});

				elements.controls.buttons =	$('<div>',{class:'buttons'})
									.appendTo(elements.controls);

				elements.controls.buttons.lhs = $('<div>',{class:'button_left'})
									.appendTo(elements.controls.buttons);

				elements.controls.buttons.rhs = $('<div>',{class:'button_right'})
									.appendTo(elements.controls.buttons);

				//add some buttons
				elements.controls.buttons.lhs.pButton = $('<div>',{class:'pButton'})
									.appendTo(elements.controls.buttons.lhs);

				elements.controls.buttons.lhs.sButton = $('<div>',{class:'sButton'})
									.appendTo(elements.controls.buttons.lhs);

				//time controls
				elements.controls.buttons.lhs.timeElapsed = $('<div>',{class:'timeElapsed'})
									.appendTo(elements.controls.buttons.lhs);

				elements.controls.buttons.lhs.timeTotal = $('<div>',{class:'timeTotal'})
									.appendTo(elements.controls.buttons.lhs);
			}

			var initialized = false;
			var videoLength = data.duration;
			var interval;
			
			// Creating a global event listening function for the video
			// (required by YouTube's player API):
			window['eventListener_'+settings.safeID] = function(status){
				if(status==-1)	// video is loaded
				{
					//set video length
					elements.controls.buttons.lhs.timeElapsed.append("0:00");
					elements.controls.buttons.lhs.timeTotal.append("&nbsp;/ "+convertSeconds(elements.player.getDuration()));

					//set the default button classes
					elements.controls.buttons.lhs.pButton.addClass('play');
					elements.controls.buttons.lhs.sButton.addClass('play');

					//listen for button presses on the play/pause button
					elements.controls.buttons.lhs.pButton.click(function(){
						//play/pause button pressed
						if(!elements.container.hasClass('playing')){
                    		//play the video
                    		elements.controls.buttons.lhs.pButton.removeClass('play replay').addClass('pause');
							elements.player.playVideo();
						}else{
                    		//pause the video
							elements.player.pauseVideo();
						}
					});

					//listen for presses on the sound/mute button
					elements.controls.buttons.lhs.sButton.click(function(){
						//play/pause button pressed
						if(!elements.controls.buttons.lhs.sButton.hasClass('mute')){
							//audio is not muted, mute it
							elements.controls.buttons.lhs.sButton.removeClass('play').addClass('mute');
							elements.player.mute()
						}else{
							//audio is muted, unmute it
							elements.controls.buttons.lhs.sButton.removeClass('mute').addClass('play');
							elements.player.unMute()
						}
					});

				} else if(status==0){ // video has ended
					window.clearInterval(interval);
					if(settings.progressBar){
						elements.elapsed.width('100%');
						//set the time elapsed to the end time
						elements.controls.buttons.lhs.timeElapsed.text(convertSeconds(videoLength));
					}

					//show the video ended overlay
					$('#restart_video').css("display", "inline-block");

					$('#tag_list').css("max-height", "322px");
				} else if(status==1){ //playing
					//set the icons
					elements.controls.buttons.lhs.pButton.removeClass('play replay').addClass('pause');
                    //set the playing class on the wrapper to show that it is playing
                    elements.container.addClass('playing');

					if(settings.progressBar){
					   interval = window.setInterval(function(){
						   elements.elapsed.width(
							   ((elements.player.getCurrentTime()/data.duration)*100)+'%'
						   );
						   
						   //update the buffered line
						   elements.buffered.width(((elements.player.getVideoLoadedFraction() * 100))+'%');

						   //update the time
					   	   elements.controls.buttons.lhs.timeElapsed.text(convertSeconds(elements.player.getCurrentTime()));
					   },100);
				   }

				   	//focus on the comment box
					$('#comment').focus();	
				} else if(status==2) {//paused
					//set the icons
					elements.controls.buttons.lhs.pButton.removeClass('pause').addClass('play');
                    elements.container.removeClass('playing');
					if(settings.progressBar){
						window.clearInterval(interval);
					}
				}
			}
			
			// This global function is called when the player is loaded.
			// It is shared by all the videos on the page:
			
			if(!window.onYouTubePlayerReady)
			{				
				window.onYouTubePlayerReady = function(playerID){
					document.getElementById('video_'+playerID).addEventListener('onStateChange','eventListener_'+playerID);
					loadGraph();
				}
			}
		},'jsonp');

		return elements.originalDIV;
	}
})(jQuery);