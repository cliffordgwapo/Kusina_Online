<?php  
	session_start();
	
	if(isset($_POST['btn_search']))
	{
    $search = $_POST['search'];
		// search in all table columns
		// using concat mysql function
		$query = "SELECT * FROM `customer` WHERE CONCAT(`customer_id`, `first_name`, `last_name`, `middle_initial`, `phone_number`, `province`, `street`, `barangay`, `city`) LIKE '%".$search."%'";
		$search_result = filterTable($query);
    
	}
	else {
		$query = "SELECT * FROM `customer`";
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
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="home.php">
				<img src="logo.jpg" width="40" height="40" class="d-inline-block align-top" alt="">
			</a>
			<a class="navbar-brand" href="#">Kusina Online</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="home.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="customer.php">Customer <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="menu.php">Menu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="order_reports.php">Reports</a>
					</li>
				</ul>
			</div>
			<form class="form-inline my-2 my-lg-0">
				<div id="profile">
					<b><i><?php if(isset($_SESSION['id'])){
									echo ($_SESSION['username']);
								}
								else{
								header("Location: index.php");
							}?></i></b>
				</div>
				<div class="dropdown">
					<img src="prof.jpg" alt="Profile Picture" width="40" height="40" class="mr-sm-2">
					<div class="dropdown-content" style="right: 0; left: auto;">
						<img src="prof.jpg" alt="" width="200" height="200">
						<div class="desc"><b><a href="pwdupdate.php">Update Password</a></b></div>
						<div class="desc" onclick="return confirm('Are you sure?');"><b id="logout"><a href="logout.php">Log Out</a></b></div>
					</div>
				</div>
			</form>
		</nav>
		
		<div class="container" style="padding-top:20px">
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">Customer List</a>
				<form action="customer.php" method="post" class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btn_search">Search</button>
					<a style="padding-left:10px" data-toggle="modal" data-target="#exampleModalCenter1" href=""><img src="add.png" width="40" height="40"></a>
				</form>
				
		</nav>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Phone Number</th>
						<th>Address</th>
						<th>Action</th>
						</tr>
					</thead>
					<?php while($row = mysqli_fetch_array($search_result)):?>
					<tbody>
						<tr>
							<td><?php echo $row['customer_id'];?></td>
							<td><?php echo $row['last_name'] . ", " .$row['first_name'] . ", " .$row['middle_initial'];?></td>
							<td><?php echo $row['phone_number'];?></td>
							<td><?php echo $row['street'] . ", " .$row['barangay'] . ", " .$row['city'] . ", " .$row['province'];?></td>
							<td>
								<div class="btn-group">
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									
								</button>
									<div class="dropdown-menu">
									<a data-toggle="modal" data-target="#exampleModalCenter1" class="dropdown-item">Add Customer</a>
									<a class="dropdown-item" href="customer.php?edit=<?php echo $row['customer_id']; ?>">Edit</a>
									<a class="dropdown-item" href="process1.php?delete=<?php echo $row["customer_id"]; ?>" onclick="return confirm('Are you sure?');">Delete</a>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
					<?php endwhile;?>
				</table>
			</div>
			<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="form-control" style="width: 1200px">
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h5 class="modal-title" >Add Customer</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<form action="process1.php" method="post">
								<label class="col-form-label">First Name:</label>
								<input type="text" class="form-control form-control-sm" name="first_name" placeholder="first name" value="" required>
								<label class="col-form-label">Last Name:</label>
								<input type="text" class="form-control form-control-sm" name="last_name" placeholder="last name" value="" required>
								<label class="col-form-label">Middle Initial:</label>
								<input type="text" class="form-control form-control-sm" name="middle_initial" placeholder="middle initial" value="" required>
								<label class="col-form-label">Phone Number:</label>
								<input type="text" class="form-control form-control-sm" name="phone_number" placeholder="phone number" value="" required>
								<label class="col-form-label">Province:</label>
								<input type="text" class="form-control form-control-sm" name="province" placeholder="province" value="" required>
								<label class="col-form-label">Street:</label>
								<input type="text" class="form-control form-control-sm" name="street" placeholder="street" value="" required>
								<label class="col-form-label">Barangay:</label>
								<input type="text" class="form-control form-control-sm" name="barangay" placeholder="barangay" value="" required>
								<label class="col-form-label">City:</label>
								<input type="text" class="form-control form-control-sm" name="city" placeholder="city" value="" required>
								<input class="btn btn-primary btn-block button2" type="submit" name="submit" value="Save" onclick="return confirm('Are you sure?');">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="form-control" style="width: 1200px">
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h5 class="modal-title" >Update Customer</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<?php require_once 'process1.php'; ?>
							<form action="process1.php" method="post">
								<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
								<label class="col-form-label">First Name:</label>
								<input type="text" class="form-control form-control-sm" name="first_name" placeholder="first name" value="<?php echo $first_name; ?>" required>
								<label class="col-form-label">Last Name:</label>
								<input type="text" class="form-control form-control-sm" name="last_name" placeholder="last name" value="<?php echo $last_name; ?>" required>
								<label class="col-form-label">Middle Initial:</label>
								<input type="text" class="form-control form-control-sm" name="middle_initial" placeholder="middle initial" value="<?php echo $middle_initial; ?>" required>
								<label class="col-form-label">Phone Number:</label>
								<input type="text" class="form-control form-control-sm" name="phone_number" placeholder="phone number" value="<?php echo $phone_number; ?>" required>
								<label class="col-form-label">Province:</label>
								<input type="text" class="form-control form-control-sm" name="province" placeholder="province" value="<?php echo $province; ?>" required>
								<label class="col-form-label">Street:</label>
								<input type="text" class="form-control form-control-sm" name="street" placeholder="street" value="<?php echo $street; ?>" required>
								<label class="col-form-label">Barangay:</label>
								<input type="text" class="form-control form-control-sm" name="barangay" placeholder="barangay" value="<?php echo $barangay; ?>" required>
								<label class="col-form-label">City:</label>
								<input type="text" class="form-control form-control-sm" name="city" placeholder="city" value="<?php echo $city; ?>" required>
								<?php
									if ($update == true):
									echo "<script>$('#exampleModalCenter2').modal('show');</script>";
								?>
									<input class="btn btn-info btn-block button2" type="submit" name="update" value="Update" onclick="return confirm('Are you sure?');">
								<?php else: ?>
									<input class="btn btn-primary btn-block button2" type="submit" name="submit" value="Save" onclick="return confirm('Are you sure?');">
								<?php endif; ?>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
      </body>
</html>