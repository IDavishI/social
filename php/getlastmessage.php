<?php

	include "../register/db_info.php";

	$chatroom_id = $_POST['chatroom_id'];
	if(isset($_GET['chatroom_id'])){
		$chatroom_id = $_GET['chatroom_id'];
	}
	$status = '';
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT status FROM Messages, Chatroom WHERE chatroom_id = '{$chatroom_id}' AND Messages.chatroom_id = Chatroom.id ORDER BY Messages.id DESC LIMIT 1";

	    foreach ($conn->query($sql) as $row) {
	        $status = $row['status'];
    	}

    	$sql = "UPDATE Messages SET status='read' WHERE status = 'unread'";
    	$conn->exec($sql);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	echo $status;

	// header('Location: ../chatroom.php?messages={$messages[]}');

?>