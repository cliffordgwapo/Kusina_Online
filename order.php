<?php  
	include('session.php');
	
	if(!isset($_SESSION['login_user'])) {
		header("location: index.php");
	}
	if(isset($_POST['btn_search']))
	{
    $search = $_POST['search'];
		// search in all table columns
		// using concat mysql function
		$query = "SELECT * FROM `customer_order` WHERE CONCAT(`order_id`, `customer_id`, `timestamp`) LIKE '%".$search."%'";
		$search_result = filterTable($query);
    
	}
	else {
		$query = "SELECT * FROM `customer_order`";
		$search_result = filterTable($query);
	}

	// function to connect and execute the query
	function filterTable($query)
	{
		$connect = mysqli_connect("localhost", "root", "", "kusina");
		$filter_Result = mysqli_query($connect, $query);
		return $filter_Result;
	}
?>
<?php
	$con = new mysqli('localhost', 'root', '', 'kusina') or die(mysqli($mysqli));
	$sql = "SELECT * FROM customer";
	$query_cus = mysqli_query($con,$sql);
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
			<div style="background-image: url('kusina.jpg');background-size: contain; height: 400px;background-repeat: no-repeat" class="col-8">
				<a style="padding-left:10px" data-toggle="modal" data-target="#exampleModalCenter1" href=""><img src="add.png" width="40" height="40"></a>
			</div>
			<div class="col-sm-4" style="color:#00FF00;position: relative">
				<div class="container" style="position: absolute;bottom: 30px;right: 30px;text-align: right">100</div>
			</div>
		 </div>
		 <div class="row">
			<div class="col-sm-7"></div>
			<div class="col-sm-5">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
							<th>Order ID</th>
							<th>Customer ID</th>
							<th>Timestamp</th>
							<th>Action</th>
							</tr>
						</thead>
						<?php while($row = mysqli_fetch_array($search_result)):?>
						<tbody>
							<tr>
								<td><?php echo $row['order_id'];?></td>
								<td><?php echo $row['customer_id'];?></td>
								<td><?php echo $row['timestamp'];?></td>
								<td>
									<div class="btn-group">
									<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										
									</button>
										<div class="dropdown-menu">
										<a data-toggle="modal" data-target="#exampleModalCenter1" class="dropdown-item">Add New Order</a>
										<a class="dropdown-item" href="menu.php?editmenu=<?php echo $row['menu_id']; ?>">Edit</a>
										<a class="dropdown-item" href="process2.php?delete_id=<?php echo $row["menu_id"]; ?>" onclick="return confirm('Are you sure?');">Delete</a>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
						<?php endwhile;?>
					</table>
				</div>
			</div>
		 </div>
      </body>
	  <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="form-control" style="width: 1200px">
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h5 class="modal-title" >Add New Order</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<?php require_once 'process1.php'; ?>
							<form action="process1.php" method="post">
								<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
								<label class="col-form-label">Order ID:</label>
								<input type="text" class="form-control form-control-sm" name="order_id" placeholder="Order Id" value="<?php echo $order_id; ?>" required>
								<label class="col-form-label">Customer Name:</label>
								<select name="customer_id" class="form-control" required>
									<?php while($row = mysqli_fetch_array($query_cus)):?>
										<option value="<?php echo $row['customer_id'];?>"><?php echo $row['first_name'];?></option>
									<?php endwhile;?>
								</select>
								<label class="col-form-label">Timestamp:</label>
								<input type="datetime-local" class="form-control form-control-sm" name="timestamp" placeholder="timestamp" value="<?php echo $timestamp; ?>" required>
								<input class="btn btn-primary btn-block button2" type="submit" name="add" value="Save" onclick="return confirm('Are you sure?');">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
</html>