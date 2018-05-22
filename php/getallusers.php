<?php 

	include "db_info.php";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM Person"; 
	    foreach ($conn->query($sql) as $row) {
	        $users[] = $row;
    	}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	$myObj = json_encode($users);

	echo $myObj;

?>