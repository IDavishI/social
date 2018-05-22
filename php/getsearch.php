<?php 

	include "./register/db_info.php";

	$email = $_POST['email'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT Person.id, name, surname, rating FROM Person WHERE email LIKE '%{$email}%'";
	    foreach ($conn->query($sql) as $row) {
	        $persons[] = $row;
    	}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	$myObj = json_encode($persons);

	echo $myObj;

?>