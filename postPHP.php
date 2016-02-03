<?
session_start();
function printPosts($array){
	echo "<ul class='posts post'>";
	for($i=0; $i<count($array); $i++){
		$message = $array[$i]['message'];
		$username = $array[$i]['username']; 
		$baseTime = $array[$i]['time'];
		
		$time = date('m-d-Y', strtotime($baseTime));

		$img = "http://tvstalkers.com/images/profiles/" .$array[$i]['image'];
		echo "<li><div class='post floatLeft'>
		<div class='posts post image profile'>
			<img src='$img' class='profileImg'/>
		</div></br>
		<div class='post posts author by username'>
			$username 
		</div>
			<div class='time date posts post dateTime'>$time</div>
			</div>
		<div class='posts post message floatRight'>
			$message
		</div>
		</br>
		
		</li>";
	}
	echo "</ul>";
}

function getExternLinks(){
	require('config.php');
	$threadId = $_GET['threadId'];
	$showId = getShowId($threadId);
	$sql = $connect->query("SELECT `showPageNetworkLink`, `facebookPageLink` FROM `shows` WHERE `id` = '$showId'");
	echo "<ul class='externLinks'>";
	while($row = $sql->fetch_object()){
		echo "<li><a href='>".$row->showPageNetworkLink."'>Network's Page</a></li>";
		echo "<li><a href='>".$row->facebookPageLink."'>Facebook Page</a></li>";
	}
	echo "</ul>";
}


function updateViewCount(){
	require('config2.php');
	$threadId = $_GET['threadId'];
//	$sql = $connect->query("UPDATE `topics` SET `viewCount`=(`viewCount`+1) WHERE `id` = '$threadId'");

	$sql = "UPDATE `topics` SET `viewCount`=(`viewCount`+1) WHERE `id` = :threadId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":threadId", $threadId);  //more flexible then bindValue;
	$stmt->execute();
}

function getShowLinks(){
	require('./config2.php');
	$threadId = $_GET['threadId'];
	$showId = getShowId($threadId);
	$channel = getChannelId($showId);
//
	$sql = "SELECT `name` FROM `shows` WHERE `channel_id` = :channelId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":channelId", $channel);  //more flexible then bindValue;
	echo "<ul class='sideNav'>";
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				$showName = $row['name'];
				//echo "<li><a href='http://tvstalkers.com/threads.php?showTitle=". $showName. "'>".$showName."</a></li>";
			?>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=$showName"><? echo $showName; ?></a></li>
			<?
			}
		}
	}
//
	echo "</ul>";
} 

function getTwitterInfo(){
	require('config2.php');
	$threadId = $_GET['threadId']; 
	//
			$sql = "SELECT `parentShow_id` FROM `topics` WHERE `id` = :threadId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":threadId", $threadId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				$threadId = $row['threadId'];
				$showId = $row->parentShow_id;
			}
		}
	}
	
	//
		
	if($sql1->num_rows > 0){
		$sql = "SELECT * FROM `shows` WHERE `id` = :showId LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":showId", $showId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				$id = $row['twitter_id'];
				$handle = $row['twitter_handle'];
			}
		}
	}
		
	}else {$handle = null; $id = null;}
		return array($handle, $id);
}

function createPost($message){
	require('config2.php');
	$username = $_SESSION['username'];
	$dateTime = date('Y-m-d h:i:s');
	$topicId = $_GET['threadId'];
	$showId = getShowId(strip_tags($topicId));
	$channelId = getChannelId($showId);
	$message = strip_tags($message);
	//pdo
	$sql = "INSERT INTO `posts` VALUES('', :channelId, :topicId, :showId, :username, :message, :dateTime)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":channelId", $channelId);  //more flexible then bindValue;
	$stmt->bindParam(":topicId", $topicId); 
	$stmt->bindParam(":username", $username); 
	$stmt->bindParam(":dateTime", $dateTime); 
	$stmt->bindParam(":message", $message); 
	$stmt->bindParam(":showId", $showId); 
	$stmt->execute();
}

function getShowId($threadId){
	require('config2.php');
	$sql = "SELECT `shows` . `id` FROM `shows`, `topics` WHERE `topics` . `id` = :threadId AND `topics` . `parentShow_id` = `shows` . `id` LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":threadId", $threadId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				return $row['id'];
			}
		}
	}
}

function getShowName($threadId){
	require('config2.php');
	$sql = "SELECT `shows` . `name` FROM `shows`, `topics` WHERE `topics` . `id` = :threadId AND `topics` . `parentShow_id` = `shows` . `id` LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":threadId", $threadId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				return $row['name'];
			}
		}
	}
}

/* USE PDO*/
function getChannelId($showId){
	require('config2.php');
	$sql = "SELECT `shows` . `channel_id` FROM `shows` WHERE `id` = :showId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":showId", $showId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				return $row['channel_id'];
			}
		}
	}
}

function getPosts($topicId){
	require('config.php');
	$postArray = array();
	$sql = $connect->query("SELECT `posts` . `id` FROM `posts` WHERE `posts` . `topicId` = '$topicId'");
	while($row = $sql->fetch_object()){
		$post = new post($row->id);
		array_push($postArray, array("message" => $post->getMessage(), "username" => $post->getUsername(), "time" => $post->getTime(), "image" => $post->getImage()));
	}
	return $postArray;
 } 

function getNewNews(){
	require('config.php');
	$articleArray = array();
	$threadId = $_GET['threadId'];
	$showId = getShowId($threadId);
	$sql = $connect->query("SELECT * FROM `content` WHERE `showId` = '$showId' ORDER BY `id` DESC LIMIT 5");
	while($rows = $sql->fetch_object()){
		$text = $rows->text;
		$date = date('m-d-Y', strtotime($rows->uploaded));
		if(!is_null($rows->videoLink)){
			echo "<article><header><h3 class='title'>".$rows->title."</h3></header><a href='".$rows->videoLink."'>Watch Here</a><footer class='date'><small>Published: " . $date . "</small></footer></article></br>";
		}else{
			echo "<aside>" ."<header><h3>".$rows->title."</h3></header>".$text . "</br><footer class='date'><small>Published: " . $date . "</small></footer></aside></br>";
		}
	}
	if($sql->num_rows == 0){
		echo "No new news";
	}
	return true;
}

function getNewLinks(){
	require('config.php');
	$articleArray = array();
	$threadId = $_GET['threadId'];
	$showId = getShowId($threadId);
	$sql = $connect->query("SELECT `text` FROM `content` WHERE `showId` = '$showId' AND `locationCode` = 'THP_SL_SHOWLINKS'");
	while($rows = $sql->fetch_object()){
		$text = $rows->text;
		echo "<aside>" .$text . "</aside></br>";
	}
	return true;
}

function getThreadTitle(){
	require('config2.php');
	$threadId = $_GET['threadId'];
	$sql = "SELECT `title` FROM `topics` WHERE `id` = :threadId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":threadId", $threadId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				$title= $row['title'];
			}
		}
	}
	echo $title;
}
?>
 
