<!DOCTYPE html>

<?php
	header('Content-Type: text/html; charset=utf8');
	session_start();  
?>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,width=device-width" >
	<!--<meta name="viewport" content="initial-scale=1.0,width=device-width" />-->
	<link rel="stylesheet" href="http://tvstalkers.com/css/nav2.css" type="text/css">
	<script src="http://tvstalkers.com/js/jquery1.11.js" type="text/javascript"></script>
	<script src="http://tvstalkers.com/loginJS.js" type="text/javascript"></script>
	<?php
	
	if(isset($_POST['login'])){
		require('./config2.php');
		$username = $_POST['username'];
		$password = md5(strip_tags(stripslashes($_POST['password'])));
		
		//pdo
		$sql = "SELECT `id` FROM `users` WHERE `username` = :username AND `password` = :password";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":username", $username);  //more flexible then bindValue;
		$stmt->bindParam(":password", $password); 
		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				$_SESSION['username'] = $username;
			}else echo "Invalid username or password";
		}
	}
	
function getToken($length = 20){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

?>

</head>
<body>
	<div id="nav">
	<header id="top_header">  
		<h1>TV Stalkers</h1>  
	</header>
	<nav id="top_menu">
		<ul id="nav_menu">
			<li><a href="http://tvstalkers.com">Home</a></li>
			<li class="item"><a href="http://tvstalkers.com/channels.php">Channels</a>
				<ul>
					<li class="sub_item"><a href="http://tvstalkers.com/syfy">Syfy</a>
						<ul>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Warehouse%2013">Warehouse 13</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Face%20Off">Faceoff</a></li>
						</ul>
					</li>
					<li class="sub_item"><a href="http://tvstalkers.com/abc">ABC</a>
						<ul>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Modern%20Family">Modern Family</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Nashville">Nashville</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Greys%20Anatomy">Greys Anatomy</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=How%20to%20Get%20Away%20with%20Murder">How to get Away with Murder</a></li>
						</ul>
					</li>
					<li class="sub_item"><a href="http://tvstalkers.com/cbs">CBS</a>
						<ul>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=NCIS">NCIS</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=NCIS%20LA">NCIS LA</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=NCIS%20New%20Orleans">NCIS New Orleans</a></li>
						</ul>
					</li>
					<li class="sub_item"><a href="http://tvstalkers.com/abc_family">ABC Family</a>
						<ul>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=The%20Fosters">The Fosters</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Switched%20at%20Birth">Switched at Birth</a></li>
						</ul>
					</li>
					<li class="sub_item"><a href="http://tvstalkers.com/nbc">NBC</a>
						<ul>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Chicago%20PD">Chicago PD</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Chicago%20Fire">Chicago Fire</a></li>
						</ul>
					</li>
					<li class="sub_item"><a href="http://tvstalkers.com/usa">USA Network</a>
						<ul>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Suits">Suits</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Sirens">Sirens</a></li>
							<li class="sub_sub_item"><a href="http://tvstalkers.com/threads.php?showTitle=Graceland">Graceland</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a href="http://tvstalkers.com/contact">Contact Us</a></li>
			
			<? if(!isset($_SESSION['username'])){?>
			
			<li class="login">
				<a>Login</a>
				<div id="showForm">
				<form action="#" method="POST">
					<input type="hidden" id="token" value="<? echo $_SESSION['token'];?>"/>
					<label>Username:</label><input type="text" name="username"/><input type="submit" value="Login" name="login"/><br>
					<label>&nbsp;&nbsp;&nbsp;Password:</label><input type="password" name="password"/><input type="button" onclick="window.location.href='http://tvstalkers.com/register';" value="Sign Up"/>
				</form>
				</div>
			</li>
			<? 
				//create token
				if(!isset($_SESSION['token']))
					$_SESSION['token'] = getToken();
			}else{?>
				<li><a href="http://tvstalkers.com/profile"><? echo $_SESSION['username']; ?></a>
					<ul>
						<li><a href="http://tvstalkers.com/logout.php">Logout</a></li>
					</ul>
				</li>
				<li class="nav small"><a href="http://tvstalkers.com/logout.php">Logout</a></li>
			<?	} ?>
		</ul>
		<div class="handle">Menu</div>
	</nav>
		
		</div>
<script>
	function register(){
		window.location.href = "http://tvstalkers.com/register";
	}
	
	$('.handle').on('click', function(){
		$('nav ul#nav_menu').toggleClass('showing');
	});
	
	/*function showForm(){
		$('#showForm').toggle();
	}*/
</script>
</body>
</html>
