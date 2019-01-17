<?php  
 $connect = mysqli_connect("localhost", "root", "", "testting");  
 session_start();  
 if(isset($_SESSION["username"]))  
 {  
      header("location:entry.php");  
 }  
 if(isset($_POST["register"]))  
 {  
      if(empty($_POST["username"]) && empty($_POST["password"]))  
      {  
           echo '<script>alert("Both Fields are required")</script>';  
      }  
      else  
      {  
           $username = mysqli_real_escape_string($connect, $_POST["username"]);  
           $password = mysqli_real_escape_string($connect, $_POST["password"]);  
           $password = md5($password);  
           $query = "INSERT INTO users (username, password) VALUES('$username', '$password')";  
           if(mysqli_query($connect, $query))  
           {  
                echo '<script>alert("Registration Done")</script>';  
           }  
      }  
 }  
 if(isset($_POST["login"]))  
 {  
      if(empty($_POST["username"]) && empty($_POST["password"]))  
      {  
           echo '<script>alert("Both Fields are required")</script>';  
      }  
      else  
      {  
           $username = mysqli_real_escape_string($connect, $_POST["username"]);  
           $password = mysqli_real_escape_string($connect, $_POST["password"]);  
           $password = md5($password);  
           $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";  
           $result = mysqli_query($connect, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                $_SESSION['username'] = $username;  
                header("location:entry.php");  
           }  
           else  
           {  
                echo '<script>alert("Wrong User Details")</script>';  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | PHP Login Registration Form with md5() Password Encryption</title>  
           <meta charset="utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="style.css">
			<script type="text/javascript" src="bootstrap/js/jquery-slim.min.js"></script>
			<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
			<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <h1 align="center">Welcome to Kusina Online</h1>  
                <br />  
                <?php  
                if(isset($_GET["action"]) == "login")  
                {  
                ?>  
                <h3>Login</h3>
				<p ="lead">Please fill up the form provided.</p>
                <br />  
                <form method="post">  
                     <label>Enter Username</label>  
                     <input type="text" name="username" class="form-control" required>  
                     <br />  
                     <label>Enter Password</label>  
                     <input type="password" name="password" class="form-control" required>  
                     <br />  
                     <input type="submit" name="login" value="Login" class="btn btn-info" />  
                     <br />  
                     <h6>Don't have account?<a href="index.php">Register</a> now!</h6>
					 <p ="lead">This page is protected by CKScompany and subject to Google’s Privacy Policy & Terms of Service. By signing up you agree to Phonebook's Terms of Service.</p>
						<h4>Or, use another account:</h4>
						<div class="row" align="center">
							<div class="col-sm-3 border1 border 2">
								<img class="img1" src="google1.png" width="30" height="30"/>
							</div>
							<div class="col-sm-3 border1 border 2">
								<img class="img1" src="facebook.png" width="30" height="30"/>
							</div>
							<div class="col-sm-3 border1 border 2">
								<img class="img1" src="github.png" width="30" height="30"/>
							</div>
						</div>
                </form>  
                <?php       
                }  
                else  
                {  
                ?>  
                <h3>Get Started</h3>
				<p ="lead">Please fill up the form provided.</p>  
                <form method="post">  
                     <label>Enter Username</label>  
                     <input type="text" name="username" class="form-control" required>  
                     <br />  
                     <label>Enter Password</label>  
                     <input type="password" name="password" class="form-control" required>  
                     <br />  
                     <input type="submit" name="register" value="Register" class="btn btn-info" />
					 <br />
					 <h6>Already have account? <a href="index.php?action=login">Login</a> now!</h6>
					 <p ="lead">This page is protected by CKScompany and subject to Google’s Privacy Policy & Terms of Service. By signing up you agree to Phonebook's Terms of Service.</p>
						<h4>Or, use another account:</h4>
						<div class="row" align="center">
							<div class="col-sm-3 border1 border 2">
								<img class="img1" src="google1.png" width="30" height="30"/>
							</div>
							<div class="col-sm-3 border1 border 2">
								<img class="img1" src="facebook.png" width="30" height="30"/>
							</div>
							<div class="col-sm-3 border1 border 2">
								<img class="img1" src="github.png" width="30" height="30"/>
							</div>
						</div>
                </form>  
                <?php  
                }  
                ?>  
           </div>  
      </body>  
 </html>  