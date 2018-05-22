<?php

	$text = $_POST['text'];
	$person_id = $_COOKIE['user_id'];
	$date =  date("Y-m-d h:i:s");

	include '../register/db_info.php';

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO News (person_id,body,news_date) VALUES ('{$person_id}','{$text}','{$date}')";
	    $conn->exec($sql);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	echo $date;

?>