<?php
	//MySQL Database Settings
	define('DB_HOST', 'localhost');
	define('DB_PORT', 3306);

	//The MySQL Username
	define('DB_USER', '');

	//The MySQL Password
	define('DB_PASS', '');

	//The MySQL Database Name
	define('DB_NAME', '');

	//The SITE_HOME setting refers to where your install is located on your site
	//eg - http://example.com/tagging/tool/ would be '/tagging/tool/'
	define('SITE_HOME', '/');

	//The AES key is used to encrypt stored emails
	define('AES', '5Aqeyu');

	//cookies
	define('COOKIE_LENGTH', time() + (3600 * 24)); //length, in seconds (time() + 3600 = 1 hour)
	//currently set to 24 hours - when the user finishes the session, we destroy cookies anyway.
?>