<?php
	$fullname=$_POST['fullname'];
	$lastname=$_POST['lastname'];
	$ticketnum=$_POST['FN'];
	$shopid=$_POST['Terminal'];
	$PI=$_POST['PI'];
	$QN=$_POST['QN'];
	
	if(!empty($fullname)||!empty($lastname)||!empty($ticketnum)||!empty($shopid)||!empty($PI)||!empty($QN))
	{
	$conn = new mysqli('localhost','root','','AIRPDB');
	if($conn->connect_error)
	{
		die('Connection Failed:'.$conn->connect_error);
	}
	else
	{
        
		$stmt=$conn->prepare("insert into Purchases(ShopID, ProductID, TicketNum)
		values(?,?,?)");
		$stmt->bind_param("iii",$shopid, $PI, $ticketnum);
                             
		if($stmt->execute())
        echo"Payment Successful!";
		$stmt->close();
		$conn->close();
	}
	}
	else
	{
		echo"All fields are required!";
		die();
	}
?>
