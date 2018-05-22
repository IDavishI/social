<?php 

	include "../register/db_info.php";

	$event_id = $_GET['event_id'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   
	    $sql = "DELETE FROM Event
	    	WHERE id = {$event_id}"; 
	    $conn->exec($sql);

	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	header("Location: ../pages/events/data.php");
	
?>