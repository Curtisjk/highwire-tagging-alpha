<?include_once("config/config.php");?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
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
<style>
	#canvas-container {
   	 	overflow-x: auto;
    	overflow-y: visible;
	    position: relative;
    	margin-top: 20px;
    	margin-bottom: 20px;
	}
	#canvas {
	    display: block;
	}
</style>
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
		<h1>Thanks!</h1>
		
		<div id="canvas-container">
          <canvas id="canvas"></canvas>
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

<script src="js/jquery.js"></script>
<script src="js/wordcloud2/wordcloud2.js"></script>
<script src="js/wordfreq/wordfreq.js"></script>
<script>
		//wordfreq stuff
		// Create an options object for initialization
		var list;
		var options = {
		  workerUrl: 'js/wordfreq/wordfreq.worker.js',
		  minimumCount: 1, };

		  var text = "japanese,collision,whaling,what is this about,who's ship,can't understand japanese,collision in protest,direct action,dangerous encounter,where is the water cannon coming from,boat,water jet,collision,continued collision,jet,decoupled,new shot,persistent,new shot,boat eye view,WAF?!,pull it down!,too much blue branding,white water-trajectory disturbing,angry man,does he get a ticket?,insurance claim?,2 ships,Foreign language voice over,ships collide,Asian language (voice over),Ship turning into other ship,Water cannon at ramming ship,ship being pushed over,ship pursuing other ship,crash, shock, ship, crash,Anger,News,Impact,propaganda,ocean,anger,ramming,conservation,preservation,eco warriors,illegal activities,legal activities,poor quality video,scare tactics,research?,accident?,ocean wake,What was the third ship?,provocation,direct action,jet,Add Tag,chase,spray,";
		// Initialize and run process() function
		var wordfreq = WordFreq(options).process(text, function (newList) {
		  // console.log the list returned in this callback.
		  WordCloud(document.getElementById('canvas'), { 
	      	list : newList,
	      	minSize: 6,
	      	weightFactor: 25,
	      } );
		});

		var dppx = window.devicePixelRatio;
		var canvas = $('#canvas');
		var canvasContainer = $('#canvasContainer');
		var width = 500;
		var height = 500;

		var box = $('<div id="box" hidden />');
	    canvasContainer.append(box);
	    window.drawBox = function drawBox(item, dimension) {
	      if (!dimension) {
	        box.prop('hidden', true);

	        return;
	      }

	      box.prop('hidden', false);
	      box.css({
	        left: dimension.x / dppx + 'px',
	        top: dimension.y / dppx + 'px',
	        width: dimension.w / dppx + 'px',
	        height: dimension.h / dppx + 'px'
	      });
	    };

	    // Set the width and height
	      if (dppx !== 1) {
	        canvas.css({'width': width + 'px', 'height': height + 'px'});

	        width *= devicePixelRatio;
	        height *= devicePixelRatio;
	      } else {
	        canvas.css({'width': '', 'height': '' });
	      }

	      canvas.attr('width', width);
	      canvas.attr('height', height);

	      

</script>
</body>
</html>