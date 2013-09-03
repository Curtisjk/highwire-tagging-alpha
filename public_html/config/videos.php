<?php

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
		),

		array(
			"id" => "U82Xc0Oedmw",
			"name" => "FDA Proposes New Rule for Arsenic in Apple Juice",
			"desc" => "The Food and Drug Administration says the level of arsenic acceptable in apple juice should be the same as that allowed in drinking water. The agency says apple juice has always been safe to drink, but it's hoping to further limit exposure. (July 12)."
		),


		array(
			"id" => "-kjWBgA81LM",
			"name" => "African Lions Accept Man As One of Their Own",
			"desc" => "South African lion tamer Kevin Richardson doesn't fear his animals. He's developed a close relationship with the lions that allows him to interact with them as one of their own. (March 20)."
		),
		
		array(
			"id" => "PFGmR99-D0k",
			"name" => "Ships Collide in Whaling Clash",
			"desc" => "A boat with anti-whaling activists collides with a Japanese whaling vessel in the Antarctic Ocean. No one was injured. Japan is condemning the clash, calling it unforgivable. (Feb. 6)"
		),

		array(
			"id" => "yye4B2EgTCA",
			"name" => "Ice Bar Opens As New York City Swelters",
			"desc" => "After days of sweltering heat, New Yorkers are ready for a cooling off period. The opening of New York City's first ice bar is providing just that. (July 9)."
		),


	);

/* ------------------------------- DO NOT EDIT BELOW THIS LINE ------------------------------- */

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
		$id = (($group + $watched) % count($videos));

		return $videos[$id];
	}
?>