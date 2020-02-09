<?php
require'includes/config.php';
if(isset($_POST['lentry'])){

  $itemname=$_POST['item'];
  $qsold =$_POST['qsold'];
  $dsold =$_POST['dsold'];
  $datetoday=date('d/m/Y');
  $timenow=date('h:i:sa');
 
  $sql="SELECT * FROM items WHERE item_name ='$itemname'";
  $check=mysqli_query($conn,$sql);
  $result=mysqli_fetch_array($check);
  $in_store=$result['stock_bought'];

  if($qsold<=$in_store){
  $price=$result['selling_price'];
  $totalprice=$qsold *$price;
  $stock_rem=$in_store-$qsold;
  $sql2="UPDATE items SET stock_bought='$stock_rem'WHERE item_name='$itemname'";
  $sql1="INSERT INTO sales(sales_id,item_name,quantity_sold,total_price,date_sold,timenow)VALUES('','$itemname','$qsold','$totalprice','$dsold','00:00:00')";
  $sqlentries="INSERT INTO lateentries(l_id,item_name,qsold,dsold,date_in,tprice)VALUES('','$itemname','$qsold','$dsold','$datetoday','$totalprice')";
  if(mysqli_query($conn, $sql2)
  &&mysqli_query($conn, $sql1)
  && mysqli_query($conn, $sqlentries)
  ){
     header('Location:lateentries.php?success');
  }
  else{
      echo "Error: " . $sqlentries . "<br>" . $conn->error;
  }
}

  else{
      header('Location:index.php?outofstock');
  }

}


?>