<!DOCTYPE html>

<?php 
	header('Content-Type: text/html; charset=utf8');
	session_start(); 
	include('postPHP.php');
?>
<html lang="en-US">
<head>
	<title><?php getThreadTitle(); ?> | TV Stalkers</title>
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
	<script>
		function show(){
			document.getElementById("newPost").style.display = "block";
		}
	</script>
	<style type="text/css">
		div#newPost{
			display: none;
		}
	
		div.post img.profileImg{
			width:100%;
			heigth: auto;
		}
	
		div.floatLeft{
			width: 20%;
			float:left;
		}
		
		div.messsage.floatRight{
			width: 80%;
			float: right;
			overflow: auto;
			text-align:center;
		}
		
	textarea#message{
		width:100%;
	}
	</style>
</head>
	<div id="indexNavBox">
<?php
	require_once('classes.php'); 
	include('nav.php');
	
	
	?>
</div>
<?php 
if(isset($_POST['message'])){
	if(empty($_POST['message'])){
		echo "Please fill out all fields. <br>";
	}else if($_POST['token'] != $_SESSION['token']){
		echo "There was an error processing your request.  Please try again later";
	}else{
		createPost($_POST['message']);	
	}
}else{
	/* Update on first View. */
	updateViewCount();
}
echo "<br>";
?>
<body>
<div id="new_div" class="post posts"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news post posts"><!-- id was side_news-->
		<div class="showLinks"> 
			<?php 	getShowLinks(); ?>
		</div>
		<div id="contExternalLinks">
			<h3>Links</h3>
			<?php getExternLinks();?>
		</div><br>
		<br>
		<div id="channelLinks" class=" inTheNews links showLinks external post posts cybercms">
			<?php getNewLinks(); 
				 getNewNews();	?>
		</div>
	</aside>
	<section id="main_section" class="post posts"><!-- meet of the website-->
		<header><div class="title"><h1><? echo getShowName($_GET['threadId']) . " - "; getThreadTitle();?></h1></div></header>
		<article id="article1"> <!-- group similar information  -- articles can have headers and footers-->		
			<button onclick="show();" class="buttonStyle">Add New Post</button><br>
			<div id="newPost">
			<?php $currPage = $_GET['threadId'];
				if(!isset($_SESSION['username'])){
				echo "You need to log in to post";
			}else{  ?>
					<form action="posts.php?threadId=<? echo $currPage; ?>" method="POST">
					Message:<br>
					<textarea type="text" id="message" name="message" rows=5></textarea>
					<input type="hidden" value="<? echo $_SESSION['token']; ?>" name="token"/>
					<br><br>
					<input type="submit" class="buttonStyle" value="Submit">
					</form>	<? } ?>
			</div>
		</article>
		<article id="article2"> <!-- group similar information  -- articles can have headers and footers-->
	<?php
	if(isset($_GET['threadId'])){
		$postsFor = $_GET['threadId'];
	    $postResults = getPosts($postsFor); 
	    if(count($postResults) == 0)
			echo "Be the first to comment";
		else
			printPosts($postResults);	
	}else{
		echo "Error - no topic was selected";
	}	
	?>
</article>
	</section>
		<aside id="trendingNow" class="sideRight side_news twitter feed trendingNow general post posts channelFeed">
		<h4>What's Trending?</h4>
		<?php $arr = getTwitterInfo();
			$handle = $arr[0];
			$twitter_id = $arr[1]; 
			if(is_null($handle) || is_null($twitter_id)){
				echo "No twitter data found";
			}else{
			?>
		           <a class="twitter-timeline"  href="<?php echo $handle; ?>" data-widget-id="<? echo $twitter_id;?>">#<? echo $handle; ?> Tweets</a>
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
</body>
</html>
