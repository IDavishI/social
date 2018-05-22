<?php 

	include "../register/db_info.php";

	$user_id = $_POST['user_id'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$city = $_POST['city'];
	$interests = $_POST['interests'];
	$about = $_POST['about'];
	$rating = $_POST['rating'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "UPDATE Person SET name = '{$name}', surname = '{$surname}', city = '{$city}', interests = '{$interests}', about = '{$about}', rating = '{$rating}', email = '{$email}', phone = '{$phone}'
	    	WHERE id = {$user_id}"; 
	    $conn->exec($sql);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	header("Location: ../pages/users/data.php");
?>