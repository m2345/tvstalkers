<!DOCTYPE html>

<?php
	header('Content-Type: text/html; charset=utf8');
?>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="description" content="TV Stalker user's profile">
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="initial-scale=1.0,width=device-width">		
<title>My Profile</title>
</head>
<body>
<div id="wrapper">
	<h2>My Profile</h2>
	<div id="username"><? getUsername();?></div>
	<div id="email"><? getEmail(); ?><div id="changeEmail"></div></div>
	<div id="pic"><? getPic(); ?><div id="uploadNewPic"></div></div>
</div>
</body>

</html>
<?
class user{
	var $username;
	var $email;
	var $picUrl;
	var $profile;
	function __construct(){
		session_start();
		$this->username = $_SESSION['username'];
		$this->email = $this->getEmail($this->username);
		$this->picUrl = $this->getPic($this->username);
		$this->profile = $this->getProfile($this->username);
	}

	
	function getEmail($username){
		require('../config.php');
		$sql = $connect->query("SELECT `email` FROM `users` WHERE `username` = '$username'");
		if($sql->num_rows >0){
			while($row = $sql->fetch_object()){
				$email = $row->email;
			}
		}else $email = null;
		
		return $email;
	}

	function getProfile($username){
		require('../config.php');
		$sql = $connect->query("SELECT `profile` FROM `users` WHERE `username` = '$username'");
		if($sql->num_rows >0){
			while($row = $sql->fetch_object()){
				$profile = $row->profile;
			}
		}else $prfile = null;
		
		return $profile;
	}
	function getPic($username){
		require('../config.php');
		$sql = $connect->query("SELECT `picUrl` FROM `users` WHERE `username` = '$username'");
		if($sql->num_rows >0){
			while($row = $sql->fetch_object()){
				$picUrl = $row->pic;
			}
		}else $picUrl = null;
		
		return $picUrl;
	}
	
	function setEmail($username, $newEmail){
		require('../config.php');
		$sql = $connect->query("UPDATE `users` SET `email` = '$email' WHERE `username` = '$username'");
		if($sql->num_rows >0){ 
			while($row = $sql->fetch_object()){
				$email = $row->email;
			}
		}else $email = null;
		
		return $email;
	}

	function setProfile($username, $newProfile){
		require('../config.php');
		$sql = $connect->query("UPDATE `users` SET `profile` = '$profile' WHERE `username` = '$username'");
		if($sql->num_rows >0){
			while($row = $sql->fetch_object()){
				$profile = $row->profile;
			}
		}else $prfile = null;
		
		return $profile;
	}
	
	function setPic($username, $newPicUrl){
		require('../config.php');
		$sql = $connect->query("UPDATE `users` SET `pic` = '$newPicUrl' WHERE `username` = '$username'");
		if($sql->num_rows >0){ 
			while($row = $sql->fetch_object()){
				$picUrl = $row->pic;
			}
		}else $picUrl = null;
		
		return $picUrl;
	}
	
	
}
?>
