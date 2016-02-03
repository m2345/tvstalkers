<html>
<head>
	<?
		require('./config.php');
		require('./security/index.php');
		
		$channels = array();
		$sql = $connect->query("SELECT `id`, `channelName` FROM `channels`");
		while($row = $sql->fetch_object()){
			array_push($channels, array($row->id, $row->channelName));
		}
		if(isset($_POST['delete'])){
			$name = $_POST['delete'];
			$sql = $connect->query("DELETE FROM `channels` WHERE `channelName` = '$name'");
			if($sql){
				echo $name . "was deleted successfully </br>";
			}
		}
		if(isset($_POST['newShow'])){
		$runTime ="";
		$newEpisodes = "";/* bool*/
		$inSyndication = "";/* bool */
		$afterbuzz = ""; /* bool*/
		$netowrkShowLink = "";
		$fanFic = ""; $youtubeLink = "";
		$facebookPage= "";
		
			$name = $_POST['newShow'];
			$channel = $_POST['channelList'];
			$twitter_id = $_POST['twitter_id'];
			$handle = $_POST['handle'];
		$dayOfWeek = $_POST['dayOfWeek'];
		$time = $_POST['time'];
			//
			if(isset($_POST['runTime']))
		$runTime = $_POST['runTime'];
			if(isset($_POST['newEpisodes']))
		$newEpisodes = $_POST['newEpisodes']; /* bool*/
			if(isset($_POST['inSyndication']))
		$inSyndication = $_POST['inSyndication']; /* bool */
			if(isset($_POST['afterbuzz']))
		$afterbuzz = $_POST['afterbuzz']; /* bool*/
			if(isset($_POST['netowrkShowLink']))
		$netowrkShowLink = $_POST['netowrkShowLink'];
			if(isset($_POST['seasonCode']))
		$seasonCode = $_POST['seasonCode'];
			if(isset($_POST['youtubeLink']))
		$youtubeLink = $_POST['youtubeLink'];
			if(isset($_POST['facebookPage']))
		$facebookPage = $_POST['facebookPage'];
		
			//
			
			if($channel != "-1" && !empty($name) && !empty($twitter_id) && !empty($handle)){
				if(!checkForNameDuplicate($name)){	
					$sql = $connect->query("INSERT INTO `shows` VALUES('', '$name', '$channel', '$handle', '$twitter_id', '$dayOfWeek', '$time', '$runTime', '$newEpisodes', '$inSyndication', '$afterbuzz', '$showPageNetworkLink', '$seasonCode', '$youtubePageLink', '$facebookPageLink', '')");
					if($sql){
						echo "$name  was added successfully";
					}else echo "Error Occured";
				}else{ //add to other table if passes validation
					if(!checkSecondaryTable($name, $channel)){
						require('classes.php');
						$classes = new topic();
						$mainChannel = $classes->getChannelIdFromShowName($name);
						if($mainChannel != $channel){
							$sql = $connect->query("INSERT INTO `secondaryChannels` VALUES('', '$name', '$mainChannel', '$channel')");
						if($sql)
							echo "success";
						else echo "error occured";
						}else echo "Show already exists on this channel";
					}else echo "show already exists on this channel";
				}
			}else{
				echo "Please fill out all fields";
			}
			
		}else if(isset($_POST['newChannel'])){
			$channelName = $_POST['newChannel'];
			if(!checkForChannelDuplicate($channelName)){
				$twitter_id = $_POST['twitter_id'];
				$handle = $_POST['handle'];
				//$pageId = $_POST['pageId'];
				$sql = $connect->query("INSERT INTO `channels` VALUES('', '$channelName', '', '$handle','$twitter_id', '')");
				echo "Channel added successfuly";
			}else{
				echo "Channel already exists";
			}
		}
		
		function checkForChannelDuplicate($channelName){
			require('config.php');
			$twitter_id = $_POST['twitter_id'];
			$handle = $_POST['handle'];
			$sql = $connect->query("SELECT `id` FROM `channels` WHERE `channelName` = '$channelName'");
			if($sql->num_rows > 0)
				return true;	 //duplicate found
			else return false; 	//ok
		}
		
		/*
		 * return true if need to put in secondaryChannels table
		 * return false if ok. 
		 * */
		function checkForNameDuplicate($showName){
				require('config.php');
			$sql = $connect->query("SELECT * FROM `shows` WHERE `name` = '$showName'");
			if($sql->num_rows > 0){
				return true; // duplicate - secondary table
			}else return false; //ok
		}
		
		function checkSecondaryTable($showName, $channelId){
				require('config.php');
			$sql = $connect->query("SELECT * FROM `secondaryChannels` WHERE `showName` = '$showName' AND `other_channel` = '$channelId'");
			if($sql->num_rows > 0){ 
				echo "show already exists on this channel";
				return true; // duplicate  - show error
			}else return false; //ok
		}
	?>
	<title>Admin</title>
	<meta charset="UTF-8"/>
</head>
<body>
	<h2>Add a Show</h2>
	<form id="addAShow" action="#" method="POST">
		Name*: <input type="text" name="newShow"/></br>
		
		Channel*: <select name="channelList">
					<option value='-1'>Choose Channel</option>
					<? for($i =0; $i< count($channels); $i++){
						$id = $channels[$i][0];
						$name = $channels[$i][1];
						echo "<option value='$id'>$name</option>";
						
						}?>
			</select></br>
		Twitter Hashtag (#): <input type="text" name="handle"/></br>
		Twitter Id:		<input type="text" name="twitter_id"/></br>
		Day of week <input type="text" name="dayOfWeek"></br>
		Time <input type="text" name="time"/></br>
		runTime*: <input type="number" name="runTime"/></br>
		New Episdoes (bool)?*: <input type="number" name="newEpisodes"/></br>
		In Syndication (bool)?: <input type="number" name="inSyndication"/></br>
		AfterBuzz Conversation (bool)?: <input type="number" name="afterbuzz"/></br>
		Network's Show Page Link: <input type="text" name="netowrkShowLink"/></br>
		Season Code*: <input type="text" name="seasonCode"/></br>
		Youtube Link: <input type="text" name="youtubeLink"/></br>
		Facebook Page: <input type="text" name="facebookPage"/></br>
					<input type="submit" value="save" name="saveShow"/></br>
	</form>
	<h2>Add a channel</h2>
	<p> Ned to create page first page id needed to link tables. </p>
	<form id="addAChannel" action="#" method="POST">
		<select>
			<option>Current Channels</option>
			<? $sql = $connect->query("SELECT `channelName` FROM `channels`"); 
				while($r = $sql->fetch_object()){
					echo "<option>" . $r->channelName . "</option>";
				}
			?>
		</select></br>
		Channel Name: <input type="text" name="newChannel"/></br>
		<!--Page Id: <input type="text" name="pageId"/></br>-->
		Twitter Id: <input type="text" name="twitter_id"/></br>
		Twitter Handle (@): <input type="text" name="handle"/></br>
		<input type="submit" value="save" name="saveChannel"/>
	</form>
		<h2>Delete a Channel</h2>
	<form id="addAChannel" action="#" method="POST">
	Select a Channel:	<select name="delete">
			<option>Current Channels</option>
			<? $sql = $connect->query("SELECT `channelName` FROM `channels`"); 
				while($r = $sql->fetch_object()){
					echo "<option value='". $r->channelName."'>" . $r->channelName . "</option>";
				}
			?>
		</select></br>
		<input type="submit" value="Delete" name="saveChannel"/>
	</form>
</body>
</html>
