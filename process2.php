<?php

	$mysqli = new mysqli('localhost', 'root', '', 'kusina') or die(mysqli($mysqli));
	
	$menu_id = 0;
	$update = false;
	$menu_id = '';
	$menu_name = '';
	$menu_description = '';
	$price = '';
	$unit = '';
	
	if (isset($_POST['add'])) {
		$menu_id = $_POST['menu_id'];
		$menu_name = $_POST['menu_name'];
		$menu_description = $_POST['menu_description'];
		$price = $_POST['price'];
		$unit = $_POST['unit'];
		
		$mysqli->query("INSERT INTO menu (menu_id, menu_name, menu_description, price, unit) VALUES('$menu_id', '$menu_name', '$menu_description', '$price', '$unit')") or die($mysqli->error);
		header("location: menu.php");
	}
	if (isset($_GET['delete_id'])) {
		
		$menu_id = $_GET['delete_id'];
		$sql = "DELETE FROM menu WHERE menu_id='".$menu_id."'";
		$mysqli->query($sql) or die($mysqli->error());
		header("location: menu.php");
	}
	if (isset($_GET['editmenu'])) {
		$menu_id = $_GET['editmenu'];
		$update = true;
		$sql = "SELECT * FROM menu WHERE menu_id='".$menu_id."'";
		$result = $mysqli->query($sql) or die($mysqli->error());
		if (@count($result)==1) {
			$row = $result->fetch_array();
			$menu_id = $row['menu_id'];
			$menu_name = $row['menu_name'];
			$menu_description = $row['menu_description'];
			$price = $row['price'];
			$unit = $row['unit'];
		}
	}
	if (isset($_POST['updatemenu'])) {
		$menu_id = $_POST['menu_id'];
		$menu_name = $_POST['menu_name'];
		$menu_description = $_POST['menu_description'];
		$price = $_POST['price'];
		$unit = $_POST['unit'];

		$mysqli->query("UPDATE menu SET menu_id='$menu_id', menu_name='$menu_name', menu_description='$menu_description', price='$price', unit='$unit' WHERE menu_id='".$menu_id."'") or die($mysqli->error);
		header("location: menu.php");
	}
?>