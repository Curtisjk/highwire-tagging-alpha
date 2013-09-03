<?php
	include_once("config/config.php");
	include_once("config/videos.php");
	
	//grab the video information
	$videoInfo = getNextVideo();

	if($videoInfo == 0){
		//session error
		header( 'Location: timeout.php' ) ;
	} else if($videoInfo == 1) {
		//watched all videos, send to end.
		header( 'Location: finish.php' ) ;
	}

	$userID = $_COOKIE["uid"];
?>
<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="" name="keywords"/>
<meta content="Thanks for dropping by and considering helping out with this piece of academic research into ways in which education and educational content could be improved." name="description"/>
<meta content="text/html; charset=utf-8" http-equiv="content-type"/>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
<meta content="width=767px" name="viewport"/>
<meta content="http://www.lancs.ac.uk/iss/vuact" property="og:url"/>
<meta content="Video Tagging Research Project" property="og:title"/>
<title>Video Tagging Research Project</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<link type="text/css" rel="stylesheet" href="css/default.css"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
<link type="text/css" rel="stylesheet" href="css/player.css"/>
<link rel="shortcut icon" href="favicon.ico">
</head>
<body data-spy="scroll" data-target="#navMain" data-offset="130">
<!--[if lt IE 9]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a newer browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to properly experience this and other websites.</p><![endif]-->
<nav id="navMain" class="navbar navbar-fixed-top">
<div class="navbar-inner">
	<div class="container">
		<button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="brand" href="#">Vuact</a>
		<div class="nav-collapse collapse">
			<ul class="nav">
				<li><a class="signup-link" href="#instructions">Instructions</a></li>
				<li><a class="signup-link" href="#aboutVideo">About The Video</a></li>
				<li><a class="signup-link" href="#video1">Video</a></li>
			</ul>
			<!-- /nav -->
		</div>
		<!-- /nav-collapse -->
	</div>
	<!--[if lt IE 9]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a newer browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to properly experience this and other websites.</p><![endif]-->
</div>
</nav>
<div class="container">
</div>
<div class="main-content">
	<div class="container">
		<h1 id="instructions" style="padding-top: 100px; margin-top: -100px;">Instructions</h1>
		<ol>
			<li>Have a read of the video description below and then answer the question about your own level of expertise/knowledge of the subject.</li>
			<li>Whilst watching the video we would like you to type tags describing the content. A tag is just one (or perhaps a hyphenated) word but NOT a sentence or question. </br></br><!--(If you're entering multiple tags together please separate them with a comma)-->(<span style="font-weight:bold;">NOTE:</span> the space bar is disabled to help you enter just one word)
				<!--
				<p style="padding-left: 25px;">
				<br><span style="font-weight:bold;">Noun:</span> a word that refers to a person, place, thing, event, substance or quality e.g.'nurse', 'cat', 'party', &amp; 'poverty'.
				<br><br><span style="font-weight:bold;">Verb:</span> a word or phrase that describes an action, condition or experience e.g. 'run', 'look' and 'feel'.
				<br><br><span style="font-weight:bold;">Adjective:</span> a word that describes a noun e.g. 'big', 'boring', 'pink', 'quick' and 'obvious'.
				</p>
			-->
			</li>
			<li>You can do this as many times as you want throughout the video. Just type your tag in the box below it and hit &lt;ENTER&gt; or click the "Add Tag(s)" button.</li>
			<li>Once you've finished tagging just click the "I've finished" button. You'll have the option to either tag another video or finish the task.</li>
		</ol>	

		<h1 id="aboutVideo" style="padding-top: 100px; margin-top: -100px;">About The Video</h1>
		<!-- <p>Please read through the description of the video, and then rate your expertise on the topic using the form below. Once you have submitted your expertise, you will be able to watch the video and begin the tagging process.</p> -->
		<div class="content-box" style="margin-top: 30px">
			<form id="expertiseForm" name="expertiseForm" autocomplete="off">
				<fieldset>
					<div class="row">
						<div class="span12">
							<div class="row">
								<div class="span6">
									<legend style="margin-bottom: 0;"><?=$videoInfo['name']?></legend>
									<p><?=$videoInfo['desc']?></p>
								</div>
								<div class="span6 box_right">
									<legend style="margin-bottom: 0;">Your Expertise</legend>
									<p>How would you rate your own knowledge of the video subject?</p>
									<label class="radio" style="padding-top: 7px" autocomplete="off">
									  <input type="radio" name="expertise" id="expertise" value="1" checked>
									  Nothing
									</label>
									<label class="radio"  style="padding-top: 7px" autocomplete="off">
									  <input type="radio" name="expertise" id="expertise" value="2">
									  Novice
									</label>
									<label class="radio" style="padding-top: 7px" autocomplete="off">
									  <input type="radio" name="expertise" id="expertise" value="3">
									  I know a little
									</label>
									<label class="radio" style="padding-top: 7px" autocomplete="off">
									  <input type="radio" name="expertise" id="expertise" value="4">
									  I know a fair bit
									</label>
									<label class="radio" style="padding-top: 7px" autocomplete="off">
									  <input type="radio" name="expertise" id="expertise" value="5">
									  Expert
									</label>
									
									<input class="btn" name="submitExp" id="submitExp" type="button" value="Submit" style="margin-top: 20px;" onclick="return submitExpertise(this);">
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		<h1 id="video1" style="padding-top: 80px; margin-top: -80px;">Video</h1>

		<div class="content-box" id="videoHolder">
			<div class="row">
				<div class="span11" style="margin-right: 0; width: 900px!important;">
					<div class="alert alert-info">
						<b>Beta Alert!</b> This software is currently experimental. If you experience any issues, please <a data-target="#help" data-toggle="modal">click here</a>.
					</div>
					<div class="row">
						<div class="span8" style="width: 620px!important;">
							<div id="video" style="height: 384px;">
							    You need Flash player 8+ and JavaScript enabled to view this video.
							 </div>
							 <div id="addComment" style="margin-top: 20px;">
							 	<form name="commentForm" id="commentForm" onsubmit="return false">
							 		<div class="input-append input-prepend">
									   <span class="add-on">
									   		Auto pause <input id="auto_pause" name="auto_pause" type="checkbox" value="true" checked> &nbsp;
									   </span>
									  <input size="20" name="comment" id="comment" type="text" autocomplete="off" onfocus="selectComment(this);" onblur="if(this.value==''){this.value='Add Tag'}" value="Add Tag">
									  <button class="btn" name="submit" id="submit" type="button" value="Submit" onclick="return validate(this);">Add Tags</button>
									</div>
							 	</form>
							 </div>
						</div>
						<div class="span2" style="margin-right: 0; width: 250px !important; max-height: 442px !important">
							<h3>Your Tags</h3>
							<div id="tag_list" style="width: 100%; max-height: 352px; margin-bottom: 23px; overflow-y: scroll;">
								<table class="table table-striped" id="commentTable" width="100%">
					              <thead>
					                <tr>
					                  <th>Time</th>
					                  <th>Comment</th>
					                </tr>
					              </thead>
					              <tbody>
					              </tbody>
					            </table>
					        </div>
					        <button class="btn btn-block" id="restart_video" name="restart_video" onclick="restartVideo();">Watch Again</button>
					        <a role="button" class="btn btn-block" data-target="#end" data-toggle="modal">I've Finished</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="homepage-footer">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span3">
					<h3>Learn more</h3>
					<ul>
						<li><a href="http://www.highwire.lancs.ac.uk/" target="_blank">About Highwire</a></li>
					</ul>
				</div>
				<div class="span3">
					
				</div>
				<!-- /span6 -->
				<div class="span6">
					<ul class="vuact-legal">
						<li>
						<a href="/"><img src="img/lu.png" width="100px" style="margin-top:10px"/></a>
						<a href="http://www.highwire.lancs.ac.uk/"><img src="img/highwire-small.png" width="100px" style="margin-left: 20px"/></a>
						</li>
						<li class="copyright">&copy; 2013 Lancaster University &amp; HighWire DTC.</li>
					</ul>
				</div>
			</div>
			<!-- /row-fluid -->
		</div>
		<!-- /span12 -->
	</div>
	<!-- /row-fluid -->
	<div class="row-fluid">
		<div class="copyright span12">
		</div>
		<!-- /span12 -->
	</div>
	<!-- /row -->
</div>
<!-- /container -->
</footer>

<!-- Modal -->
<div id="end" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Are You Sure?</h3>
  </div>
  <div class="modal-body">
   		<?if(($_COOKIE['watched']+1) == count($videos)){?>
   			<a href="finish.php" class="btn btn-block">I'm Done.</a>
   		<?} else {?>
    		<a href="nextVideo.php" class="btn btn-block">Let me tag another video. I've finished with this one.</a>
    		<a href="finish.php" class="btn btn-block">I'm Done. I've Had Enough.</a>
    		<?}?>
  </div>
  <div class="modal-footer">
  	<a href="#" class="btn btn-gray" data-dismiss="modal">Cancel</a>
  </div>
</div>

<!-- Support Modal -->
<!-- Modal -->
<div id="help" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Support</h3>
  </div>
  <div class="modal-body">
   		<p>If you are having technical difficulties, please email <a href="mailto:c.kennington@lancaster.ac.uk">c.kennington@lancaster.ac.uk</a> and include the following information in your email:</p>
   		<textarea id="supportInfo" rows="6"></textarea>

  </div>
  <div class="modal-footer">
  	<a href="#" class="btn btn-gray" data-dismiss="modal">Cancel</a>
  </div>
</div>

</div>
<!-- Lé Javascript -->
<script src="js/jquery.js"></script>
<script src="js/tagging.js"></script>
<script src="js/jquery.swfobject.1-1-1.min.js"></script>

<script>
	detectFlash();
</script>

<script src="js/bootstrap.min.js"></script>
<script src="js/highcharts/highcharts.js"></script>
<script src="js/videoGraph.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script> 
	//block the video
	$('#videoHolder').block({ message:"Please fill out the form above to begin." });

	$('#video').youTubeEmbed('/v=<?=$videoInfo['id']?>/');
	var uid = '<?=$userID?>';
	var vid = '<?=$videoInfo['id']?>';
	var playerID = "video_"+(vid.replace(/[^a-z0-9]/ig,''));
	var sessionID;

	$('#supportInfo').append("URL: "+window.location.href+"\n");
	$('#supportInfo').append("User agent: "+ navigator.userAgent+"\n");
	$('#supportInfo').append("Cookies: "+ navigator.cookieEnabled+"\n");
	$('#supportInfo').append("Flash: " + $.flash.version.string);
</script>				
</body>
</html>