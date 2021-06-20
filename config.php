<?php
$host       =   "localhost";
$user       =   "younimem_atoltugas";
$password   =   "akudandiagh0813";
$database   =   "younimem_atoltugas";
$conn = mysqli_connect($host, $user, $password, $database);
	if($conn === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
$logintrue = isset($_SESSION['username']) && !empty($_SESSION['username']);
	$date = "access on " . date("Y-m-d")." at time ". date("h:i:sa");
	$address   = $_SERVER['REMOTE_ADDR'];
	$request_ur= $_SERVER['REQUEST_URI'];
	$request_me= $_SERVER['REQUEST_METHOD'];
	$role	   = $_SERVER['FCGI_ROLE'];
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$os 	   = $_SERVER['OS'];
	$content   = $_SERVER['CONTENT_TYPE'];
	$details = json_decode(file_get_contents("https://ipinfo.io/$address/json"));
	
	//print_r($details);
	$city = $details->city;
	$hostname = $details->hostname;
	$region = $details->region;
	$country = $details->country;
	$loc = $details->loc;
	$asn = $details->org;
	$logs = "INSERT INTO `logs` (`id`, `date`, `address`, `request_ur`, `request_me`, `role`, `user_agent`, `os`, `conten`, `city`, `hostname`, `region`, `country`, `loc` ,`asn`) VALUES (NULL, '$date', '$address', '$request_ur', '$request_me', '$role', '$useragent', '$os', '$content', '$city', '$hostname', '$region', '$country', '$loc', '$asn')";
	mysqli_query($conn, $logs);
?>




 