<?php

session_start();

if (isset($_POST['submit'])){
	
	include 'db.php';
	
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = md5(mysqli_real_escape_string($con, $_POST['password']));
	

	if (empty($username) || empty($password)){
		header("Location: index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM admin WHERE username='$username'";
		$result = mysqli_query($con, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: index.php?login=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)){

				
				if ($password == false){
					header("Location: index.php?login=error");
					exit();
				} elseif ($password == true){

					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['password'] = $row['password'];
					header("Location: home.php?login=success");
					exit();
				}
				
			}
		}
	}
} else {
	header("Location: index.php?login=error");
	exit();
}