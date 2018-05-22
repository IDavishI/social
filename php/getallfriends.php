<?php 

	include "../register/db_info.php";

	$user_id = $_COOKIE['user_id'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT Person.id, name, surname, rating FROM Person, Friends WHERE Person.id = Friends.friend_id AND Friends.person_id = '{$user_id}'"; 
	    foreach ($conn->query($sql) as $row) {
	        $friends[] = $row;
    	}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	$myObj = json_encode($friends);

	echo $myObj;

?>