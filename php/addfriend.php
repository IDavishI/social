<?php

	include "../register/db_info.php";

	$user_id = $_COOKIE['user_id'];
	$friend_id = $_GET['friend_id'];

	if ($user_id != $friend_id) {

		echo "here";

		try{
		    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $sql = "SELECT * FROM Friends WHERE person_id = {$user_id} AND friend_id = {$friend_id}";

		    foreach ($conn->query($sql) as $row) {
	        	$friends = $row[0];
    		}

    		if (!isset($friends)) {
			    $sql = "INSERT INTO Friends(person_id, friend_id) VALUES ('{$user_id}','{$friend_id}')";
			    $conn->exec($sql);

			    $sql = "INSERT INTO Friends(person_id, friend_id) VALUES ('{$friend_id}','{$user_id}')";
			    $conn->exec($sql);
			}
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
		$conn = null;

	}

	header('Location: ../profile.php');

?>