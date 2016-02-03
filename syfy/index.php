<!DOCTYPE html>

<html lang="en-US">
	<title>Thread</title>
	<meta charset="utf-8">
	<meta name="description" content="News and discussions about shows playing on SYFY.">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">	
	<link rel="stylesheet" href="../css/main_flex.css" type="text/css">
	<link rel="stylesheet" href="../css/channelGuide.css" type="text/css">
	<script src="../js/jquery1.11.js" type="text/javascript"></script>
	<script src="../js/json2.js" type="text/javascript"></script>
	<script src="./js2.js" type="text/javascript"></script>
	<script src="http://tvstalkers.com/includes/analyticstracking.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../css/news.css" type="text/css">
	<link rel="stylesheet" href="../css/table.css" type="text/css">
	<link rel="stylesheet" href="../css/ulTable.css" type="text/css">
	<div id="indexNavBox">
<? 
	header('Content-Type: text/html; charset=utf8');
	include('../nav.php');
	include('../channel.php');
	//define(PAGE, 5);
	define(PAGE, 1);
	define(CHANNEL, 1);
	?>
</div>
<?
echo "<br>";
?>
	
</head>
<body>
	<div id="wrapper">
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<div>Tv show list and links</div>
		<div class="showLinks"><? getShowLinks(); ?></div>
		<div id="tvGuide">
		Loading Guide...
		</div>
		<div class="ad" style="width:100%;">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- resposnive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1890640262821073"
     data-ad-slot="5189403740"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	</div>
	</aside>
	<section id="main_section"><!-- meet of the website-->
		<article class="trendingThreads trending threads topics syfy article">
			<header><p class="channelHeader">Popular on the Syfy forum</p></header>
			<div class="div trendingThreads trending threads topics syfy">
			<? loadTrendingThreads();?>
			</div>
		</article>
		<article><header><p class="newsHeader">News</p></header>
		<? getNews();?>
		</article>
		
	</section>
	
	<aside id="trendingNow" class="sideRight side_news twitter feed trendingNow general"><!-- id was side_news-->
		<h3>Syfy feed</h3>
		<div class="twitter">
		            <a class="twitter-timeline"  href="https://twitter.com/Syfy" data-widget-id="570625339961782272">Tweets by @Syfy</a>
            <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </div>
          <div class="ad" style="width:100%">
          
          </div>
	</aside>
	</div> <!-- end new div-->
	</div>
</div>
</body>
</html>
