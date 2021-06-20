<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:../index.php");
    exit;
	}else if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== false){
	header("location:../index.php");
    exit;
		
}
?>