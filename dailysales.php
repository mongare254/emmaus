<?php
require'includes/config.php';
if(isset($_POST['sale'])){

  $itemname=$_POST['item'];
  $qsold =$_POST['qsold'];
  $datetoday=date('Y-m-d');
  $timenow=date('h:i:sa');
 
  $sql="SELECT * FROM items WHERE item_name ='$itemname'";
  $check=mysqli_query($conn,$sql);
  $result=mysqli_fetch_array($check);
  $in_store=$result['stock_bought'];

  if($qsold<=$in_store){
  $price=$result['selling_price'];
  $totalprice=$qsold *$price;
  $tp = explode('.', $totalprice);
  $tp1=$tp[1];

if($tp=25 or $tp=50 or $tp=25 or $tp=5){
  $newprice = ceil( $totalprice / 5 ) * 5;
  $sql1="INSERT INTO sales(sales_id,item_name,quantity_sold,total_price,date_sold,timenow)VALUES('','$itemname','$qsold','$newprice','$datetoday','$timenow')";
    $check1=mysqli_query($conn,$sql1);
    if($check1){
       $stock_rem=$in_store-$qsold;
       $sql2="UPDATE items SET stock_bought='$stock_rem'WHERE item_name='$itemname'";
       $check2=mysqli_query($conn,$sql2);
       if($check2){
           header('Location:index.php?success');
       }
       else{
           header("Location:index.php?failupdateitems");
       }
    }
    else{
        header('Location:index.php?failsales');
    }
}
else{
  $sqln="INSERT INTO sales(sales_id,item_name,quantity_sold,total_price,date_sold,timenow)VALUES('','$itemname','$qsold','$totalprice','$datetoday','$timenow')";
    $checkn=mysqli_query($conn,$sqln);
    if($checkn){
       $stock_remn=$in_store-$qsold;
       $sqln1="UPDATE items SET stock_bought='$stock_remn'WHERE item_name='$itemname'";
       $checkn1=mysqli_query($conn,$sqln1);
       if($checkn1){
           header('Location:index.php?success');
       }
       else{
           header("Location:index.php?failupdateitems");
       }
    }
    else{
        header('Location:index.php?failsales');
    }
}
}

  else{
      header('Location:index.php?outofstock');
  }

}


?>