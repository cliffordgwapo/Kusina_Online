<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="fontawesome/css/all.css">
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<script type="text/javascript" src="bootstrap/js/jquery-slim.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	</head>
	<body>
		<div class="row" style="background-color:#2F4F4F">
			<div style="background-image: url('kusina.jpg');background-size: contain; height: 400px;background-repeat: no-repeat;position: relative" class="col-8">
				<div id="profile">
					<b><i><?php if(isset($_SESSION['id'])){
									echo ($_SESSION['username']);
								}
								else{
								header("Location: index.php");
							}?></i></b>
				</div>
				<form style="position: absolute;bottom: 5px" action = "includes/addsalesproduct.inc.php" method="GET">
					<div class="row">
						<?php
							$order_id = $_GET['order'];
						?>
						<div class="col-2">
							<input type="text" class="form-control form-control-sm" name="order_id" value="<?php echo $order_id; ?>" readonly>
						</div>
						<div class="col-2">
							<?php
								include_once 'db.php';
								$id = $_SESSION['id'];
											
								$no = $_GET['no'];
								$sql = "SELECT * 
										FROM customer AS p 
										JOIN admin AS r 
										WHERE p.id = $id  
										AND r.id = $id AND customer_id=$no;";
								$result = mysqli_query($con, $sql);
								$resultCheck = mysqli_num_rows($result);
											
								if ($resultCheck > 0) {
									while ($row = mysqli_fetch_assoc($result)) {							
							?>		
								<input type="text" class="form-control form-control-sm" name="customer_id" value="<?php echo $row["first_name"]; ?>" readonly>
										
							<?php		
									}
								}
							?>
						</div>	
						<div class="col-3">	
									<select id="menus" class="form-control form-control-sm" name="menu_id" required>
										<option value="">SELECT MENU</option>
									<?php
										include_once 'db.php';
										$id = $_SESSION['id'];
										$sql = "SELECT * 
												FROM menu AS p 
												JOIN admin AS r 
												WHERE p.id = $id  
												AND r.id = $id;";
										$result = mysqli_query($con, $sql);
										$resultCheck = mysqli_num_rows($result);
										
										if ($resultCheck > 0) {
											while ($row = mysqli_fetch_assoc($result)) {
									?>
										
										<option value="<?php echo $row["menu_id"];?>" data-price="<?php echo $row['price'];?>"><?php echo $row["menu_name"];?></option>
									<?php		}
						
									}
									?>
									</select>
						</div>
						<div class="col-2">
							<input id="prices" type="number" class="form-control form-control-sm" name="price" placeholder="price" value="<?php echo $price;?>" readonly>
						</div>
					
						<div class="col-2">		
							<input type="number" class="form-control form-control-sm" name="quantity" placeholder="qty" style="width: 100px;" required>
						</div>
					</div></br>			
					<div class="row">		
						<?php $customer_id = $_GET['no']; ?>
						<div class="col-2">
							  <button type="submit" name="submit" class="btn btn-primary btn-sm">Add Menu</button>
						</div>
						<div class="col-2">
							  <button class="btn btn-light btn-sm"><a href="orders_summary.php?order=<?php echo $order_id; ?>&no=<?php echo $customer_id; ?>">Done</a></button>
						</div>
								<script>
									$(document).ready(function(){
										$( "#menus" ).change(function(){
											$('#prices').val($(this).find(':selected').data('price'))
										});
									});
								</script>
					</div>
				</form>
			</div>
			<div class="col-sm-4" style="color:#00FF00;position: relative;border-style: solid">
				<h1 class="display-4 font-weight-bold" style="position:absolute;right:30px">Grand Total</h1>
					<?php
					include_once 'db.php';
					$id = $_SESSION['id'];
					$order_id = $_GET['order'];
					$sql = "SELECT * FROM order_items, menu, customer_order
							WHERE order_items.menu_id = menu.menu_id
							AND customer_order.order_id = order_items.order_id
							AND customer_order.order_id = '$order_id';";
					$result = mysqli_query($con, $sql);
					$resultCheck = mysqli_num_rows($result);
					$gtotal=0;
					if ($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
						$savequantity = $row["quantity"];
						$saveprice = $row["price"];	
						$quantityprice = $savequantity*$saveprice;
						$gtotal += $quantityprice;


						
					?>
					<?php		
						}
					}
					?>
					<h1 class="display-4 font-weight-bold"><p style="position: absolute;bottom: 30px;right: 30px;text-align: right"><?php echo "&#8369; " .$gtotal;?></p><h1>
					
			</div>
			
		</div>
		<div class="row">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
						  <th scope="col">Menu ID</th>
						  <th scope="col">Menu Name</th>
						  <th scope="col">Price</th>
						  <th scope="col">Quantity</th>
						  <th scope="col">Subtotal</th>
						  <th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
							<?php
							include_once 'db.php';
							$id = $_SESSION['id'];
							$order_id = $_GET['order'];
							$sql = "SELECT * FROM order_items, menu, customer_order
									WHERE order_items.menu_id = menu.menu_id
									AND customer_order.order_id = order_items.order_id
									AND customer_order.order_id ='$order_id';";
							$result = mysqli_query($con, $sql);
							$resultCheck = mysqli_num_rows($result);
							$total=0;
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
								$savequantity = $row["quantity"];
								$saveprice = $row["price"];	
								$quantityprice = $savequantity*$saveprice;
								$order_id = $row["order_id"];
								$total += $quantityprice;
							?>
						<tr>
							<td><?php echo $row["menu_id"];?></td>
							<td><?php echo $row["menu_name"];?></td>
							<td>&#8369;<?php echo $row["price"];?></td>
							<td><?php echo $row["quantity"];?></td>
							<td>&#8369; <?php echo $quantityprice;?>.00</td>
							<td><a href="deleteorder.php?id=<?php echo $row["menu_id"];?>&order_id=<?php echo $row["order_id"];?>"> Delete </a></td>
						</tr>
					<?php		
							}
						}
					?>
					</tbody>
			</table>
			</div>
		</div>
		<!--<div align="right">
			<b><h3>TOTAL  </h3><h1>&#8369;<?php //echo $total;?>.00</h1></b><center>
		</div>-->
		


	
</body>
	
</html>