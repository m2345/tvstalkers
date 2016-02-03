<!DOCTYPE html>

<?php
	header('Content-Type: text/html; charset=utf8');
	session_start(); 
?>
<html lang="en-US">
	<head>
	<title>My Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">	
	<meta name="description" content="TV Stalker User's profile">
	<link rel="stylesheet" href="../css/main_flex.css" type="text/css">
	<link rel="stylesheet" href="../css/channelGuide.css" type="text/css">
	<script src="../js/jquery1.11.js"  type="text/javascript"></script>
	<link rel="stylesheet" href="../css/news.css" type="text/css">
	<link rel="stylesheet" href="../css/table.css" type="text/css">
	<link rel="stylesheet" href="../css/ulTable.css" type="text/css"> 
</head>
	
	<div id="indexNavBox">
<?php 
	include_once('./UserClass.php');	
	include('../nav.php');
	require('../config.php');
	$user = new user();
	
	function validateUsername($newUsername){
		require('../config.php');
		$sql = $connect->query("SELECT `id`	FROM `users` WHERE `username` = '$newUsername'");
		if($sql->num_rows > 0){
			return false;  //invalid
		}  
		return true;  //valid; continue
	}
	//
	
		$fileName = $_FILES['profile_pic']['name'];
		//$size = $_FILES['profile_pic']['size'];
		$type = $_FILES['profile_pic']['type'];
		$temp_name = $_FILES['profile_pic']['tmp_name'];
		//$error = $_FILES['profile_pic']['error'];
	$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
	$username = $_SESSION['username'];
			if(!empty($fileName)){
				if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif"){
					$location = '../images/profiles/';
					//delete image if exists
					$newFilePath = $location. $username . "." . $ext;
					if(file_exists($newFilePath))
						unlink($newFilePath);
					
					if(move_uploaded_file($temp_name, $location . $username . '.' . $ext)){
						$fileName = $username . "." . $ext;
						$sql2 = $connect->query("UPDATE `users` SET `profile_url` = '$fileName'");
					}else $fileName = "user_default.png";
				}else
					echo "Please upload an image file (.png, .jpg, .jpeg, or .gif)";
			
		}
		
	?>
</div>
<?php
echo "<br>";
?>
<body>
<div id="new_div"> <!--part of felxible box model-->
	<aside id="main_side_left" class="sideLeft side_news"><!-- id was side_news-->
		<div class="channelLinks">
			<h3>Network Pages</h3>
			<br>
			<ul class="main sideNav buttons">
				<li><a href="../syfy">SyFy</a></li>
				<li><a href="../cbs">CBS</a></li>
				<li><a href="../nbc">NBC</a></li>
				<li><a href="../abc">ABC</a></li>
				<li><a href="../abc_family">ABC Family</a></li>
				<li><a href="../usa">USA</a></li>
			</ul>
		</div>
		
	</aside>
	<section id="main_section"><!-- meet of the website-->
		<div>
			<h3>My Info</h3>
			<div id="result" style="padding:5px; color:red">
			<?php
			if(isset($_POST['email'])){
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$result = $user->setEmail($_POST['email']);
			echo $result;
		}else echo "invalid email";
	}else if(isset($_POST['username'])){
		if(validateUsername($_POST['username'])){  //continue
			$res = $user->setUsername($_POST['username']);
			echo $res;
		}else echo "Username already taken.";
	}else if(isset($_POST['aboutMe'])){
		$res2 = $user->setAboutMe($_POST['aboutMe']);
		echo $res2;
	}
			?>
			</div>
			Username: <?php echo $user->getUsername(); ?> <br>
			Change Username:<br>
			<form action="#" method="POST">
				<input name="username" type="text"/>	
				<input type="submit" name="submitUsername" value="Save" />
			</form><br>
			Email: <? echo $user->getEmail();?> <br>
			Update Email:<br>
			<form action="#" method="POST">
				<input name="email" type="text"/>	
				<input type="submit" name="submitEmail" value="Save" />
			</form><br>
			About Me: <? $info = $user->getAboutMe(); ?> <br>
			Update About Me: <br>
			<form action="#" method="POST">
				<textarea name="aboutMe" type="text" cols=50 rows=5><? echo $info; ?></textarea><br>	
				<input type="submit" name="submitAboutMe" value="Save" />
			</form><br>
			Profile Picture: <br> 
				<div id="img">
					<? $img = $user->getImage();?>
					<img src="<? echo '../images/profiles/' . $img?>" style="width:150px; height:150px;"/>
				</div><br>
			Upload New Profile Picture: <br>
			<form action="#" method="POST" enctype="multipart/form-data">
				<input name="profile_pic" type="file"/><br>
				<input type="submit" name="submitImg" value="Upload" />
			</form>
			
		</div>
		
	</section>
	
	<aside id="trendingNow" class="about sideRight side_news twitter feed trendingNow general"><!-- id was side_news-->
		<h2>About</h2>
	<p>This site is for TV and Entertainment freaks.  Post on our forum and get the latest news</p>
	<div class="ad">
		Hi
	</div>
	</aside>
	</aside>
	</div> <!-- end new div-->
	
	<footer id="footer">Copyright 2015</footer>
</div>
</body>
</html>
