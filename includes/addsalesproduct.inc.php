<?php
	session_start();
	include_once '../db.php';
	$id = $_SESSION['id'];
	
	$order_id = mysqli_real_escape_string($con, $_GET['order_id']);
	$menu_id = mysqli_real_escape_string($con, $_GET['menu_id']);
	$price = mysqli_real_escape_string($con, $_GET['price']);
	$quantity = mysqli_real_escape_string($con, $_GET['quantity']);
	
	

							//$sql = "SELECT menu.menu_id,
									//FROM `menu` AS p 
									//JOIN `admin` AS r 
									//WHERE p.id = $id  
									//AND r.id = $id AND menu_id=$menu_id";
							//$result = mysqli_query($con, $sql);
							//$resultCheck = mysqli_num_rows($result);
							
							//if ($resultCheck > 0) {
								//while ($row = mysqli_fetch_assoc($result)) {
								//$menu_id = $row['menu_id'];
								//$price = $row['price'];
										
										
										
									$sql = "SELECT * 
											FROM customer_order WHERE order_id='$order_id';";
									$result = mysqli_query($con, $sql);
									$resultCheck = mysqli_num_rows($result);
									
									
									while ($row = mysqli_fetch_assoc($result)) {	
									$customer_id = $row['customer_id'];
								
							

	
	$sql = "INSERT INTO `order_items` (`order_id`, `menu_id`, `price`, `quantity`) VALUES ('$order_id', '$menu_id', '$price', '$quantity');";

	mysqli_query($con, $sql);

	
	
		
	header("Location: ../orders.php?order=$order_id&no=$customer_id");
	
	
				
							}
								//}
				
							//}