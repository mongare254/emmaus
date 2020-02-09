<?php
require 'includes/config.php';
$datetoday=date('d/m/Y');
//fetches all items sold today
$sql = "SELECT DISTINCT item_name FROM sales ";
$result = mysqli_query($conn, $sql);
$sales = mysqli_fetch_all($result, MYSQLI_ASSOC);
$ct=1;
$sqlsump="SELECT SUM(total_price) as gensum FROM sales";
$checksump=mysqli_query($conn,$sqlsump);
$rows=mysqli_fetch_assoc($checksump);
$sumfar=$rows['gensum'];
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
    $result1 = mysqli_query($conn,"SELECT SUM(total_price) AS totalsum,SUM(quantity_sold) AS totalsold FROM sales WHERE  item_name='$item'"); 
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
echo '<tr><td rowspan="2">Total Sales So far:</td><td rowspan="2" style="color:green; font-size:26px;">'.$sumfar.'</td></tr>';
// }
// else{
//   echo '<tr><td colspan="5" style="text-align:center;">No sales for the day</td></tr>';
// }
echo '</tbody>';
             echo '</table>';
?>