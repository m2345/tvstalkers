<?
function printThreads($array){
	echo "<ul class='threads'>";
		for($i =0; $i<count($array); $i++){
			$threadId = $array[$i]["threadId"];
			$title = $array[$i]["title"];
			$count = $array[$i]["count"];
			$viewCount = $array[$i]["viewCount"];
			echo "<li><div class='link thread'><a href='posts.php?threadId=$threadId'> $title</a></div><div class='thread count posts num'>Messages: $count Views: $viewCount</div></li>";
		}
		echo "</ul>";
}
/*
function getNews(){
	require('./config.php');
	$sql = $connect->query("SELECT * FROM `content` WHERE `channelId` = '200' order by `id` desc");
	while($row = $sql->fetch_object()){
		//get last breaking news -- will be on top of page. limit 1
		$text = $row->text;
		$date = date('m-d-Y', strtotime($rows->uploaded));
		echo "<article><header class='title'><h3 class='title'>".$row->title."</h3></header>".$text."</br><footer class='date'><small>Published: ". $date."</small></footer></article>";
	}
}*/

function getEmoticonList(){
	require('config.php');
	$emoticons = array();
	$sql = $connect->query("SELECT * FROM `emoticons`");
	while($rows = $sql->fetch_object()){
		array_push($emoticons, array($rows->searchString, $rows->imageUrl));
	}
	return $emoticons;
}
	
function loadTrendingThreads(){
	require('./config.php');
	$arrayToPrint = array();
	$emoticons = getEmoticonList();
	$sql = $connect->query("SELECT `id`, `title`, `viewCount`, `description`,(SELECT count(`posts` . `id`) FROM `posts` WHERE `topicId` = `topics` . `id`) AS `count` FROM `topics` ORDER BY `count` desc LIMIT 5");
	while($rows = $sql->fetch_object()){
		$title = $rows->title;
		$threadId = $rows->id;
		$count = $rows->count;
		$viewCount = $rows->viewCount;
		for($i=0; $i<count($emoticons); $i++){
			$search = $emoticons[$i][0]; 
			$img = "<img src='http://tvstalkers.com/images/" .$emoticons[$i][1]. "'></img>";
			$title = str_replace($search, $img, $title);
		}
		array_push($arrayToPrint, array('title' => $title, 'count' => $count, 'threadId' => $threadId, 'viewCount' => $viewCount));
	}
	printThreads($arrayToPrint);
}

function getTrendingNews(){
	require('./config.php');
	$sql = $connect->query("SELECT * FROM `content` ORDER BY `id` DESC LIMIT 5");
	while($rows = $sql->fetch_object()){
		echo "<article><header><h3 class='title'>".$rows->title."</h3></header>".$rows->text."</article></br>";
	}
}

?>
