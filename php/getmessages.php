<?php

	include "../register/db_info.php";

	$chatroom_id = $_POST['chatroom_id'];
	if(isset($_GET['chatroom_id'])){
		$chatroom_id = $_GET['chatroom_id'];
	}
	$messages = array();
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT Messages.id, body, message_date, person_id, name, surname FROM Messages, Person WHERE chatroom_id = '{$chatroom_id}' AND person_id = Person.id"; 
	    foreach ($conn->query($sql) as $row) {
	        $messages[] = $row;
    	}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;
	
	echo json_encode($messages);

	// header('Location: ../chatroom.php?messages={$messages[]}');

?>