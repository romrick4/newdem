<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['logged_in_status']);
if(isset($_SERVER)){
	//echo print_r($_SERVER, true);
}
header("location: home.php");
?>