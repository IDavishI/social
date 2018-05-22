<?php 

	include "db_info.php";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM Events"; 
	    foreach ($conn->query($sql) as $row) {
	        $events[] = $row;
    	}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	$myObj = json_encode($events);

	echo $myObj;

?>