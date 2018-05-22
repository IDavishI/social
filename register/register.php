<?php

	session_start();

	$page = $_POST['page'];
	$main = $_POST['main-page'];

	if ($main == 'value') {
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['password'] = $_POST['password'];
		header('Location: ../register1.php');
	} else if ($page == 'page1') {

		$_SESSION['name'] = $_POST['name'];
		$_SESSION['surname'] = $_POST['surname'];
		if (!isset($_SESSION['password']))
		$_SESSION['password'] = $_POST['password'];
		if (!isset($_SESSION['email']))
		$_SESSION['email'] = $_POST['email'];

		header('Location: ../register2.php');

	} else if ($page == 'page2') {
		$_SESSION['age'] = $_POST['age'];
		$_SESSION['gender'] = $_POST['gender'];
		$_SESSION['birth_year'] = $_POST['birth_year'];
		$_SESSION['phone'] = $_POST['phone'];

		header('Location: ../register3.php');

	} else if ($page == 'page3') {
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['about'] = $_POST['about'];
		$_SESSION['hobby'] = $_POST['hobby'];

		include 'db_info.php';

		try {
		    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    echo "Connected successfully"; 

		    $sql = "INSERT INTO Person (name, surname, age, city, interests, password, 
		    email, birth_date, gender, phone, about) " . 
    		"VALUES ('{$_SESSION['name']}', '{$_SESSION['surname']}', {$_SESSION['age']}, 
    		'{$_SESSION['city']}', '{$_SESSION['hobby']}', '{$_SESSION['password']}', '{$_SESSION['email']}', 
    		'{$_SESSION['birth_year']}', '{$_SESSION['gender']}', '{$_SESSION['phone']}', '{$_SESSION['about']}')";

    		$conn->exec($sql);
    		$last_id = $conn->lastInsertId();
	    }
		catch(PDOException $e)
	    {
	    	echo "Connection failed: " . $e->getMessage();
	    }

	    $conn = null;

	    $cookie_name = "user_id";
		$cookie_value = $last_id;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

		header('Location: ../profile.php');
	}



?>