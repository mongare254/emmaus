<?php
require 'includes/config.php';
if(isset($_POST['regitem'])){
    $item=strtoupper($_POST['itemname']);
    $stock=sprintf("%.2f", $_POST['stock_bought']);
    $date=date("d/m/Y");
    $sp=sprintf("%.2f", $_POST['sp']);
    $cat=strtoupper($_POST['cat']);

    echo $sp;
    echo '<br>'.$stock;
    $sql ="SELECT * FROM items WHERE item_name ='$item'";
    $check= mysqli_query($conn,$sql);
    $items=mysqli_num_rows($check);
    
    if ($items ==0){
       $sql1="INSERT INTO items(item_id,item_name,stock_bought,selling_price,date_stocked,category) VALUES ('','$item','$stock','$sp','$date','$cat')";
       if ($conn->query($sql1) === TRUE) {
        $sql2="INSERT INTO purchases(purchase_id,item_name,purchase_date,quantity) VALUES('','$item','$date','$stock')";
        if ($conn->query($sql2) === TRUE) {
            header('Location:additems.php?success');
        }
        else{
            header('Location:additems.php?purchasefail?'); 
        }
    }
    else{
        echo "Error: " . $sql1 . "<br>" . $conn->error;
        header('Location:additems.php?errors?');
    }
    }
    else{
        header('Location:additems.php?alreadyexists?');
    }

}


?>