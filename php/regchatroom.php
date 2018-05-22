<?php
	
	include "../register/db_info.php";
	
	$group_name = $_POST['new_group_name'];
	$user_id = $_COOKIE['user_id'];

		try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO Chatroom (name) VALUES ('{$group_name}')";
	    $conn->exec($sql);
	    $last_id = $conn->lastInsertId();
	    $sql = "INSERT INTO Person_Chatroom (person_id, chatroom_id) VALUES ('{$user_id}','{$last_id}')";
	    $conn->exec($sql);

	    header("Location: ../chat.php?chatroom_id={$last_id}&name={$group_name}");

	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;


?>