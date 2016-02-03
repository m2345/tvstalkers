<?
/* Season code 
 * Ended = 0
 * Fall = 1 
 * Winter = 2
 * Spring = 3
 * Summer = 4
 * 
 * Times are eastern
 * 
 * All show info refers to the day and time
 * new epidodes are on
 * */
 /*
  * Shows:
  * 
  * Channel:
  * 
  * Homepage:
  * 
  * 
  * 
  * */
 
$data = array(
	"channels" => array(
		"commonLinks" => array("website");
		"news" => array("mainContent"),
	),
	"shows" => array(
		"pages" => array("threads", "posts"),
		"news" => array("newsExternalLinks", "newsSide", "newsMainContent"), 
		"commonLinks" => array("afterBuzz", "imbd", "wikipedia"),
		"newNewsLast" => "date",
	),
);
 
$channels = array(
	"ABC" => array(
		"channelInfo" = array(),
		"shows" => array(
			"Modern Family" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "W",
				"time" => "9:00",
			
			),
			"How to Get Away with Murder" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
				),
			"Nashville" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
				),
			"Greys Anatomy" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "Thurs",
				"time" => "8:00",
			),
			"Scandal" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "TH",
				"time" => "9:00",
			),
			"American Crime" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "w",
				"time" => "10:00",
			),
			"Castle" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "m",
				"time" => "10:00",
				
			),
			"Once upon a time" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "s",
				"time" => "8:00",
				"more" => "toAdd",
			),
			),
		),
	
	"CBS" => array(
		"channelInfo" => array(),
		"shows" => array(
			"NCIS" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "T",
				"time" => "8:00",
			),
			"NCIS LA" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "Monday",
				"time" => "10:00",
			),
			"NCIS New Orleans" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "T",
				"time" => "9:00",
			),
			"Person of Interest" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "T",
				"time" => "10:00",
			),
			"The Big Bang Theory" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "Th",
				"time" => "9:00",
			),
			"CSI Cyber" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "w",
				"time" => "10:00",
			
			),
 			"Elementary" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "th",
				"time" => "10:00",
				
 			),
			"Hawaii Five-0" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "f",
				"time" => "9:00",
			),
			"Criminal Minds" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "W",
				"time" => "9:00",
				"more" => "toAdd"
			),
			"Blue Bloods" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "f",
				"time" => "10:00",
			),
			"Scorpion" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "m",
				"time" => "9:00",
				"more" => "toAdd",
			),
			),
		),
	
	"NBC" => array(
		"channelInfo" => array(),
		"shows" => array(
			"Chicago PD" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "w",
				"time" => "10:00",
			),
			"Chicago Fire" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "T",
				"time" => "10:00",
			),
			"The Blacklist" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "th",
				"time" => "9:00",
			
			),
			"Allegiance" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			
			),
			"Law and Order: SVU" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "w",
				"time" => "9:00",
				"more" => "toAdd",
			),
			"The Slap" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
				"more" => "toAdd",
			),
			),
		),
	
	"ABC Family" => array(
		"channelInfo" => array(),
		"shows" => array(
			"The Fosters" => array(
				"avgLength" => 30,
				"seasonCode" => 24,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "m",
				"time" => "8:00",
			),
			"Switched at Birth" => array(
				"avgLength" => 30,
				"seasonCode" => 24,
				"nextNewEpisodeDate" => "0",
				"dayOfWeek" => "0",
				"time" => "0",
			),
			"Pretty Little Liars" => array(
			"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "t",
				"time" => "8:00",
				),
			"Chasing Life" => array(
				"avgLength" => 30,
				"seasonCode" => 24,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "m",
				"time" => "9:00",
			
			),
		),
	),
	
	"Syfy" => array(
		"channelInfo" => array(),
		"shows" => array(
			"Warehouse 13" => array(
				"avgLength" => 60,
				"seasonCode" => 0,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "0",
				"time" => "0",
			),
			"Face Off" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			),
			"Defiance" => array(
				"avgLength" => 30,
				"seasonCode" => 4,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			
			),
			"Helix" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			),
			"12 Monkeys" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "f",
				"time" => "9:00",
				"more" =>"toAdd",
			),
		),
	),
	
	"USA" => array(
		"channelInfo" => array(),
		"shows" => array(
			"Suits" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			),
			"Sirens" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			),
			"Royal Pains" => array(
				"avgLength" => 30,
				"seasonCode" => 123,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			),
			"Graceland" => array(
				"avgLength" => 30,
				"seasonCode" => 4,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			),
			"Burn Notice" => array(
				"avgLength" => 30,
				"seasonCode" => 0,
				"nextNewEpisodeDate" => "",
				"dayOfWeek" => "",
				"time" => "",
			),			
		),
	),
)


?>
