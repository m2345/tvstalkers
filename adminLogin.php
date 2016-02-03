<?
session_start();
//$_SESSION['username'] = 'admin';
//$_SESSION['token'] = getToken();
//echo $_SESSION['username'];

function getToken($length = 20){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}


echo md5(strip_tags(stripslashes("girlsrule11")));
?>
