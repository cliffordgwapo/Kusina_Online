<?php
session_start();
require('db.php');
$id=$_GET['id'];

$order_id=$_GET['order_id'];

$query = "DELETE FROM order_items WHERE order_id = '$order_id' AND menu_id='$id';"; 
$result = mysqli_query($con,$query) ;

		$sql = "SELECT * 
						FROM customer_order WHERE order_id ='$order_id' ;";
							$result = mysqli_query($con, $sql);
							$resultCheck = mysqli_num_rows($result);
							
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_assoc($result)) {	
								$order_id = $row["order_id"];
								$customer_id = $row["customer_id"];
								
								
header("Location: orders.php?order=$order_id&no=$customer_id");
							
							}
			
						}
							
?>