<!-- Print out list of threads -->

<? require_once('classes.php'); ?>

<div class="nav">
<?
	include('nav.php');
		
?>
	</div>
<?
	echo "</br>gdgedsw";
	if(isset($_POST['title'], $_POST['description'])){
		if(empty($_POST['title']) || empty($_POST['description'])){
			echo "Please fill out all fields. </br>";
		}else{
			createThread($_POST['title'], $_POST['description']);	
		}
	}


function printThreads($array){
	if(getShowId($_GET['showTitle']) > 0){
		echo "<table><th>Title</th><th>Description</th><th># of posts</th>";
		if(count($array)> 0){
			for($i =0; $i<count($array); $i++){
				$threadId = $array[$i]["threadId"];
			?>
			<tr><td><a href='posts.php?threadId=<? echo $threadId; ?>'> <? echo $array[$i]["title"]; ?></a></td><td><? echo $array[$i]["description"];?></td><td><? echo $array[$i]["count"]; ?></td></tr>
			<?
			}
		}else{
			echo "<tr><td>Be the first to create a topic</td></tr>";
		}
		echo "</table>";
	}
}

	function getChannelId($showName){
		require('config.php');
		$sql = $connect->query("SELECT `channel_id` FROM `shows` WHERE `name` = '$showName'");
		while($row = $sql->fetch_object()){
			return $row->channel_id;
		}
	}
	
	function createThread($title, $description){
		require('config.php');
		$showId = getShowId($_GET['showTitle']);
		$channelId = getChannelId($_GET['showTitle']);
		$sql = $connect->query("INSERT INTO `topics` values('', '$title', '$username', '$now', '$description', '$channelId', '$showId', '')");
	}

	function getShowId($showName){
		require('config.php');
		$sql = $connect->query("SELECT `id` FROM `shows` WHERE `name` = '$showName'");
		if($sql->num_rows < 1){
			return -1;
		}else{
			while($row = $sql->fetch_object()){
				return $row->id;
			}
		}
	}

echo "</br>";

function getTopics($showId){
	require('config.php');
	$postArray = array();
	$sql = $connect->query("SELECT `topics` . `id` FROM `topics` WHERE `topics` . `parentShow_Id` = '$showId'");
	while($row = $sql->fetch_object()){
		$topics = new topic($row->id);
		array_push($postArray, array("threadId" => $topics->getThreadId(), "title" => $topics->getTitle(), "description" => $topics->getDescription(), "dateTime" => $topics->getDateCreated(), "by" => $topics->getCreator(), "count" => $topics->getPostCount()));
	}
	return $postArray;
 }


function getTwitterInfo(){
	require('config.php');
	$showName = $_GET['showTitle']; 
	$sql = $connect->query("SELECT * FROM `shows` WHERE `name` = '$showName'");
		while($row = $sql->fetch_object()){
			$id = $row->twitter_id;
			$handle = $row->twitter_handle;
		}
	return array($handle, $id);
}
?>

<html>
<head>
	<title>Thread</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="main_flex.css"/>
	
<script src="./jquery1.11.js"></script>
	<script src="json2.js"></script>
	<script src="js.js"></script>
	<script src="other.js"></script>
</head>
<body>
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<div id="channelLinks">
			<a href="#">SyFy</a>
			<a href="#">CBS</a>
			<a href="#">Nickelodeon</a>
		</div>
		<div id="tvGuide">
			<div id="result_times">
				<div id="now"></div>
				<label id="title">What's on tonight (pacific time)</label>
				<table><th></th><th>8:00 pm</th><th>9:00 pm</th></table>
			</div>
		</div>
	</aside>
	<section id="main_section"><!-- meet of the website-->
		<header><div class="title"><?
echo  "</br>";
echo "<h1>".$_GET['showTitle']."</h1>";?>
</div>
</header>
		<article id="article1"> <!-- group similar information  -- articles can have headers and footers-->
		<? if(getShowId($_GET['showTitle']) > -1){?>	
			<button id="showNewThread">Add new thread</button></br> <? }
		else {echo "Show not found.  Please check the url address. "; }?>
	<div id="newThread">
		<? $currPage = $_GET['showTitle']?>
		<form action="threads.php?showTitle=<? echo $currPage?>" method="POST">
		Title:<br>
		<input type="text" name="title" ><br>
		Description:<br>
		<input type="text" name="description">
		<br><br>
		<input type="submit" value="Submit">
		</article>
		<article id="article2"> <!-- group similar information  -- articles can have headers and footers-->
	<?	
	if(isset($_GET['showTitle'])){
		$input = urldecode($_GET['showTitle']);
		$id = getShowId($input);
		$result = getTopics($id);
		printThreads($result);
	}else{
		header('Location: error.php');
	}
	?>
</article>
	</section>
	
	<aside id="trendingNow" class="sideRight side_news twitter feed trendingNow general"><!-- id was side_news-->
		<!-- More informaiton -- feeds ect-->
		<h4>News Story</h4>
		<? $arr = getTwitterInfo();
			//print_r($arr);
			$handle = $arr[0];
			$twitter_id = $arr[1];
			//$handle = "https://twitter.com/hashtag/ncis";
			//$twitter_id = "568598542432751616";
			?>
		           <a class="twitter-timeline"  href="<? echo $handle; ?>" data-widget-id="<? echo $twitter_id;?>">#ncis Tweets</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          
	</aside>
	</div> <!-- end new div-->
	
	<footer id="footer">Copyright 2015</footer>
</div>
</body>
</html>

<script>
$( "#showNewThread" ).click(function() {
	$( "#newThread" ).toggle( "slow", function() {
	});
});
</script>
