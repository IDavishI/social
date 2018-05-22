<?php
	
	include "./register/db_info.php";

	$event_name = $_POST['new_event_name'];
	$user_id = $_COOKIE['user_id'];
	$event_description = $_POST['event_description'];
	$date = date("Y-m-d h:i:sa");

		try {
		$sql = "INSERT INTO chatroom (name) VALUES ('{$event_name}')";
	    $conn->exec($sql);
	    $last_id = $conn->lastInsertId();
	    $sql = "INSERT INTO person_chatroom (person_id, chatroom_id) VALUES ('{$user_id}','{$last_id}')"
	    $conn->exec($sql);	

	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO event(creator,name,description,date,chatroom_id)  
	    	VALUES ('{$user_id}','{$event_name}','{$event_description}','{$date}','{%last_id}')";
	    $conn->exec($sql);
	    $last_id = $conn->lastInsertId();
	    $sql = "INSERT INTO person_event (person_id, event_id) 
	    	VALUES ('{$user_id}','{$last_id}')"
	    $conn->exec($sql);
	    
	    header("Location: getevent.php?event_id=$last_id");
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;


?>