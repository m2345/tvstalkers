<!DOCTYPE html>

<html lang="en-US">
	<head>
	<title>Thread</title>
	<meta charset="utf-8">
	<meta name="description" content="News and discussions about shows playing on ABC Family.">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">	
	<link rel="stylesheet" href="../css/main_flex.css" type="text/css">
	<link rel="stylesheet" href="../css/channelGuide.css" type="text/css">
	<script src="../jquery1.11.js" type="text/javascript"></script>
	<script src="../js/json2.js" type="text/javascript"></script>
	<script src="./js2.js" type="text/javascript"></script>
	<script src="http://tvstalkers.com/includes/analyticstracking.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../css/news.css" type="text/css">
	<link rel="stylesheet" href="../css/ulTable.css" type="text/css">
	<link rel="stylesheet" href="../css/table.css" type="text/css">
</head>
	<div id="indexNavBox">
<? 
	header('Content-Type: text/html; charset=utf8');
	include('../nav.php');
	include('../channel.php');
	//define(PAGE, 7);
	define(PAGE, 10);
	define(CHANNEL, 10);
	?>
</div>
<?
echo "<br>";
?>
<body>
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<div>Tv show list and links</div>
		<div class="showLinks"><? getShowLinks(); ?></div>
		<div id="tvGuide">
		Loading Guide...
		</div>
		<div class="ad" style="width:100%;">
		
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
	<section id="main_section"><!-- meet of the website-->
		<article class="trendingThreads trending threads topics abc_family article">
			<header><p class="channelHeader">Popular on the ABC Family forum</p></header>
			<div class="div trendingThreads trending threads topics abc_family">
			<? loadTrendingThreads();?>
			</div>
		</article>
		<article><header><p class="newsHeader">News</p></header>
		<? getNews();?>
		</article>
	</section>
	
	<aside id="trendingNow" class="sideRight side_news twitter feed trendingNow general"><!-- id was side_news-->
		<h3>ABC Family</h3>
		<div class="twitter">
		            <a class="twitter-timeline"  href="https://twitter.com/ABCFamily" data-widget-id="570625707353468928">Tweets by @ABCFamily</a>
            <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </div>
          <div class="ad" style="width: 15%">
          
          
          </div>
	</aside>
	</div> <!-- end new div-->
</div>
</body>
</html>
