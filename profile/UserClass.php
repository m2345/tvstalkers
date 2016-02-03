<?
class user{
	var $username;
	function __construct(){
		session_start();
		$this->username = $_SESSION['username'];
	}
	
	function getUsername(){
		return $this->username;
	}
	
	function getPassword(){
		require('../config.php');
		$username = $this->username;
		$sql = $connect->query("SELECT `password` FROM `users` WHERE `username` = '$username'" );
		while($row = $sql->fetch_object()){
			$password = $row->password;
		}
		return $password;
	}  
	
	function getEmail(){
		require('../config.php');
		$username = $this->username;
		$sql = $connect->query("SELECT `email` FROM `users` WHERE `username` = '$username'" );
		while($row = $sql->fetch_object()){
			$email = $row->email;
		}
		return $email;
	}
	
	function getAboutme(){
		require('../config.php');
		$username = $_SESSION['username'];//$this->username;
		$sql = $connect->query("SELECT `aboutMe` FROM `users` WHERE `username` = '$username'" );
		while($row = $sql->fetch_object()){
			$aboutMe = $row->aboutMe;
		}
		return $aboutMe;
	}
	
	function getImage(){
		require('../config.php');
		$username = $_SESSION['username'];//$this->username;
		$sql = $connect->query("SELECT `profile_url` FROM `users` WHERE `username` = '$username'" );
		while($row = $sql->fetch_object()){
			$fileName = $row->profile_url;
		}
		return $fileName;
	}
	
	function setUsername($newUsername){
		require('../config.php');
		$username = $this->username;
		$newUsername = strip_tags(stripslashes($newUsername));
		$sql = $connect->query("UPDATE `users` SET `username` = '$newUsername' WHERE `username` = '$username'" );
		$_SESSION['username'] = $newUsername;
		$this->username = $newUsername;
		$this->setImage();
		return "Username changed";
	}
	
	function setPassword($newPassword){
		require('../config.php');
		$username = $this->username;
		$newPassword = md5(strip_tags(stripslashes($newPassword)));
		$sql = $connect->query("UPDATE `users` SET `password` = '$newPassword' WHERE `username` = '$username'" );
		return true;
	}
	
	function setEmail($newEmail){
		require('../config.php');
		$username = $this->username;
		$newEmail = strip_tags(stripslashes($newEmail));
		$sql = $connect->query("UPDATE `users` SET `email` = '$newEmail' WHERE `username` = '$username'" );
		if($sql)
			return "Your email address has been Changed";
		else return "An error occured while updating your email address";
	}
	
	function setAboutMe($aboutMe){
		require('../config.php');
		$username = $this->username;
		$aboutMe = strip_tags(stripslashes($aboutMe));
		$sql = $connect->query("UPDATE `users` SET `aboutMe` = '$aboutMe' WHERE `username` = '$username'" );
		if($sql)
			return "Your profile has been updated";
		else return "An error occured while updating your profile.";
	}
	//not needed as file name is the username
	//this function is called when a user changes their username
	//this needs to be updated incase of a future new user takes the old username and needs that name
	//as a profile pic
	function setImage(){
		//username has been previously updated to the newUsername
		require('../config.php');
		$username = $_SESSION['username'];//$this->username;
		//getFileExtension
		$img = $this->getImage();
		if($img != "user_default.png"){
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
			$newFileName = $username . "." . $ext;
			//Uppdate
			$sql = $connect->query("UPDATE `users` SET `profile_url` = '$newFileName' WHERE `username` = '$username'" );
		}
		return true;
	}
	
}

?>
