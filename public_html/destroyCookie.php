<?php
	//reset all cookie values to NULL, then expire.
	setcookie("uid", "", time()-3600);
	setcookie("group", "", time()-3600);
	setcookie("watched", "", time()-3600);
?>