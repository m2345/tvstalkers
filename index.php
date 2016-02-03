<!DOCTYPE html>
<html>
	<head lang="en-US">
		<title>TV Stalkers</title>
		<meta charset="UTF-8">
		<meta name="description" content="TV Stalkers. The place for news and discussions about your favorite shows">
		<!--<meta name="viewport" content="initial-scale=1.0,width=device-width" />-->
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1.0,width=device-width">
		<script src="./js/jquery1.11.js" type="text/javascript"></script>
		<script src="./js/json2.js" type="text/javascript"></script>
		<link rel="stylesheet" href="./css/news.css" type="text/css">
		<link rel="stylesheet" href="./css/table.css" type="text/css">
		<link rel="stylesheet" href="./css/main_flex.css" type="text/css">
		<link rel="stylesheet" href="./css/guide.css" type="text/css">
		<link rel="stylesheet" href="./css/ulTable.css" type="text/css">
		<script src="http://tvstalkers.com/includes/analyticstracking.js" type="text/javascript"></script>
		<style>
			.ad{
				width:  100%;
			}
			
		</style>
	</head>
	<div id="indexNavBox">
	<?php 
		header('Content-Type: text/html; charset=utf8');
		include('nav.php');
		include('indexPHP.php');
	?>
</div>
<?php echo "<br>"; ?>	
<body>
	<div id="wrapper">
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<div id="channelLinks">
			<h4>Network Pages</h4>
			<br>
			<ul class="main sideNav buttons">
				<li><a href="./syfy">SyFy</a></li>
				<li><a href="./cbs">CBS</a></li>
				<li><a href="./nbc">NBC</a></li>
				<li><a href="./abc">ABC</a></li>
				<li><a href="./abc_family">ABC Family</a></li>
				<li><a href="./usa">USA</a></li>
			</ul>
		</div>
		
	</aside>
	<section id="main_section" class="absoulte"><!-- meet of the website-->	
		<h3 style="text-align: center;">Welcome to TV Stalkers</h3>
	<? //getNews(); //caused an error?>
<article>
<? loadTrendingThreads();?>
</article>
<article>
	<header> <p class="newsHeader">News</p></header>
<? getTrendingNews();?>
</article>
	</section>
	
	<aside id="trendingNow" class="about sideRight side_news general"><!-- id was side_news-->
	<h2>About</h2>
	<p>This site is for TV and Entertainment freaks.  Post on our forum and get the latest news</p>
	<br>
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
	</div>
	</aside>
	</div> <!-- end new div-->
	</div>
	
</body>
</html>

