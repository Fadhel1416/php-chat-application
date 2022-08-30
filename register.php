<?php
    session_start();
	require_once('conn.php');
	ini_set("display_errors",1);
	function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username=check_input($_POST['username']);
		
		if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
			$_SESSION['sign_msg'] = "Username should not contain space and special characters!"; 
			header('location: signup.php');
		}
		else{
			
		$fusername=$username;
		
		$password = check_input($_POST["password"]);
		$fpassword=md5($password);
		$fname = check_input($_POST["name"]);
		$femail = check_input($_POST["email"]);
		
		$tt=mysqli_query($conn,"insert into user(username,password,uname,photo,access,email,uscode) values ('$fusername', '$fpassword','$fname','upload/ginyu_goku_body_1641816446.jpg', '2', '$femail', '1' );");
		
		$_SESSION['msg'] = "Sign up successful. You may login now!".mysqli_num_rows($tt); 
		header('location: index.php');
		}
	}
?>