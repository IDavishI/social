<?php

	include "../register/db_info.php";

	$text_message = $_POST['body'];
	$person_id = $_POST['person_id'];
	$message_date = date("Y-m-d h:i:s");
	$chatroom_id = $_POST['chatroom_id'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO Messages(chatroom_id,body, message_date, person_id, status) 
	    	VALUES ('{$chatroom_id}','{$text_message}','{$message_date}','{$person_id}', 'unread')";
	    $conn->exec($sql);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;


?>
