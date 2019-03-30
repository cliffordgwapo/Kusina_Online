<?php

session_start();

						include_once 'db.php';
						$id = $_SESSION['id'];

						$oldpassword = md5($_POST['old_pwd']);
						$newpassword = md5($_POST['new_pwd']);
						$confirmnewpassword = md5($_POST['con_pwd']);

						

						$sql = "SELECT password FROM admin WHERE id = $id ;"; 

						$result = mysqli_query($con, $sql);
						$resultCheck = mysqli_num_rows($result);
						$row = mysqli_fetch_assoc($result);
								$oldpassworddb = $row["password"];
								echo $oldpassworddb."<br>";
						
								echo $oldpassword;
								if ($oldpassword == $oldpassworddb)
								{
									
									if ($newpassword == $confirmnewpassword) {
										# code...
										$query = "UPDATE `admin` SET `password` = '$newpassword' WHERE `admin`.`id` = $id;"; 
										$result = mysqli_query($con,$query) ;

										session_start();
										session_unset();
										session_destroy();
										header("Location: index.php");
										exit();
									}
									else{
										die ("new password dont match");
									}

								}
								else {
									die ("password dont match");
								}

							
						

							?>					