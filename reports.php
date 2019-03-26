<?php
	$connect = mysqli_connect("localhost", "root", "", "kusina1");
	
	if(isset($_POST['reports']))
	{
    $fdate = $_POST['from_date'];
	$tdate = $_POST['to_date'];
		// search in all table columns
		// using concat mysql function
		$sql = "SELECT * FROM `order_items`,`customer_order` 
				WHERE order_items.order_id=customer_order.order_id
				AND timestamp_dt BETWEEN '$fdate' AND '$tdate'";
		$search_result = mysqli_query($connect,$sql);
		
	}
	else {
		$query = "SELECT customer_order.order_id,order_items.order_id,order_items.menu_id,order_items.price,order_items.quantity,customer_order.timestamp_dt FROM order_items,customer_order WHERE order_items.order_id=customer_order.order_id";
		$search_result = filterTable($query);
	}

	// function to connect and execute the query
	function filterTable($query)
	{
		$connect = mysqli_connect("localhost", "root", "", "kusina1");
		$filter_Result = mysqli_query($connect, $query);
		return $filter_Result;
	}
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>  
        <title>Kusina Online</title>  
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<script type="text/javascript" src="bootstrap/js/jquery-slim.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    </head>  
    <body>
		<div class="row" style="background-color:#2F4F4F">
			<div class="col-1">
				<a href="order.php"><img src="back.png" width="50" height="50" /></a>
			</div>
			<div class="col-7" style="borderl-style: solid;color: #00FF00;text-align: center">
			
				<h1 style=" font-family: AR DELANEY, serif;" class="display-1 font-weight-bold">REPORTS</h1>
			</div>
			<div class="col-4" style="background-image: url('kusina.jpg');background-size: contain; height: 200px;background-repeat: no-repeat;">
			
			</div>
		</div>
		<div class="row">
			<div class="col-8">
				<form action="reports.php" method="POST">
					<div class="row">
						<div class="col-1">
							<label>FROM:</label>
						</div>
						<div class="col-4">
							<input type="datetime-local" class="form-control" name="from_date" >
						</div>
						<label>TO:</label>
						<div class="col-4">
							<input type="datetime-local" class="form-control" name="to_date" >
						</div>
						<div class="col-2">
							<input type="submit" class="form-control btn btn-primary" value="View Reports" name="reports">
						</div>
					</div>
				</form>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Order No.</th>
								<th>Menu ID</th>
								<th>Price</th>
								<th>Qty</th>
								<th>Total</th>
								<th>Timestamp</th>
							</tr>
						</thead>
						<?php while($row = mysqli_fetch_array($search_result)):?>
						<?php
							$order = $row['order_id'];
							$menu = $row['menu_id'];
							$price = $row['price'];
							$qty = $row['quantity'];
							$total = $price*$qty;
							$dt = $row['timestamp_dt'];
						?>
						<tbody>
							<tr>
								<td><?php echo $order;?></td>
								<td><?php echo $menu;?></td>
								<td><?php echo "&#8369;" .$price;?></td>
								<td><?php echo $qty?></td>
								<td><?php echo "&#8369;" .$total. ".00";?></td>
								<td><?php echo $dt;?></td>
								
							</tr>
							
						</tbody>
						<?php endwhile;?>
					</table>
					
				</div>
			</div>
			<div class="col-4">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
							<th>STATUS<th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM menu";
										$query_menu = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_menu)):?>
										
										<span><?php echo $row['count']. " Menus";?></span>
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM customer";
										$query_cus = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_cus)):?>
										
										<span><?php echo $row['count']. " Customers";?></span>
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM order_items";
										$query_items = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_items)):?>
										
										<?php echo $row['count']. " Orders";?>
									<?php endwhile;?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>