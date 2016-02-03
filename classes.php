<?
/* 
 * get input of what show you want to view the 'page' of
 * get the show id and channel_id for that show
 * call getTopics
 * 
 * */

class show{
	var $showTitle;
	var $showChannel;
	var $threadId;
	var $postId;
	
	function __construct($threadId, $postId){
		$this->threadId = $threadId;
		$this->postId = $postId;
	}
	
	
	function getTitleFromPostId(){
		require('config.php');
		$threadId = $this->threadId;
		$sql = $connect->query("SELECT `shows` . `name` FROM `shows` , `topics`, `posts` WHERE `posts` . `id` = '$postId' AND `shows` . `id` = `topics` . `parentShow_id` AND `posts` .`topicId` = `topics` . `id`");
		while($row = $sql->fetch_object()){
			return $row->name;
		}
	}
}


class topic{
	var $topicId;
	function __construct($topicId){
		$this->topicId = $topicId;
	}
	
	function getPostCount(){
		require('config.php');
		$topicId = $this->topicId;
		$sql = $connect->query("SELECT count(`id`) AS `count` FROM `posts` WHERE `topicId` = '$topicId'");
		while($row = $sql->fetch_object()){
			return $row->count;
		}
	}
	
	function getViewCount(){
		require('config.php');
		$topicId = $this->topicId;
		$sql = $connect->query("SELECT `viewCount` FROM `topics` WHERE `id` = '$topicId'");
		while($row = $sql->fetch_object()){
			return $row->viewCount;
		}
	}
	
	function getChannelId($showName){
		require('config.php');
		/*$sql = $connect->query("SELECT `id` FROM `channels` WHERE `name` = '$showName'");
		while($row = $sql->fetch_object()){
			return $row->id;
		}*/
		$sql = "SELECT `id` FROM `channels` WHERE `name`=:showName";
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
	
	function getChannelIdFromShowName($showName){
		require('./config2.php');
		/*$sql = $connect->query("SELECT `channel_id` FROM `shows` WHERE `name`='$showName'");
		while($row = $sql->fetch_object()){
			return $row->channel_id;
		}*/
		$sql = "SELECT `channel_id` FROM `shows` WHERE `name`=:showName";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":showName", $showName);  //more flexible then bindValue;
		if($stmt){
			if($stmt->execute()){		
				while($row = $stmt->fetch()){
					return $row['channel_id'];
				}
			}
		}
	}
	
	
	function getShowId($showName){
		require('config2.php');
		$sql = "SELECT `id` FROM `shows` WHERE `name` = :showName";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":showName", $showName);  //more flexible then bindValue;
		if($stmt){
			if($stmt->execute()){		
				while($row = $stmt->fetch()){
					 return $row['id'];
					//echo "<li><a href='http://tvstalkers.com/threads.php?showTitle=". $showName. "'>".$showName."</a></li>";
				}
			}
		}
		/*$sql = $connect->query("SELECT `id` FROM `shows` WHERE `name` = '$showName'");
		while($row = $sql->fetch_object()){
			return $row->id;
		}*/
	}
	
	function getThreadId(){
		return $this->topicId;
	}
	
	function getEmoticonList(){
		require('config.php');
		$emoticons = array();
		$sql = $connect->query("SELECT * FROM `emoticons`");
		while($rows = $sql->fetch_object()){
			array_push($emoticons, array($rows->searchString, $rows->imageUrl));
		}
		return $emoticons;
	}
	
	function getTitle(){
		require('config.php');
		$topicId = $this->topicId;
		$emoticons = $this->getEmoticonList();
		$sql = $connect->query("SELECT `topics` . `title` FROM `topics` WHERE `topics` . `id` = '$topicId'");
		while($row = $sql->fetch_object()){
			$title = $row->title;
			for($i=0; $i<count($emoticons); $i++){
				$search = $emoticons[$i][0]; 
				$img = "<img src='http://localhost/site/images/" .$emoticons[$i][1]. "'></img>";
				$title = str_replace($search, $img, $title);
			}
			return $title;
		}
	}
	
	/* not in use */
	function getDescription(){
		require('config2.php');
		$topicId = $this->topicId;
			$sql = "SELECT `topics` . `description` FROM `topics` WHERE `topics` . `id` = :topicId";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":topicId", $topicId);  //more flexible then bindValue;
			if($stmt){
				if($stmt->execute()){		
					while($row = $stmt->fetch()){
						return $row['description'];
					}
				}
			}
		
		/*$sql = $connect->query("SELECT `topics` . `description` FROM `topics` WHERE `topics` . `id` = '$topicId'");
		while($row = $sql->fetch_object()){
			return $row->description;
		}*/
	}
	
	function getDateCreated(){
		require('config2.php');
		$topicId = $this->topicId;
		$sql = "SELECT `topics` . `dateCreated` FROM `topics` WHERE `topics` . `id` = :topicId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":topicId", $topicId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				return $row['dateCreated'];
			}
		}
	}
		/*$sql = $connect->query("SELECT `topics` . `dateCreated` FROM `topics` WHERE `topics` . `id` = '$topicId'");
		while($row = $sql->fetch_object()){
			return $row->dateCreated;
		}*/
	}
	
	function getCreator(){
		require('config.php');
		$topicId = $this->topicId;
		/*$sql = $connect->query("SELECT `topics` . `createdBy_id` FROM `topics` WHERE `topics` . `id` = '$topicId'");
		while($row = $sql->fetch_object()){
			return $row->createdBy_id;
		}*/
				$sql = "SELECT `topics` . `createdBy_id` FROM `topics` WHERE `topics` . `id` = :topicId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":topicId", $topicId);  //more flexible then bindValue;
	if($stmt){
		if($stmt->execute()){		
			while($row = $stmt->fetch()){
				return $row['createdBy_id'];
			}
		}
	}
	}
	
}

class post{
	var $postId;
	
	function __construct($postId){
		$this->postId = $postId;
	}

function getEmoticonList(){
		require('config.php');
		$emoticons = array();
		$sql = $connect->query("SELECT * FROM `emoticons`");
		while($rows = $sql->fetch_object()){
			array_push($emoticons, array($rows->searchString, $rows->imageUrl));
		}
		return $emoticons;
	}
	
			
	function getMessage(){
		require('config.php');
		$postId = $this->postId;
		$emoticons = $this->getEmoticonList();
		$sql = $connect->query("SELECT `posts` . `message` FROM `posts` WHERE `posts` . `id` = '$postId'");
		while($row = $sql->fetch_object()){
			$message = $row->message;
			for($i=0; $i<count($emoticons); $i++){
				$search = $emoticons[$i][0]; 
				$img = "<img src='http://localhost/site/images/" .$emoticons[$i][1]. "'></img>";
				$message = str_replace($search, $img, $message);
			}
			return $message;
		}
	}
	
	function getImage(){
		require('config.php');
		$user = $this->getUsername();
		$postId = $this->postId;
		$sql = $connect->query("SELECT `users` . `profile_url` FROM `users` WHERE `username` = '$user'");
		while($row = $sql->fetch_object()){
			return $row->profile_url;
		}
	}
	
	function getUsername(){
		require('config.php');
		$postId = $this->postId;
		$sql = $connect->query("SELECT `posts` . `username` FROM `posts` WHERE `posts` . `id` = '$postId'");
		while($row = $sql->fetch_object()){
			return $row->username;
		}
	}
	
	function getTime(){
		require('config.php');
		$postId = $this->postId;
		$sql = $connect->query("SELECT `posts` . `dateTime` FROM `posts` WHERE `posts` . `id` = '$postId'");
		while($row = $sql->fetch_object()){
			return $row->dateTime;
		}
	}
}


?>
