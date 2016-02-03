<!DOCTYPE html>

<?php 
	header('Content-Type: text/html; charset=utf8');
	session_start();
?>
<html lang="en-US">
	<div id="indexNavBox">
<?php
	require_once('./classes.php'); 
	include('./nav.php');
	include('./threadPHP.php');
	?>
</div>
<head>
	<title><?php echo $_GET['showTitle']; ?> | TV Stalkers</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">	
	<link rel="stylesheet" href="./css/main_flex.css" type="text/css">
	<link rel="stylesheet" href="./css/guide.css" type="text/css">
	<script src="./js/jquery1.11.js" type="text/javascript"></script>
	<script src="./js/json2.js" type="text/javascript"></script>
	<script src="http://tvstalkers.com/includes/analyticstracking.js" type="text/javascript"></script>
	<link rel="stylesheet" href="./css/news.css" type="text/css">
	<link rel="stylesheet" href="./css/table.css" type="text/css">
	<link rel="stylesheet" href="./css/ulTable.css" type="text/css">

</head>
<? 
	function outputErrors(){
		if(isset($_POST['title'])){
			if(empty($_POST['title'])){
				echo "Please fill out all fields. <br>";
			}else if($_POST['token'] != $_SESSION['token']){
				echo "There was an error processing the request. Please try again later.";
			}else{
				if(strlen($_POST['title']) > 70)
					echo "Title is too long.  Must be 70 characters or less";
				else
					createThread($_POST['title']);	
			}
		}
	}
echo "<br>";
?>
<body>
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<div class="showLinks"> 
			<?php 
				getShowLinks();
			 ?>
		</div>
		<div id="contExternalLinks">
			<h3>Links</h3>
			<?php getExternLinks();?>
		</div><br>
		<div id="channelLinks" class="inTheNews">
			<?php 
			getNewLinks(); 
			getNewNews();?>
		</div>
	</aside>
	<section id="main_section" class="absolute thread"><!-- meet of the website-->
		<header><div class="title"><?
echo  "<br>";
echo "<h1>".$_GET['showTitle']."</h1>";?>
</div>
</header>
		<article id="article1"> <!-- group similar information  -- articles can have headers and footers-->
		<?php if(getShowId($_GET['showTitle']) > -1){?>	
			<button id="showNewThread" class="buttonStyle">Add new thread</button><br> <? }
		else {echo "Show not found.  Please check the url address. "; }
			?>
			<div class="error" style="color:red; padding:5px;">
			<?php outputErrors();?>
			</div>
	<div id="newThread">
		<?php $currPage = $_GET['showTitle'];
			if(!isset($_SESSION['username'])){
				echo "You need to log in to post";
			}else{
		?>
		<form action="threads.php?showTitle=<? echo $currPage; ?>" method="POST">
		Title:<br>
		<input type="text" name="title" ><br>
		<input type="hidden" value="<? echo $_SESSION['token']; ?>" name="token"/>
		<input type="submit" class="buttonStyle" value="Submit">
		</form>
			<?php } ?>
		</article>
		<article id="article2"> <!-- group similar information  -- articles can have headers and footers-->
	<?php	
	if(isset($_GET['showTitle'])){
		$input = urldecode($_GET['showTitle']);
		$id = getShowId($input);
		$result = getTopics($id);
		if(count($result) == 0)
			echo "Be the first to start a thread.";
		else
			printThreads($result);
	}else{
		header('Location: error.php');
	}
	?>
</article>
	</section>
	
	<aside id="trendingNow" class="sideRight side_news twitter feed trendingNow general threads thread channelFeed"><!-- id was side_news-->
		<!-- More informaiton -- feeds ect-->
		<h4>What's trending?</h4>
		<?php $arr = getTwitterInfo();
			$handle = $arr[0];
			$twitter_id = $arr[1];
			if(is_null($handle) || is_null($twitter_id)){
			  echo "No twitter data found";
			  }else{?>
		           <a class="twitter-timeline"  href="<? echo $handle; ?>" data-widget-id="<? echo $twitter_id;?>">#<? echo $handle;?> Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
         <?php }?>
         <div class="ad">
         <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:inline-block;width:200px;height:250px"
     data-ad-client="ca-pub-1890640262821073"
     data-ad-slot="7418820142"></ins>
<script type="text/javascript">
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
         </div>
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
