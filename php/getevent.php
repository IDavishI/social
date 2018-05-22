<?php

	include "./register/db_info.php";

	$event_id = $_POST['event_id'];
	if(isset($_GET['event_id'])){
		$event_id = $_GET['event_id'];
	}

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM event  WHERE id = '{$event_id}'"; 
	    foreach ($conn->query($sql) as $row) {
	        $event = $row;
    	}
    	
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	$myObj = json_encode($event);

	echo $myObj;
?>