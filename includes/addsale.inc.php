<?php
	session_start();
	include_once '../db.php';
	$id = $_SESSION['id'];
	
	$order_id = mysqli_real_escape_string($con, $_POST['order_id']);
	$customer_id = mysqli_real_escape_string($con, $_POST['customer_id']);
	$sql = "INSERT INTO `customer_order` (`order_id`, `customer_id`) VALUES ('$order_id', '$customer_id');";
	mysqli_query($con, $sql);
	
							//$sql = "SELECT * 
									//FROM customer_order;";
							//$result = mysqli_query($con, $sql);
							//$resultCheck = mysqli_num_rows($result);
							
							//if ($resultCheck > 0) {
								//while ($row = mysqli_fetch_assoc($result)) {	
								//$order_id = $row["order_id"];
								
								
								
							header("Location: ../orders.php?order=$order_id&no=$customer_id");
							
							//}
			
						//}
							
?>