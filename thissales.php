<?php
require 'includes/config.php';
$datetoday=date('Y-m-d');
//fetches all items sold today
$sql = "SELECT DISTINCT item_name FROM sales WHERE date_sold = '$datetoday'";
$result = mysqli_query($conn, $sql);
$sales = mysqli_fetch_all($result, MYSQLI_ASSOC);
$ct=1;
echo '<div class="panel-body p-20">';
                echo '<h3>SUMMARY OF SALES</h3><br>';
              require 'includes/config.php';
              echo'<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">';
                echo '<thead>';
                  echo '<tr>';
                  echo '<th>#</th>';
                    echo '<th>Item Name</th>';
                    echo '<th>Amount Sold(kgs)</th>';
                    echo '<th>Total Price</th>';
                  echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
// if(mysqli_num_rows($sales)>0){
foreach($sales as $sale){
    $item=$sale['item_name'];
    $result1 = mysqli_query($conn,"SELECT SUM(total_price) AS totalsum,SUM(quantity_sold) AS totalsold FROM sales WHERE date_sold='$datetoday'AND item_name='$item'"); 
    $row = mysqli_fetch_assoc($result1); 
    $sumprice = $row['totalsum'];
    $sumsold = $row['totalsold'];
    echo '<tr>';
    echo '<td>'.$ct.'</td>';
    echo '<td>'.$item.'</td>';
    echo '<td>'.$sumsold.'</td>'; 
    echo '<td>'.$sumprice.'</td>';
    echo '</tr>';
    $ct++;
}
// }
// else{
//   echo '<tr><td colspan="5" style="text-align:center;">No sales for the day</td></tr>';
// }
echo '</tbody>';
             echo '</table>';
?>