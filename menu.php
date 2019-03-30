<?php  
	session_start();
	
	if(isset($_POST['btn_search']))
	{
    $search = $_POST['search'];
		// search in all table columns
		// using concat mysql function
		$query = "SELECT * FROM `menu` WHERE CONCAT(`menu_id`, `menu_name`, `menu_description`, `price`, `unit`) LIKE '%".$search."%'";
		$search_result = filterTable($query);
    
	}
	else {
		$query = "SELECT * FROM `menu`";
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
					<li class="nav-item">
						<a class="nav-link" href="customer.php">Customer</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="menu.php">Menu <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="order_reports.php">Order</a>
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
						<div class="desc"><b id="logout"><a href="logout.php">Log Out</a></b></div>
					</div>
				</div>
			</form>
		</nav>
		
		<div class="container" style="padding-top:20px">
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">Menu List</a>
				<form action="menu.php" method="post" class="form-inline my-2 my-lg-0">
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
						<th>Price</th>
						<th>Unit</th>
						<th>Action</th>
						</tr>
					</thead>
					<?php while($row = mysqli_fetch_array($search_result)):?>
					<tbody>
						<tr>
							<td><?php echo $row['menu_id'];?></td>
							<td><?php echo $row['menu_name'];?></td>
							<td style="float:center"><?php echo "&#8369;" .$row['price'] ;?></td>
							<td><?php echo $row['unit'];?></td>
							<td>
								<div class="btn-group">
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									
								</button>
									<div class="dropdown-menu">
									<a data-toggle="modal" data-target="#exampleModalCenter1" class="dropdown-item">Add Customer</a>
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
			<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="form-control" style="width: 1200px">
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h5 class="modal-title" >Add Menu</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							
							<form action="process2.php" method="post">
								<div class="row">
									<div class="col">
										<label>Menu ID:</label>
										<input type="text" class="form-control form-control-sm" name="menu_id" placeholder="menu id" value="" required>
										<label>Menu Name:</label>
										<input type="text" class="form-control form-control-sm" name="menu_name" placeholder="menu name" value="" required>
									</div>
								</div>
								<div class="row" style="padding-top:10px">
									<div class="col">
										<label>Description:</label></br>
										<textarea class="form-control" rows="5" name="menu_description" required>
										</textarea>
									</div>
								</div>
								<div class="row" style="padding-top:10px">
									<div class="col-sm-6">
										<label>Price:</label>
										<input type="float" class="form-control form-control-sm" name="price" placeholder="price" value="" required>
									</div>
									<div class="col-sm-6">
										<label>Unit:</label>
										<select type="text" class="form-control form-control-sm" name="unit" placeholder="unit" value="" required>
											<option value="Dozen">Dozen</option>
											<option value="Packs">Packs</option>
											<option value="Tray">Tray</option>
											<option value="Kg">Kg</option>
											<option value="Dozen">Pack Lunch</option>
											<option value="Serve">Serve</option>
										</select>
									</div>
								</div>
								<div class="row" style="padding-top:20px">
									<div class="col">
										<input class="btn btn-primary btn-block button2" type="submit" name="add" value="Save Menu" onclick="return confirm('Are you sure?');">
									</div>
								</div>
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
							<h5 class="modal-title" >Update Menu</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<?php require_once 'process2.php'; ?>
							<form action="process2.php" method="post">
								<div class="row">
									<div class="col">
										<input type="hidden" name="menus_id" value="<?php echo $menu_id; ?>">
										<label>Menu ID:</label>
										<input type="text" class="form-control form-control-sm" name="menu_id" placeholder="menu id" value="<?php echo $menu_id; ?>" required>
										<label>Menu Name:</label>
										<input type="text" class="form-control form-control-sm" name="menu_name" placeholder="menu name" value="<?php echo $menu_name; ?>" required>
									</div>
								</div>
								<div class="row" style="padding-top:10px">
									<div class="col">
										<label>Description:</label></br>
										<textarea class="form-control" rows="5" name="menu_description" placeholder="description" value="" required><?php echo $menu_description; ?></textarea>
									</div>
								</div>
								<div class="row" style="padding-top:10px">
									<div class="col-sm-6">
										<label>Price:</label>
										<input type="decimal" class="form-control form-control-sm" name="price" placeholder="price" value="<?php echo $price; ?>" required>
									</div>
									<div class="col-sm-6">
										<label>Unit:</label>
										<input type="text" class="form-control form-control-sm" name="unit" placeholder="unit" value="<?php echo $unit; ?>" required>
									</div>
								</div>
								<div class="row" style="padding-top:20px">
									<div class="col">
									<?php
										if ($update == true):
										echo "<script>$('#exampleModalCenter2').modal('show');</script>";
									?>
										<input class="btn btn-info btn-block button2" type="submit" name="updatemenu" value="Update" onclick="return confirm('Are you sure?');">
									<?php else: ?>
										<input class="btn btn-primary btn-block button2" type="submit" name="submit" value="Save" onclick="return confirm('Are you sure?');">
									<?php endif; ?>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="example_addorders" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="form-control" style="width: 1200px">
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h5 class="modal-title" >Add New Order</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							
							<form action="process1.php" method="post">
								<label class="col-form-label">Order ID:</label>
								<input type="text" class="form-control form-control-sm" name="order_id" placeholder="Order Id" value="" required>
								<label class="col-form-label">Customer Name:</label>
								<select name="customer_id" class="form-control" required>
									<?php
										include_once 'db.php';
										$id = $_SESSION['id'];
										$sql = "SELECT * 
											FROM customer";
										$result = mysqli_query($con, $sql);
										$resultCheck = mysqli_num_rows($result);
									
										if ($resultCheck > 0) {
											while ($row = mysqli_fetch_assoc($result)) {
									?>
									
										<option value="<?php echo $row["customer_id"];?>"><?php echo $row["first_name"];?></option>
									<?php		}
					
									}
									?>
								</select>
								<input class="btn btn-primary btn-block button2" type="submit" name="add" value="Add to order" onclick="return confirm('Are you sure?');">
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