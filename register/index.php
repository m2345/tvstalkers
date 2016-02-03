<!DOCTYPE html>

<? 
	header('Content-Type: text/html; charset=utf8');
	session_start(); 
?>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Register | TV Stalkers</title>
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">	
	<meta name="description" content="Register to talk about your favorite shows">
	<?
	$message = "Errors: ";
	if(isset($_POST['register']) && $_SESSION['token'] == $_POST['token']){
		$username = $_POST['username'];
		$errorCount = 0;
		$password = md5(strip_tags(stripslashes($_POST['password'])));
		$confirm = md5(strip_tags(stripslashes($_POST['confirm'])));
		$email = $_POST['email'];
		
		//validate username must be unique
			if(!validateUsername($username)){
				$message = $message . "Username already used, please try another one.";
				$errorCount++;
			}
		
		//validate password
			//must be 8 characters long
		if(!validatePassword($_POST['password'])){
			$message =  $message . " Password must be atleast 8 characters long<br>";
			$errorCount++;
		}
			
		if($password != $confirm){
			$message = $message . "Passwords do not match<br>";
			$errorCount++;
		}
			//passwords must match
		
		//validate email address
		if(!validateEmail($email)){
			$message = $message . "Email is invalid<br>";
			$errorCount++;
		}
		
		if(!validateUnEmail($email)){
			$message = $message . "You already have an account<br>";
			$errorCount++;
		}
		
		//
		$fileName = $_FILES['profile_pic']['name'];
		//$size = $_FILES['profile_pic']['size'];
		$type = $_FILES['profile_pic']['type'];
		$temp_name = $_FILES['profile_pic']['tmp_name'];
		//$error = $_FILES['profile_pic']['error'];


//
	$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
//
		if(isset($fileName)){
			if(!empty($fileName)){
				if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif"){
				$location = '../images/profiles/';
					if(move_uploaded_file($temp_name, $location . $username . '.' . $ext)){
						$fileName = $username . "." . $ext;
					}else $fileName = "user_default.png";
				}else{
					$errorCount++;
					$message .= "Please upload an image file (.png, .jpg, .jpeg, or .gif)";
				} // added brackets
			}else
				 $fileName = "user_default.png";
		}
		
		//
	}
	
	function validateUsername($username){
		require('../config2.php');
		//$username = strip_tags($username);
		$sql = "SELECT `id` FROM `users` WHERE `username` = :username";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":username", $username);  //more flexible then bindValue;
		if($stmt->execute()){
			if($stmt->rowCount() == 0){
				return true;
			}else return false;
		}
	/*	require('../config.php');
		$sql = $connect->query("SELECT `id` FROM `users` WHERE `username` = '$username'");
		if($sql->num_rows > 0){
			return false;
		}
		else return true;*/
	}
	
	function validateEmail($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
		
	}
	
	function validateUnEmail($email){
		require('../config2.php');
		$sql = "SELECT `id` FROM `users` WHERE `email` = :email";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":email", $email);  //more flexible then bindValue;
		if($stmt->execute()){
			if($stmt->rowCount() == 0){
				return true;
			}else return false;
		}
	}
	
	function validatePassword($password){
		if(strlen($password) >= 8){
			return true;
		}else{
			return false; 
		}
	}
	
	?>
		<script src="../js/jquery1.11.js"  type="text/javascript"></script>
		<script src="../js/json2.js"  type="text/javascript"></script>
		<link rel="stylesheet" href="../css/news.css" type="text/css">
		<link rel="stylesheet" href="../css/table.css" type="text/css">
		<link rel="stylesheet" href="../css/main_flex.css" type="text/css">
		<link rel="stylesheet" href="../css/guide.css" type="text/css">
		<link rel="stylesheet" href="../css/ulTable.css" type="text/css">
</head>
<div id="indexNavBox">
	<? 
	include('../nav.php');
	?>
</div>
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
		<div id="message">	
		<? 
	if(isset($_POST['register']) && $_SESSION['token'] == $_POST['token']){
		if($errorCount == 0){
			//register user
			$now = date('Y-m-d H:i:s');
			//require('../config.php');
			//$sql = $connect->query("INSERT INTO `users` VALUES('', '$username', '$password', '$email', '$now', '$fileName', '', '$now')");
			///
			require('../config2.php');
		$sql = "INSERT INTO `users` VALUES('', :username, :password, :email, :now, :fileName, '', :now)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":email", $email);   
		$stmt->bindParam(":username", $username); 
		$stmt->bindParam(":password", $password);//more flexible then bindValue;
		$stmt->bindParam(":now", $now); 
		$stmt->bindParam(":fileName", $fileName);
		
		/*if($stmt->execute()){
			if($stmt->rowCount() == 0){
				return true;
			}else return false;
		}*/
			 
			 ///
			
			$_SESSION['username'] = $username;
			$stmt->execute();
				if(!validateUsername($username)){  //If username taken then user added to DB successfully
					echo "Welcome! If you aren't redircted click <a href='http://tvstalkers.com'>Here</a>";
				}else echo "An error occured. Please try again later."; 
			
		}else{
			echo $message;
		}
	}else{}
		?>
	</div>
	<form action="#" method="POST" enctype="multipart/form-data">
		<h2>Register</h2>
		<input type="hidden" name="token" value="<? echo $_SESSION['token'];?>"/>
		Username:<br>
		<input type="text" name="username"/><br>
		Password:<br>
		<input type="password" name="password"/><br>
		Confirm password:<br>
		<input type="password" name="confirm"/><br>
		Email:<br>
		<input type="email" name="email"/><br>
		
	<br><br>
	*The following are optional<br>
	Profile:
	<textarea name="profile"></textarea><br>
	Profile Image:<br>
	<input type="file" name="profile_pic"z/><br>
	<input type="submit" value="Register" name="register"/>
	</form>

	</section>
	
	<aside id="trendingNow" class="about sideRight side_news general"><!-- id was side_news-->
	<h2>About</h2>
	<p>This site is for TV and Entertainment freaks.  Post on our forum and get the latest nw</p>
	</aside>
	</div> <!-- end new div-->
	</div>
	<footer id="footer">Copyright 2015</footer>
	
</body>
</html>
