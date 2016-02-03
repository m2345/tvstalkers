<html>
<head>
<title>Admin Reports</title>
<meta charset="UTF-8"/>
<style>
table, th, td{
	border: 1px solid black;
	padding: 2px;
}
div.toggle{
	display:none;
}

td.green{
	background-color: green;
}

td.red{
	background-color:red;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<h3>Reports</h3>
	<div id="buttons">
		<button id="showChannelStatus">Info on each Channel</button>
		<button id="showChannelsAndShows">Channels and Shows</button>
		<button id="showsOnTonightButton">Tonight's Shows</button>
		<button id="showsOldNews">Get Shows To Update</button>
		<button id="activeShows">Get Shows With New Episodes </button>
		
	</div>
	<div id="channelStatus" class="toggle">
	<? $aToPrint = newReport(); ?>
	</div>
	<div id="channels" class="toggle">
		<? $channels = getChannels(); 
			for($i=0; $i < count($channels); $i++){
				$showList = getShowsByChannel($channels[$i]["id"]);
				echo "<h3>" .$channels[$i]["channelName"] . "</h3></br>";
				echo "<table><th>Show</th><th>Day</th><th>Time</th><th>Code</th>";
				for($j=0; $j < count($showList); $j++){
					echo "<tr><td>" . $showList[$j]["name"] . "</td>";
					echo "<td>" . $showList[$j]["dayOfWeek"] . "</td>";
					echo "<td>" . $showList[$j]["time"] . "</td>";
					echo "<td>" . $showList[$j]["seasonCode"] . "</td></tr>";
				} 
				echo "</table>";
			}
			
		?>
	</div></br></br>
	<div id="needsNewNews" class="toggle">
		<h3>Shows Not Recently Updated</h3>
		<?
			$needsUpdate = showsWithOldNews();
			for($i=0; $i < count($needsUpdate); $i++){
				echo $i+1 . ". $needsUpdate[$i]</br>";
			}
		?>
		
	
	
	</div>
	<div id="getActiveShows" class="toggle">
		<h3>Active Shows</h3>
		<? 
			$currentSeason = 3; //Sprint
			$activeShows = getActiveShows(3);
			echo "Number of Active Shows: " . count($activeShows) . "</br>";
			for($k=0; $k < count($activeShows); $k++){
				echo $k+1 . ". " . $activeShows[$k]["name"] . "</br>";
			}
		?>
	</div>
	<div id="showsOnTonight" class="toggle">
		<h3>Shows on Tonight</h3>
	<?
		$on = showsOnTonight();
		for($j=0; $j<count($on); $j++){
			echo $j+1 . ". $on[$j]</br>";
		}
	?>
	</div>
	
</body>
</html>


<?
function getChannels(){
	require('./config.php'); 
	$sql = $connect->query("SELECT `channelName`, `id` FROM `channels`");
	$channelArray = array();
	while($rows = $sql->fetch_object()){
		array_push($channelArray, array("channelName" => strtoupper($rows->channelName), "id" => $rows->id));
	}
	return $channelArray;
}


function getShowsByChannel($channelId){
	require('config.php');
	$sql = $connect->query("SELECT * FROM `shows` WHERE `channel_id` = '$channelId'");
	$showInfo = array();
	while($rows = $sql->fetch_object()){
		$name = $rows->name;
		$newEpisodes = $rows->newEpisodes; //bool
		$inSyndication = $rows->inSyndication; //bool
		$afterBuzz = $rows->afterBuzz;//bool
		$dayOfWeek = strtoupper($rows->dayOfWeek);
		$time = $rows->time;
		$seasonCode = $rows->seasonCode;
		array_push($showInfo, array("name" => $name, "newEp" => $newEpisodes,"inSynd" => $inSyndication, "afterbuzz" => $afterBuzz,'dayOfWeek' => $dayOfWeek, 'time' => $time, "seasonCode" => $seasonCode));
	}
	return $showInfo;
}


function getActiveShows($currentSeason){
	if(empty($currentSeason))
		$currentSeason = "1";
	require('./config.php');
	$showInfo = array();
	$sql = $connect->query("SELECT * FROM `shows` WHERE `seasonCode`LIKE '%$currentSeason%'");	
	if($sql->num_rows > 0){
		while($rows = $sql->fetch_object()){
			$newEpisodes = $rows->newEpisodes; //bool
			$inSyndication = $rows->inSyndication; //bool
			$afterBuzz = $rows->afterBuzz;//bool
			$dayOfWeek = $rows->dayOfWeek;
			$time = $rows->time;
			$seasonCode = $rows->seasonCode;
			$name = $rows->name;
			array_push($showInfo, array("name" => $name, "newEp" => $newEpisodes,"inSynd" => $inSyndication, "afterbuzz" => $afterBuzz,'dayOfWeek' => $dayOfWeek, 'time' => $time, "seasonCode" => $seasonCode));
		}
		return $showInfo;
	}else{
		return "No results";
	}

}


function showsWithOldNews(){
	require('./config.php');
	$return = array();
	$sql = $connect->query("SELECT `shows` . `name` FROM `shows` ORDER BY `lastNewsUpdate` DESC LIMIT 5");
	while($rows = $sql->fetch_object()){
		array_push($return, $rows->name);
	}
	return $return;
}

function showsOnTonight(){
	require('config.php');
	$return = array();
	$today = strtolower(date('D'));
	$sql = $connect->query("SELECT `shows` . `name` FROM `shows` WHERE `dayOfWeek` = '$today'");
	while($rows = $sql->fetch_object()){
 		array_push($return, $rows->name);
	}
	return $return;
}

/* Get Channels with no news and no threads */
function getBlankChannles(){
	require('config.php');
	$channelIdArray = getArrayOfChannelIds();

}


function getArrayOfChannelIds(){
	require('config.php');
	$return = array();
	$sql = $connect->query("SELECT `id` FROM `channels`");
	while($rows = $sql->fetch_object()){
		array_push($return, $rows->id);
	}
	return $return;
}
function getChannelName($id){
	require("config.php");
	$q = $connect->query("SELECT `channelName` FROM `channels` WHERE `id` = '$id'");
	while($row = $q->fetch_object()){
		return $row->channelName;
	}
	
	return false;
}
function newReport(){
	$ids = getArrayOfChannelIds();
	echo "<table><tr><th>Channels</th><th>News for Channel</th><th>Threads for Channel</th><th>News for shows on Channel</th></tr>";
	for($i=0; $i<count($ids); $i++){
		echo "<tr><td>" . getChannelName($ids[$i]) ."</td>";
		/* content with channel name present -- does not look at posts to thread and posts page */
		//News found For this channel
		if(checkForChannelNews($ids[$i])){
			echo "<td class='green'>YES</td>";
		}else{
			echo "<td class='red'>NO</td>";
		}
		
		//Thread found for this channel
		$showsForThisChannel = getShowIdsByChannel($ids[$i]);
		if(checkForChannelThreads($showsForThisChannel)){
			echo "<td class='green'>YES</td>";
		}else{
			echo "<td class='red'>NO</td>";
		}
		//News Found for a show on this channel
		$showsForThisChannel = getShowIdsByChannel($ids[$i]);
		if(checkForShowNews($showsForThisChannel)){
			echo "<td class='green'>YES</td>";
		}else{
			echo "<td class='red'>NO</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
		return true;
	}

function checkForChannelThreads($arrayOfShowIds){
	require('config.php');
	for($i=0; $i<count($arrayOfShowIds); $i++){
		$q = $connect->query("SELECT * FROM `topics` WHERE `parentShow_id` = '$arrayOfShowIds[$i]'");
		if($q->num_rows > 0)
			return true;  //news found		
	}
	return false;
}

function checkForChannelNews($channelId){
	require('config.php');
	$pageId = $channelId;//getPageIdOfChannel($channelId);
	//echo "</br>debug: CId = " . $channelId . " pageID = " . $pageId . "</br>";
	$q = $connect->query("SELECT * FROM `content` WHERE `channelId` = '$pageId'");
	if($q->num_rows > 0)
		return true;  //news found
	else return false;	
}
 
function getPageIdOfChannel($channelId){
	require('config.php');
	$q = $connect->query("SELECT `pageId` FROM `channels` WHERE `id` = '$channelId'");
	while($rows = $q->fetch_object()){
		return $rows->pageId;
	}
	return false;
}

function getShowIdsByChannel($channelId){
	require('config.php');
	$return = array();
	$q = $connect->query("SELECT `id` FROM `shows` WHERE `channel_id` = '$channelId'");
	while($rows = $q->fetch_object()){
		array_push($return, $rows->id);
	}
		return $return;
}


/* param is array of shows for current channel in loop
 * If first element is false then keep checking until something is found
 * exit once something is found
 * */

function checkForShowNews($arrayOfShowIds){
	require('config.php');
	for($i=0; $i<count($arrayOfShowIds); $i++){
		$q = $connect->query("SELECT * FROM `content` WHERE `showId` = '$arrayOfShowIds[$i]' ");
		if($q->num_rows > 0)
			return true;  //news found		
	}
	return false;
}


?>


<script>
	$( "#showChannelsAndShows" ).click(function() {
		$( "#channels" ).toggle( "slow", function() {
		// Animation complete.
		});
	});
			
	$( "#showsOnTonightButton" ).click(function() {
		$( "#showsOnTonight" ).toggle( "slow", function() {
		// Animation complete.
		});
	});
	
	$( "#showsOldNews" ).click(function() {
		$( "#needsNewNews" ).toggle( "slow", function() {
			// Animation complete.
		});
	});
			
	$( "#activeShows" ).click(function() {
		$( "#getActiveShows" ).toggle( "slow", function() {
			// Animation complete.
		});
	});
		
	$( "#showChannelStatus" ).click(function() {
		$( "#channelStatus" ).toggle( "slow", function() {
			// Animation complete.
		});
	});
	
	
	</script>
