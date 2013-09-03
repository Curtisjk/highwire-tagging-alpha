<?php

	include_once("config.php");

	$videos = array(
		/*1 => array(
			"id" => "hIkgKkBXLTM",
			"name" => "Dzhokhar Tsarnaev Arrives at Court",
			"desc" => "Spectators gathered outside federal court to watch Dzhokhar Tsarnaev arrive for his arraignment. Survivors of the Boston Marathon bombings and family members of the victims are expected to pack the courtroom. (July 10)"
		),*/

		/*2 => array(
			"id" => "wX-YN7o630E",
			"name" => "Three gored in Pamplona bull run",
			"desc" => "An American and two Spaniards were gored in Spain's San Fermin festival bull run. The annual event draws thousands of thrill-seekers who race with the bulls along a 930-yard (850-meter) route. (July 12)"
		),*/

		1 => array(
			"id" => "fAZpWctgZrY",
			"name" => "Police clash with unionist march in Belfast",
			"desc" => "At least four police officers and a Member of Parliament were injured Friday in clashes in the Northern Ireland capital of Belfast, when an annual unionist march devolved into violence. MP Nigel Dodds was taken to a hospital after being hit on the head by a projectile, while three of the four injured police were knocked out."
		),

		/*4 => array(
			"id" => "m8Z7kPWskJA",
			"name" => "Robots arrive on the Farm, Replace Human Hands",
			"desc" => "Robots and computers are already replacing workers in factories and offices. Now engineers are developing intelligent machines to do farm work and help ease a worsening labor shortage on American farms. (July 15)."
		),*/
		
		2 => array(
			"id" => "FU2puZ6e4_0",
			"name" => "Dolphins Make a Splash with Blind Students",
			"desc" => "A group of blind and visually impaired students got the chance to interact with dolphins at Miami's Seaquarium. The program supports learning about nature and confidence building. (July 12)."
		),

		3 => array(
			"id" => "U82Xc0Oedmw",
			"name" => "FDA Proposes New Rule for Arsenic in Apple Juice",
			"desc" => "The Food and Drug Administration says the level of arsenic acceptable in apple juice should be the same as that allowed in drinking water. The agency says apple juice has always been safe to drink, but it's hoping to further limit exposure. (July 12)."
		),

		/*7 => array(
			"id" => "8-encv2R_Ks",
			"name" => "Van Driver Backs Into Stroller With Child",
			"desc" => "Police in Michigan are trying to find a man who backed his van into a stroller with a child inside and drove off. The mother and child were not seriously hurt. (July 10)."
		),*/

		4 => array(
			"id" => "-kjWBgA81LM",
			"name" => "African Lions Accept Man As One of Their Own",
			"desc" => "South African lion tamer Kevin Richardson doesn't fear his animals. He's developed a close relationship with the lions that allows him to interact with them as one of their own. (March 20)."
		),
		
		5 => array(
			"id" => "PFGmR99-D0k",
			"name" => "Ships Collide in Whaling Clash",
			"desc" => "A boat with anti-whaling activists collides with a Japanese whaling vessel in the Antarctic Ocean. No one was injured. Japan is condemning the clash, calling it unforgivable. (Feb. 6)"
		),

		6 => array(
			"id" => "yye4B2EgTCA",
			"name" => "Ice Bar Opens As New York City Swelters",
			"desc" => "After days of sweltering heat, New Yorkers are ready for a cooling off period. The opening of New York City's first ice bar is providing just that. (July 9)."
		),


	);

	function getNextVideo(){
		global $videos;
		$group = $watched = null;

		//if we have no cookie, return null
		if((!isset($_COOKIE["watched"])) || (!isset($_COOKIE["uid"])) || (!isset($_COOKIE["group"]))){
			return 0;
		}

		//get information in cookie
		$group = $_COOKIE["group"];
		$watched = $_COOKIE["watched"];

		//if watched is size of array, we have seen all of them!
		if($watched == count($videos)){
			return 1;
		}

		//calculate and return a video
		$id = (($group + $watched) % count($videos)) + 1;

		return $videos[$id];
	}
?>