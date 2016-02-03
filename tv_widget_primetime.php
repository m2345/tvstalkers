<?

//assuming all is same as time starts at 7am and ends at 8pm
//$url ="http://services.tvrage.com/tools/quickschedule.php";	
header('Content-Type: application/json');
if(isset($_POST['onload'])){
$url = "http://services.tvrage.com/myfeeds/fullschedule.php?key=zXjD9cOkw502ulgA6iel";
$data = file_get_contents($url);
$xml = simplexml_load_string($data);  
//print_r($xml);  
$send = json_encode($xml, true);
echo $send;
}

	
?>
