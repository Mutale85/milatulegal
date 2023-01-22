<?php 
// 	session_start();
// 	session_name();
// 	$dbname = "mila_legalDB";
// 	$PASS = "Javeria##2019";
// 	$USER = "mila_milatu";
// 	$connect = new PDO("mysql:host=localhost;dbname=$dbname;", $USER, $PASS);
// // 	$connect = new PDO("mysql:host=localhost;dbname=legalLinkDB;", "root", "");
// 	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 	ini_set("pcre.jit", "0");
// 	include 'functions.php';

	session_start();
	session_name();
	$dbname = "surewyse";
	$PASS = "Mutale@19@85";
	$USER = "MutaleMulenga";
	// $connect = new PDO("mysql:host=localhost;dbname=$dbname;", $USER, $PASS);
	$connect = new PDO("mysql:host=localhost;dbname=legalLinkDB;", "root", "");
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	ini_set("pcre.jit", "0");
	include 'functions.php';
?>