<?php 

	include "../register/db_info.php";

	$user_id = $_GET['user_id'];
	$user = array();

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM Person WHERE id = {$user_id}"; 
	    foreach ($conn->query($sql) as $row) {
	        $user = $row;
    	}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

?>