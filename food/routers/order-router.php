<?php
include '../includes/connect.php';
$user_id = $_SESSION["user_id"];
$total = 0;
$address = htmlspecialchars($_POST['address']);

$payment_type = $_POST['payment_type'];
$total = $_POST['total'];
	$sql = "INSERT INTO orders (customer_id, payment_type, address, total, description) VALUES ($user_id, '$payment_type', '$address', $total, '$description')";
	if ($con->query($sql) === TRUE){
		$order_id =  $con->insert_id;
		foreach ($_POST as $key => $value)
		{
			if(is_numeric($key)){
			$result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
			while($row = mysqli_fetch_array($result))
			{
				$price = $row['price'];
			}
				$price = $value*$price;
			$sql = "INSERT INTO order_details (order_id, item_id, quantity, price) VALUES ($order_id, $key, $value, $price)";
			$con->query($sql) === TRUE;		
			}
		}
		
			header("location: ../orders.php");
	}

?>