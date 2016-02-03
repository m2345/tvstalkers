<?
function getNews(){
	require('../config.php');
	//$sql = $connect->query("SELECT `title`, `text` FROM `content` WHERE `pageId`=". PAGE . " ORDER BY `id` DESC");
	//channel/page id that are three digits are for threads and posts, and nav, homepage
	//PAGE == CHANNEL
	$sql = $connect->query("SELECT `title`, `text` FROM `content` WHERE `channelId`=". PAGE . " ORDER BY `id` DESC");
	while($rows = $sql->fetch_object()){
		echo "<article><header class='title'><h3 class='title'>".$rows->title."</h3></header>".$rows->text."</article>";
	}
	getTrendingNews();
}

function getShowIdsFromChannel(){
	require('../config.php');
	$ids = array();
	$sql = $connect->query("SELECT `id` FROM `shows` WHERE `channel_id` =" . CHANNEL);
	while($rows = $sql->fetch_object()){
		array_push($ids, $rows->id);
	}
	return $ids;
}

function getTrendingNews(){
	require('../config.php');
	// get showId of shows on this CHANNEL
	$showIds = implode("','" , getShowIdsFromChannel());
	$sql = $connect->query("SELECT `title`, `text` FROM `content` WHERE `showId` IN ('". $showIds . "') ORDER BY `id` DESC");
	while($rows = $sql->fetch_object()){
		echo "<article><header class='title'><h3 class='title'>".$rows->title."</h3></header>".$rows->text."</article>";
	}
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

function loadTrendingThreads(){
	require('../config.php');
	require('../classes.php');
	$arrayToPrint = array();
	$emoticons = getEmoticonList();
	$sql = $connect->query("SELECT `id`, `title`, `viewCount`, `description`,(SELECT count(`posts` . `id`) FROM `posts` WHERE `topicId` = `topics` . `id`) AS `count` FROM `topics` WHERE `parentChannel_id` = " .CHANNEL. " ORDER BY `count` desc");
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



function printThreads($array){
		echo "<ul class='threads'>";
			for($i =0; $i<count($array); $i++){
				$threadId = $array[$i]["threadId"];
			?>	
			<li><div class="link thread"><a href='http://tvstalkers.com/posts.php?threadId=<? echo $threadId; ?>'> <? echo $array[$i]["title"]; ?></a></div><div class="thread count posts num">Messages: <? echo $array[$i]["count"]; ?> Views <? echo $array[$i]['viewCount']?></div></li>
			<?
			}
		echo "</ul>";
}



function getShowLinks(){
	require('../config.php');
	$sql = $connect->query("SELECT * FROM `shows` WHERE `channel_id` = " . CHANNEL .";");
	echo "<ul class='sideNav'>";
	while($rows = $sql->fetch_object()){
		$showName = $rows->name;
		echo "<li><a href='http://tvstalkers.com/threads.php?showTitle=". $showName. "'>".$showName."</a></li>";
	}
	echo "</ul>";
} 


?>
