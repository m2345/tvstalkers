<?php

define("DB_NAME", "enterta1_tvstalkers");
define("DB_USERNAME", "enterta1");
define("DB_PASSWORD", "bbkmgtp330");
define("DB_HOST", "174.136.13.39");

$connect = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno())
  {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
  }else{
	
  }
?>
