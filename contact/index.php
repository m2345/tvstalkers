<!DOCTYPE html>

<?php 
	header('Content-Type: text/html; charset=utf8');
	session_start();
?>
<html lang="en-US">
	<head>
	<title>Contact Us</title>
	<meta charset="utf-8">
	<meta name="description" content="Contact TV Stalkers.">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0,width=device-width" >	
	<link rel="stylesheet" href="../css/main_flex.css" type="text/css">
	<script src="../js/jquery1.11.js" type="text/javascript"></script>
	<script src="../js/json2.js" type="text/javascript"></script>
	<link rel="stylesheet" href=".//css/news.css" type="text/css">
	<link rel="stylesheet" href="../css/table.css" type="text/css">
	<link rel="stylesheet" href="../css/ulTable.css" type="text/css">
	<style>
	
	</style>
</head>
	<div id="indexNavBox">
<?php 
	include('../nav.php');
	
	?>
</div>
<?php
echo "<br>";

function getTrendingNews(){
	require('../config.php');
	$sql = $connect->query("SELECT * FROM `content` ORDER BY `id` DESC LIMIT 5");
	while($rows = $sql->fetch_object()){
		if(!is_null($rows->videoLink)){
			echo "<article><header><h3 class='title'>".$rows->title."</h3></header><a href='".$rows->videoLink."'>Watch Here</a></article><br>";
		}else{
			echo "<article><header><h3 class='title'>".$rows->title."</h3></header>".$rows->text."</article><br>";
		}
	}
}

function email($name, $email, $subject, $message){
	$name = htmlentities(strip_tags($name));
	$from = htmlentities(strip_tags($email));
	$subject = htmlentities(strip_tags($subject));
	$message = htmlentities(strip_tags($message)) . "\r\n From $name $from";
	$contactAdmin = 'contact@tvstalkers.com';
	$headers = 'From: contact@tvstalkers.com' . "\r\n" .
    "Reply-To: $from";
	mail($contactAdmin, $subject, $message, $headers);
}

function validateForm(){
	if(isset($_POST['token']) && ($_POST['token'] == $_SESSION['token'])){
		if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])){
			$name = $_POST['name'];
			$subject = $_POST['subject'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				email($name, $email, $subject, $message);
				echo "Your message has been sent. Thanks for contacting us.";
			}else{
				echo "Email address is not valid";
			}
		}else{
			echo "Please fill out all fields";
		}
	}else{
		echo "An Error Occured.  Please try again later.";
	}
}
?>

<body>
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<article>
			<h3 style="text-align:center; border-bottom: 2px solid black">News</h3>
			<? getTrendingNews();?>
		</article>
	</aside>
	<section id="main_section"><!-- meet of the website-->
		<header><h4>Contact Us</h4></header>
		<div id="result" style="color:red; font-size:1.3em;"><? if(isset($_POST['submit'])){ 
				validateForm();
			}?></div>
		<form action="#" method="POST">
			<input type="hidden" name="token" value="<? echo $_SESSION['token'];?>"/>
			Name: <input type="text" name="name"/><br>
			Email: <input type="email" name="email"/><br>
			Subject: <input type="text" name="subject"/><br>
			Message: <br><textarea rows=10 cols=20 name="message"></textarea>
			<input type="submit" name="submit" value="Submit"/>
		</form>
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

