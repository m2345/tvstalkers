<!DOCTYPE HTML>
<html>
<head>
<title>CMS | TV Stalkers</title>
<meta charset="UTF-8"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style>
select#more, select#divToChange{
	display:none;
}
</style>
<script type="text/javascript" src="./mce/tinymce/js/tinymce/tinymce.min.js"></script>
</head>
<? require('../config.php');
require('../security/index.php');
error_reporting(-1);

//if(isset($_POST['savePage'], $_POST['selectPage'], $_POST['more'], $_POST['divToChange'], $_POST['text'])){
if(isset($_POST['savePage'])){	
	$pageId = $_POST['selectPage']; /* page Id*/
	$showId = $_POST['more'];/* show Id */
	//$location = $_POST['divToChange']; /* Location Code */
	$newArticle = $_POST['text'];
	$title = $_POST['title'];
	$link = $_POST['videoLink'];
	$now = date('Y-m-d H:i:s');
	//	if($pageId != -1 && $location != -1){
	$sqlsql = $connect->query("INSERT INTO `content` VALUES('', '',' $pageId','$showId','$newArticle', '$title','$now', '$link')") or mysql_error();
	if($sqlsql){
		echo "added added!!</br>";
		//update show db
		$sql2 = $connect->query("UPDATE `shows` SET `lastNewsUpdate` = '$now'");
	}
	else echo "</br>An erro has occured</br>" . $sqlsql;
} 
?>

<body>
<div>
	<!--
	<h4>Add A Page</h4>
	<form action="#" method="POST">
		page name: <input type="text" name="pageName"/></br>
		url: <input type="text" name="url"/></br>
		description: <input type="text" name="des"/></br>
		<input type="submit" value="Add" name="add"/>
	</form>-->
	
	<h4>Edit a Page</h4>
	<form action="#" method="POST" onsubmit="$('#textToAdd').tinymce().save();">
	<select id="selectPage" name="selectPage" onchange="checkPage();">
		<option value='-1'>Select a Channel/Page</option>
		<? 
			echo "<option value='200'>Homepage</option>";
			echo "<option value='900'>Threads/Post</option>";
			$sql2 = $connect->query("SELECT `id`, `channelName` FROM `channels`"); 
			while($row = $sql2->fetch_object()){
				$id = $row->id;
				$channelName = strtoupper($row->channelName);
				echo "<option value='$id'>$channelName</option>";
			}
			/*$sql2 = $connect->query("SELECT `id`, `pageName`, `pageType` FROM `pages`"); 
			while($row = $sql2->fetch_object()){
				$id = $row->id;
				$pageName = $row->pageName;
				$pageType = $row->pageType;
				echo "<option value='$id' class='$pageType'>$pageName</option>";
			}	*/
		?>
	</select></br>
	<!-- if post or thread page selected show the next div and select a show -->
	<select id="more" name="more" onchange="showSelected();">
		<option value="-1">More</option>
		<? 
			$sql3 = $connect->query("SELECT `id`, `name` FROM `shows`");
			while($rows = $sql3->fetch_object()){
				$id = $rows->id;
				$showName = $rows->name;
				echo "<option value='$id'>$showName</option>";
			}	
		?>
	</select></br>
	<!--<select  id="divToChange"  name="divToChange" onchange="showTextBox();">
	<option value="-1">Select div to edit/add to</option>
	</select></br> -->
	Title: <input type="text" name="title"/></br>
	Video link: <input type="text" name="videoLink"/></br>
	<textarea id="textToAdd" name="text"></textarea>
	<input type="submit" value="Save" id="sendEditPage" name="savePage"/>
	</form>
</div>
</body>
</html>
<script>
function checkPage(){
	var e = document.getElementById("selectPage");
	var page = e.options[e.selectedIndex].value;
	if(page == 900 || page == "900"){
		document.getElementById("more").style.display = "block";
		document.getElementById("divToChange").style.display = "none";
	}
}
</script>


<script type="text/javascript">
	tinymce.init({
    selector: "textarea",
    width: "700px",
	height: "200px",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});


$('#sendEditPage').click(function(){
		text = tinyMCE.get('textToAdd').getContent();
		console.log(text);
	});
	/*
tinymce.init({
	width: "500px",
	height: "300px",
    selector: "textarea",
     plugins: "textcolor",
    toolbar: "forecolor backcolor insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});

$(document).ready(function(){
	$('#submit').click(function(){
		text = tinyMCE.get('note').getContent();
		//alert(text);
		out = document.getElementById("output");
		out.innerHTML = text;
	});
	$('#send').click(function(){
		//text = tinyMCE.get('note').getContent();
		tinyMCE.get('note').setContent("I added this");
	});
});*/
	</script>
