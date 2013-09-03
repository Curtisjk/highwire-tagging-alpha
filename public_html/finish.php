<?php
	//check to see whether we have a cookie value for the uid - if not, redirect to the timeout page.
	if(!isset($_COOKIE["uid"])){
		header( 'Location: timeout.php' ) ;
	}

	//include our config data
	include_once("config/config.php");

	//grab the uid
	$userID = $_COOKIE["uid"];

	//destroy cookies
	include_once("destroyCookie.php");
?>
<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="" name="keywords"/>
<meta content="Thanks for dropping by and considering helping out with this piece of academic research." name="description"/>
<meta content="text/html; charset=utf-8" http-equiv="content-type"/>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
<meta content="width=767px" name="viewport"/>
<meta content="http://www.lancs.ac.uk/iss/taggingstudy" property="og:url"/>
<meta content="Video Tagging Research Project" property="og:title"/>
<title>Video Tagging Research Project</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<link type="text/css" rel="stylesheet" href="css/default.css"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
<link rel="shortcut icon" href="favicon.ico">
</head>
<body  data-spy="scroll" data-target="#navMain" data-offset="130">
<!--[if lt IE 9]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a newer browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to properly experience this and other websites.</p><![endif]-->
<nav id="navMain" class="navbar navbar-fixed-top">
<div class="navbar-inner">
	<div class="container-fluid">
		<button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="brand" href="#">Vuact</a>
		<div class="nav-collapse collapse">
			<ul class="nav">
				<li><a class="signup-link" href="<?=SITE_HOME?>">Project Home</a></li>
			</ul>
			<!-- /nav -->
		</div>
		<!-- /nav-collapse -->
	</div>
	<!--[if lt IE 9]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a newer browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to properly experience this and other websites.</p><![endif]-->
</div>
</nav>
<div class="container-fluid">
</div>
<div class="main-content">
	<div class="container-fluid">
		<h1>Thank You For Taking Part</h1>
		
		<div class="content-box">
			<form class="form-horizontal" id="emailForm" name="emailForm">
				<fieldset>
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid">
								<div class="span6" style="margin-right:20px;">
									<p>Thank you for helping us out.</p>
									<p>If you would like to see the results of this study or would be willing to answer a question or two later on just let us know by leaving your email address</p>			
									<p>Your tagging results are anonymous so <span style="font-weight: bold;">if you don't want to be contacted you can just close the browser window.</span></p>
								</div>
								<div class="span6 box_right">
									<h3>Share</h3>
									<p>Another quick favour if we may. Got friends? Think they might also help? Why not let them know via your social network...</p>
									<center>
									<a href="#" 
									  onclick="
									    window.open(
									      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('http://www.lancs.ac.uk/iss/taggingstudy'), 
									      'facebook-share-dialog', 
									      'width=626,height=436'); 
									    return false;">
										<img src="img/buttons/facebook.png" width="80px"/>
									</a>

									<a href="#" 
									  onclick="
									    window.open(
									      'https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Fwww.lancs.ac.uk%2Fiss%2Ftaggingstudy%2Ffinish.php&text=Participate%20in%20crowdsourced%20news%20study%20-&tw_p=tweetbutton&url=http%3A%2F%2Fwww.lancs.ac.uk%2Fiss%2Ftaggingstudy%2F&via=HighWireDTC', 
									      'twitter-share-dialog',
									      'width=626,height=300'); 
									    return false;">
										<img src="img/buttons/twitter.png" width="80px" style="margin-left: 20px; margin-right: 20px"/>
									</a>

									<a href="#" 
									  onclick="
									    window.open(
									      'https://www.linkedin.com/cws/share?url=http://lancs.ac.uk/iss/taggingstudy', 
									      'linkedin-share-dialog',
									      'width=626,height=300'); 
									    return false;">
										<img src="img/buttons/linkedin.png" width="80px"/>
									</a>
								</center>
									<hr/>
									<form class="form-horizontal">
									  <h3>Opt Into Email Updates (Optional)</h3>
									  <div class="control-group">
									    <label class="control-label" for="email">Email Address</label>
									    <div class="controls">
									      <input type="text" id="email" placeholder="Email">
									    </div>
									  </div>

									  <div class="control-group">
									    <label class="control-label" for="prefs">Opt-In Preferences</label>
									    <div class="controls">
									      	<label class="checkbox">
											  <input id = "prefs_1" name="prefs_1" type="checkbox" value="Results">
											  Send me my feedback
											</label>
											<label class="checkbox">
											  <input id = "prefs_2" name="prefs_2" type="checkbox" value="Other Studies">
											  I'd like to take part in future studies
											</label>
									    </div>
									  </div>

									  <div class="control-group">
									    <div class="controls">
									 		<input class="btn" name="submit" id="submit" type="button" value="Submit" onclick="return emailSubscribe(this);">
									    </div>
									  </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
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
			<p class="vuact-build">
			</p>
		</div>
		<!-- /span12 -->
	</div>
	<!-- /row -->
</div>
<!-- /container -->
</footer>

<!-- Modal -->
<div id="errorModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="errorHeader"></h3>
  </div>
  <div class="modal-body" id="errorBody">
   		
  </div>
  <div class="modal-footer">
  	<a href="#" class="btn btn-gray" data-dismiss="modal">Cancel</a>
  </div>
</div>


<script>
	var userID = <?=$userID?>;
</script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/email.js"></script>
</body>
</html>