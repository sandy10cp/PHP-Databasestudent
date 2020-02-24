<?php 

session_start();

require_once 'koneksi.php';

// echo $_SESSION['id'];

if(!$_SESSION['id']) {
	header('location:index.php');	
} 



?>