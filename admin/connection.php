<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
	header("Location: ../");
	exit();
}else{
	include("error-block.php");
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "electrosh";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
}
?>