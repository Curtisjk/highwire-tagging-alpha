<?php
	//MySQL Database Settings
	define('DB_HOST', 'localhost');
	define('DB_PORT', 3306);
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
	define('DB_NAME', 'tagging_alpha');
	define('SITE_HOME', '/dev/taggingalpha/public_html/');

	define('AES', '5Aqeyu');

	//app configuration settings

	//cookies
	define('COOKIE_LENGTH', time() + (3600 * 24)); //length, in seconds (time() + 3600 = 1 hour)
	//currently set to 24 hours - when the user finishes the session, we destroy cookies anyway.
?>