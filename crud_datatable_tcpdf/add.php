<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$logo = $_POST['logo'];
		$title = $_POST['title'];
		$introduce = $_POST['introduce'];
		$days = $_POST['days'];
		$price = $_POST['price'];
		$time = $_POST['time'];
		$airline = $_POST['airline'];
		$seat = $_POST['seat'];
		$number = $_POST['number'];
		$sale = $_POST['sale'];
		$sign_up = $_POST['sign_up'];
		$sql = "INSERT INTO travel_ (logo, title, introduce, days, price, time, airline, seat, number, sale, sign_up) VALUES ('$logo', '$title', '$introduce', '$days', '$price', '$time', '$airline', '$seat', '$number', '$sale', '$sign_up')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = '新增成功';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member added successfully';
		// }
		//////////////
		
		else{
			$_SESSION['error'] = 'Something went wrong while adding';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: index.php');
?>