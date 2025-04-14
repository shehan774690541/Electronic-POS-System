<?php
include("error-block.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "electrosh";

	$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

?>