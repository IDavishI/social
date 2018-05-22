<?php 

	include "../register/db_info.php";

	$news_id = $_GET['news_id'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   
	    $sql = "DELETE FROM News 
	    	WHERE id = {$news_id}"; 
	    $conn->exec($sql);

	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	
	$conn = null;
	header("Location:../profile.php");
?>