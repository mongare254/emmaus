
<?php
session_start();
require 'includes/config.php';
 if(isset($_POST['sitem'])){
     $item=$_POST['item'];
     $stock=$_POST['stock'];
     $mspent=$_POST['mspent'];
     $datetoday=date('d/m/Y');
     $exp_name='Purchase of '.$item;

     $sql1="SELECT * FROM items WHERE item_name='$item'";
     $check=mysqli_query($conn,$sql1);
     $result1=mysqli_fetch_array($check);
     $row=$result1['stock_bought'];
     $newstock= $row+$stock;

     $sql2="INSERT INTO purchases(purchase_id,item_name,purchase_date,quantity,amount_spent)VALUES('','$item','$datetoday','$stock','$mspent')";
     $sql3="UPDATE items SET stock_bought='$newstock' WHERE item_name='$item'";
     $sql4="INSERT INTO expenses(ex_id,ex_name,ex_cost,ex_date)VALUES('','$exp_name','$mspent','$datetoday')";
     $check1=mysqli_query($conn,$sql2);
     
     if(mysqli_query($conn, $sql1)
	&& mysqli_query($conn, $sql2)
	&& mysqli_query($conn, $sql3)
	&& mysqli_query($conn, $sql4)){
		header('Location:addpurchase.php?addsuccess');
    }
    else{
        header('Location:addpurchase.php?failed');
    }
 }
 ?>
