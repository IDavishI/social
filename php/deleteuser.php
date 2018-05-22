<?php 

	include "../register/db_info.php";

	$user_id = $_GET['user_id'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   
	    $sql = "DELETE FROM Person 
	    	WHERE id = {$user_id}"; 
	    $conn->exec($sql);

	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	
	$conn = null;

	header("Location: ../pages/users/data.php");
?>