<?php 
	
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$is_registered = false;
	$id = -1;
	$role = 'user';

	include 'db_info.php';

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT id, email, password, role FROM Person WHERE email='{$email}' 
	    	AND password='{$pass}'"; 
	    foreach ($conn->query($sql) as $row) {
	        $id = $row['id'];
	        $is_registered = true;
	        $role = $row['role'];
    	}

    	if ($is_registered == true && $id != -1) {
	    	$cookie_name = "user_id";
			$cookie_value = $id;
			$cookie_role = 'role';
			$cookie_role_value = $role;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			setcookie($cookie_role, $cookie_role_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			
			if ($role == 'admin') {
				header('Location: ../admin.php');
			} else
				header('Location: ../profile.php');
		} else {
			header('Location: ../index.php');
		}
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

?>