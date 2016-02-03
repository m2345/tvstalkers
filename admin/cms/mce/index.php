<script type="text/javascript" src="jquery1.1.js"></script>
<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	width: "300px",
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
});
	</script>

<form method="post" action="somepage">
    <textarea id='note'></textarea>
    <input type="button" value="Save" id="submit"/>
    <input type="button" value="Send" id="send"/>
    <div id="output"></div>
</form>

<?
 $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
 $allowedTags.='<li><ol><ul><span><div><br><ins><del>';  

	echo $string;
    $sContent = strip_tags(stripslashes($string),$allowedTags);

 echo $sContent;

?>


