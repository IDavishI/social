<?php 

	include "../register/db_info.php";

	$chatroom_id = $_POST['chatroom_id'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT Person.id, Person.name, Person.surname FROM Person, Person_Chatroom WHERE Person.id = Person_Chatroom.person_id AND Person_Chatroom.chatroom_id = {$chatroom_id}"; 
	    foreach ($conn->query($sql) as $row) {
	        $participants[] = $row;
    	}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	$myObj = json_encode($participants);

	echo $myObj;

?>