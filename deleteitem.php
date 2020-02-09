<?php
require 'includes/config.php';

// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get the 'id' variable from the URL
$sales_id = $_GET['id'];

//get the sales details 
$sql = "SELECT * FROM sales WHERE sales_id = '$sales_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$qsold = $row['quantity_sold'];
$item_name=$row['item_name'];

//get item stock
$sql1="SELECT *FROM items WHERE item_name= '$item_name'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);
$stock_rem=$row1['stock_bought'];
$upstock=$stock_rem+$qsold;


//delete sale from the sales table
$sqlsales = "DELETE FROM sales WHERE sales_id = '$sales_id'";
//delete lec from lecturers table
$sqlstock="UPDATE items SET stock_bought='$upstock'WHERE item_name = '$item_name'";


	if(mysqli_query($conn, $sqlsales)
	&& mysqli_query($conn, $sqlstock)){
		header('Location:index.php?deletesuccess');
	}
}