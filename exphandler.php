<?php
require 'includes/config.php';
if(isset($_POST['exitem'])){
    $item=strtoupper($_POST['exname']);
    $stock=sprintf("%.2f", $_POST['mspent']);
    $date=date("d/m/Y");
    
    $sql1="INSERT INTO expenses(ex_id,ex_name,ex_cost,ex_date) VALUES('','$item','$stock','$date')";
    $check=mysqli_query($conn,$sql1);
    if($check){
        header('Location:addexp.php?success');
    }
    else{
        header('Location:addexp.php?failed');
    }
}


?>