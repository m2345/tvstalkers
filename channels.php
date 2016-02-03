<!DOCTYPE html>

<html lang="en-US">
	<head lang="en-US">
	<title>Channels</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">	
	<link rel="stylesheet" href="./css/main_flex.css" type="text/css">
	<script src="./js/jquery1.11.js" type="text/javascript"></script>
	<script src="./js/json2.js" type="text/javascript"></script>
	<script src="http://tvstalkers.com/includes/analyticstracking.js" type="text/javascript"></script>
	<link rel="stylesheet" href="./css/news.css" type="text/css">
	<link rel="stylesheet" href="./css/table.css" type="text/css">
	<link rel="stylesheet" href="./css/ulTable.css" type="text/css">
	<style>
	ul.showsByChannel{
		list-style: none;
	}
	
	h2 a{
		color: black;
	}
	
	</style>
</head>
	<div id="indexNavBox">
<?php 
	header('Content-Type: text/html; charset=utf8');
	include('./nav.php');
?>
</div>
<?php
echo "<br>";

function getTrendingNews(){
	require('./config.php');
	$sql = $connect->query("SELECT * FROM `content` ORDER BY `id` DESC LIMIT 5");
	while($rows = $sql->fetch_object()){
		$date = date('m-d-Y', strtotime($rows->uploaded));
		if(!is_null($rows->videoLink)){
			echo "<article><header><h3 class='title'>".$rows->title."</h3></header><a href='".$rows->videoLink."'>Watch Here</a><br><footer class='date'><small>Published: " . $date . "</small></footer></article><br>";
		}else{
			echo "<article><header><h3 class='title'>".$rows->title."</h3></header>".$rows->text."<footer class='date'>Published: " .$date. "</footer></article><br>";
		}
	}
}
?>

<body>
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<article>
			<?php getTrendingNews();?>
		</article>
	</aside>
	<section id="main_section"><!-- meet of the website-->
		<h2>Channels and TV shows</h2>
		<article>
			<header><h2><a href="http://tvstalkers.com/syfy">Syfy</a></h2></header>
			<ul class="showsByChannel">
				<li><a href="http://tvstalkers.com/threads.php?showTitle=Face%20Off">Face Off</a></li>
				<li><a href="http://tvstalkers.com/threads.php?showTitle=Warehouse%2013">Warehouse 13</a></li>
				<li><a href="http://tvstalkers.com/threads.php?showTitle=Defiance">Defiance</a></li>
				<li><a href="http://tvstalkers.com/threads.php?showTitle=Helix">Helix</a></li>
			</ul>
		</article>
		<article>
			<header><h2><a href="http://tvstalkers.com/abc">ABC</a></h2></header>
			<ul class="showsByChannel">
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Modern%20Family">Modern Family</a></li>
			<li><a  href="http://tvstalkers.com/threads.php?showTitle=How%20to%20get%20Away%20with%20Murder">How to get Away with Murder</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Nashville">Nashville</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Greys%20Anatomy">Greys Anatomy</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Scandal">Scandal</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=American%20Crime">American Crime</a></li>
			</ul>
		</article>
		<article>
			<header><h2><a href="http://tvstalkers.com/abc_family">ABC Family</a></h2></header>
			<ul class="showsByChannel">
			<li><a href="http://tvstalkers.com/threads.php?showTitle=The%20Fosters">The Fosters</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Switched%20at%20Birth">Switched at Birth</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Pretty%20Little%20Liars">Pretty Little Liars</a></li>
			</ul>
		</article>
		<article>
			<header><h2><a href="http://tvstalkers.com/cbs">CBS</h2></a></header>
			<ul class="showsByChannel">
			<li><a href="http://tvstalkers.com/threads.php?showTitle=NCIS">NCIS</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=NCIS%20LA">NCIS LA</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=NCIS%20New%20Orleans">NCIS New Orleans</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Person%20of%20Interest">Person ofInterest</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=The%20Big%20Bang%20Theroy">The Big Bang Family</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=CSI%20Cyber">CSI Cyber</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Elementary">Elementary</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Hawaii%20Five-0">Hawaii Five-0</a></li>
			</ul>
		<article>
			<header><h2><a href="http://tvstalkers.com/nbc">NBC</a></h2></header>
			<ul class="showsByChannel">
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Chicago%20PD">Chicago PD</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Chicago%20Fire">Chicago Fire</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=The%20Blacklist">The Blacklist</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Allegiance">Allegiance</a></li>
			</ul>
		</article>
		<article>
			<header><h2><a href="http://tvstalkers.com/usa">USA</a></h2></header>
			<ul class="showsByChannel"/>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Suits">Suits</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Sirens">Sirens</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Royal%20Pains">Royal Pains</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Graceland">Graceland</a></li>
			<li><a href="http://tvstalkers.com/threads.php?showTitle=Burn%20Notice">Burn Notice</a></li>
			</ul>
		</article>
	</section>
	<!-- twitter causes the center div not to move -->
<aside id="trendingNow" class="about sideRight side_news general"><!-- id was side_news-->
	<h2>About</h2>
	<p>This site is for TV and Entertainment freaks.  Post on our forum and get the latest nw</p>
</aside>
	</div> <!-- end new div-->
	
	<footer id="footer">Copyright 2015</footer>
</div>
</body>
</html>
