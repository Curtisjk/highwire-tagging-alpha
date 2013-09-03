Youtube Video Tagging Tool (Alpha Build)
===========
This work is carried out as part of the HighWire Centre for Doctoral Training, funding under the RCUK Digital Economy programme (Grant Reference EP/G037582/1).

This web-based tool was built during research on crowdsourced metadata that was carried out during Summer 2013 for the Highwire Centre for Doctoral Training at Lancaster University.

It is designed to allow participants to view a one or more YouTube videos and add text-based tags when watching the video. This is stored anonymously in a MySQL database along with the timestamp. The results can be retrieved using the included reporting tool.

How It Works
-------------
The tool is web-based. The tagging elements use YouTube's Javascript API and a custom player alongside a PHP and MySQL backend which serves the pages and stores the results in a MySQL Database. In order for participants to use this tool their browser must support Javascript and Flash.

Libraries Used
-------------
* Twitter Bootstrap 2
* Highcharts
* JQuery 1.9.1
* JQuery-SWFObject 1.1.1
* JQuery BlockUI
* JQuery Cookie
* cookiecuttr.js

Installation
-------------
1. Copy the contents of the public_html folder to your webserver
2. Create a MySQL database
3. Using your preferred database editor, import the database.sql file to your newly created database.
4. Edit the /config/config.php file with your site and database settings.

Configuring the Video List
-------------
The video list is controlled from within the /report directory.