<?php

	include "../register/db_info.php";

	$friend_id = $_GET['friend_id'];
	$chatroom_id = $_GET['chatroom_id'];

	try{
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO Person_Chatroom(person_id, chatroom_id) VALUES ('{$friend_id}','{$chatroom_id}')";
	    $conn->exec($sql);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

?>