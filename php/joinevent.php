<?php

	include "./register/db_info.php";

	$user_id = $_COOKIE['user_id'];
	$event_id = $_POST['event_id'];
	$chatroom_id = $_POST['chatroom_id'];

	try{
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO person_event(person_id, event_id) VALUES ('{$user_id}','{$event_id}')"
	    $conn->exec($sql);s
	    $sql = "INSERT INTO person_chatroom(person_id, chatroom_id) VALUES ('{$user_id}','{$chatroom_id}')"
	    $conn->exec($sql);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;


?>