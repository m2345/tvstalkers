<?
session_start();
function printThreads($array){
	if(getShowId($_GET['showTitle']) > 0){
		echo "<ul class='threads'>";
			for($i =0; $i<count($array); $i++){
				$threadId = $array[$i]["threadId"];
				$count = $array[$i]["count"];
				$title = $array[$i]["title"];
				$viewCount = $array[$i]["viewCount"];
			echo "<li><div class='link thread'><a href='./posts.php?threadId=$threadId'>$title</a></div><div class='thread count posts num'>Messages: $count Views: $viewCount</div></li>";
			}
		echo "</ul>";
	}
}	
	
	
function getNewNews(){
	require('config.php');
	$articleArray = array();
	$title = $_GET['showTitle'];
	$showId = getShowId($title);
	//$sql = $connect->query("SELECT * FROM `content` WHERE `showId` = '$showId' AND `locationCode` = 'THP_SL_INTHENEWS'");
	$sql = $connect->query("SELECT * FROM `content` WHERE `showId` = '$showId' ORDER BY `id` DESC LIMIT 5");
	while($rows = $sql->fetch_object()){
		$text = $rows->text;
		$date = date('m-d-Y', strtotime($rows->uploaded));
		if(!is_null($rows->videoLink)){
			echo "<article><header><h3 class='title'>".$rows->title."</h3></header><a href='".$rows->videoLink."'>Watch Here</a></br><footer class='date'><small>Published: " . $date . "</small></footer></article></br>";
		}else{
			echo "<aside>" ."<header><h3>".$rows->title."</h3></header>".$text . "</br><footer class='date'><small>Published: " . $date . "</small></footer></aside></br>";
		}
	}
	if($sql->num_rows == 0){
		echo "No new news.";
	}
	return true;
}

function getShowLinks(){
	require('./config2.php');
	$showTitle = $_GET['showTitle'];
	$channel = getChannelId($showTitle);
	
	$sql = "SELECT `name` FROM `shows` WHERE `channel_id` = :channelId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":channelId", $channel);  //more flexible then bindValue;
	echo "<ul class='sideNav'>";
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				$showName = $row['name'];
				echo "<li><a href='http://tvstalkers.com/threads.php?showTitle=". $showName. "'>".$showName."</a></li>";
			}
		}
	}
} 



function getNewLinks(){
	require('config.php');
	$articleArray = array();
	$title = $_GET['showTitle'];
	$showId = getShowId($title);
	$sql = $connect->query("SELECT `text` FROM `content` WHERE `showId` = '$showId' AND `locationCode` = 'THP_SL_SHOWLINKS'");
	while($rows = $sql->fetch_object()){
		$text = $rows->text;
		echo "<aside>" .$text . "</aside></br>";
	}
	return true;
}
function getExternLinks(){
	require('config.php');
	$showName = $_GET['showTitle'];
	$showId = getShowId($showName);
	$sql = $connect->query("SELECT `showPageNetworkLink`, `facebookPageLink` FROM `shows` WHERE `id` = '$showId'");
	echo "<ul class='externLinks'>";
	while($row = $sql->fetch_object()){
		echo "<li><a href='>".$row->showPageNetworkLink."'>Network's Page</a></li>";
		echo "<li><a href='>".$row->facebookPageLink."'>Facebook Page</a></li>";
	}
	echo "</ul>";
}


/* USE PDO */
	function getChannelId($showName){
		require('config.php');
		$sql = $connect->query("SELECT `channel_id` FROM `shows` WHERE `name` = '$showName'");
		while($row = $sql->fetch_object()){
			return $row->channel_id;
		}
	}
	
	function createThread($title){
		require('config2.php');
		$showId = getShowId($_GET['showTitle']);
		$channelId = getChannelId($_GET['showTitle']);
		$title = strip_tags($title);
		$now = date('Y-m-d H:i:s');
		//$title = mysqli_real_escape_string($connect, $title);
		$username = $_SESSION['username'];
		//$sql = $connect->query("INSERT INTO `topics` values('', '$title', '$username', '$now', '', '$channelId', '$showId', '', '0')");
		//pdo
		$sql = "INSERT INTO `topics` values('', :title, :username, :now, '', :channelId, :showId, '', '0')";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":title", $title);  //more flexible then bindValue;
		$stmt->bindParam(":username", $username); 
		$stmt->bindParam(":now", $now); 
		$stmt->bindParam(":channelId", $channelId); 
		$stmt->bindParam(":showId", $showId); 
		$stmt->execute();
	}
	
	function getShowId($showName){
		require('config2.php');
	$sql = "SELECT `id` FROM `shows` WHERE `name` = :showName LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":showName", $showName);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				return $row['id'];
			}
		}
	}

	}
	
function getTopics($showId){
	require('config.php');
	$postArray = array();
	$sql = $connect->query("SELECT `topics` . `id` FROM `topics` WHERE `topics` . `parentShow_Id` = '$showId'");
	while($row = $sql->fetch_object()){
		$topics = new topic($row->id);
		array_push($postArray, array("threadId" => $topics->getThreadId(), "title" => $topics->getTitle(), "dateTime" => $topics->getDateCreated(), "by" => $topics->getCreator(), "count" => $topics->getPostCount(), "viewCount" => $topics->getViewCount()));
	}
	return $postArray;
 }
 
 
function getTwitterInfo(){
	require('config2.php');
	$id = null;
	$handle = null;
	$showName = $_GET['showTitle']; 
	$sql = "SELECT `twitter_id`, `twitter_handle` FROM `shows` WHERE `name` = :showName";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":showName", $showName);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){
			if($stmt->rowCount() > 0){		
				while($row = $stmt->fetch()){
					$id = $row['twitter_id'];
					$handle = $row['twitter_handle'];
				}
			}else {	
				$handle = null; $id = null;
			}
		}
		return array($handle, $id);
	}
}
?>
