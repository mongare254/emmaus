<?php
require 'includes/config.php';
              echo'<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">';
                echo '<thead>';
                  echo '<tr>';
                  echo '<th>#</th>';
                    echo '<th>Item Name</th>';
                    echo '<th>Amount</th>';
                  echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
    $result1 = mysqli_query($conn,"SELECT SUM(total_price) AS totalsum FROM sales "); 
    $row = mysqli_fetch_assoc($result1); 
    $sumprice = $row['totalsum'];
    $result = mysqli_query($conn,"SELECT SUM(ex_cost) AS totalsum1 FROM expenses"); 
    $row1 = mysqli_fetch_assoc($result); 
    $sumprice1 = $row1['totalsum1'];
    $ct=1;
    $net=$sumprice-$sumprice1;
    echo '<tr>';
    echo '<td>'.$ct.'</td>';
    echo '<td>Total Sales</td>';
    echo '<td>'.$sumprice.'</td>';
    echo '</tr>';
    $ct++;
    echo '<tr>';
    echo '<td>'.$ct.'</td>';
    echo '<td>Total Expenses</td>';
    echo '<td>'.$sumprice1.'</td>';
    echo '</tr>';

echo '<tr><td rowspan="1">Net Profit/Loss:</td><td rowspan="2" style="color:green; font-size:26px;">'.$net.'</td></tr>';

echo '</tbody>';
             echo '</table>';
?>

