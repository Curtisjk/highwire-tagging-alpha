Youtube Video Tagging Tool (Alpha Build)
-------------
This work is carried out as part of the HighWire Centre for Doctoral Training, funding under the RCUK Digital Economy programme (Grant Reference EP/G037582/1).

This web-based tool was built during research on crowdsourced metadata that was carried out during Summer 2013 for the Highwire Centre for Doctoral Training at Lancaster University.

It is designed to allow participants to view a one or more YouTube videos and add text-based tags when watching the video. This is stored anonymously in a MySQL database along with the timestamp. The results can be retrieved using the included reporting tool.

How It Works
-------------
The tool is web-based. The tagging elements use YouTube's Javascript API and a custom player alongside a PHP and MySQL backend which serves the pages and stores the results in a MySQL Database. In order for participants to use this tool their browser must support Javascript, Flash and have cookies enabled.

The tool will cycle through a predefined list of videos - the particiapant may choose to do all of these videos if they wish to do so but may end the process at any time. When the participant visits a new video they will also be asked to rate their expertise on the video's subject.

###Demo
Public Tool - http://curtiskennington.co.uk/demo/highwire-alpha/
Reports (No login required) - http://curtiskennington.co.uk/demo/highwire-alpha/report/

Libraries Used
-------------
* Twitter Bootstrap 2 (Bootstrap 3 in the report section)
* Highcharts
* JQuery 1.9.1
* JQuery-SWFObject 1.1.1
* JQuery BlockUI
* JQuery Cookie
* cookiecuttr.js

Installation
-------------
1. Copy the contents of the `public_html` folder to your webserver
2. Create a MySQL database
3. Using your preferred database editor, import the `/install/database.sql` file to your newly created database.
4. Edit the `/config/config.php` file with your site and database settings.

**IMPORTANT:** You will also need to secure the `/report` directory. How you do this is up to you, the easiest way is to use .htaccess. During the study at Lancaster University, we used the university's own CAS server for authentication.

Configuring the Video List
-------------
The video list is controlled by the `/config/videos.php` file. This uses a PHP array to store the video information including the title, description and YouTube ID of the video. This array must contain at least one video, but there is no maximum number of videos you may add.

An example of the video configuration can be seen below:

```PHP
$videos = array(
	array(
		"id" => "fAZpWctgZrY",
		"name" => "Police clash with unionist march in Belfast",
		"desc" => "At least four police officers and a Member of Parliament were injured Friday in clashes in the Northern Ireland capital of Belfast, when an annual unionist march devolved into violence. MP Nigel Dodds was taken to a hospital after being hit on the head by a projectile, while three of the four injured police were knocked out."
	),


	array(
		"id" => "FU2puZ6e4_0",
		"name" => "Dolphins Make a Splash with Blind Students",
		"desc" => "A group of blind and visually impaired students got the chance to interact with dolphins at Miami's Seaquarium. The program supports learning about nature and confidence building. (July 12)."
	)
)
```