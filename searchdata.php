<?php
if(isset($_POST['date']))
{
  include('includes/config.php');
    $date=$_POST['date'];
    echo'<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">';
    echo '<thead>';
      echo '<tr>';
        echo'<th>#</th>';
        echo '<th>Item Name</th>';
        echo '<th>Amount Sold(kgs)</th>';
        echo '<th>Total Price</th>';
        echo '<th>Time sold</th>';
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
      $sql = "SELECT * FROM sales WHERE date_sold='$date'";
      $result = mysqli_query($conn, $sql);
      $all_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $allrows=mysqli_num_rows($result);
      $result1 = mysqli_query($conn,"SELECT SUM(total_price) AS totalsum FROM sales WHERE date_sold='$date' "); 
      $row = mysqli_fetch_assoc($result1); 
      $sum = $row['totalsum'];
      $count=1;
      if($allrows>0 && $date ){
      foreach ($all_items as $item) {
       $item_name = $item['item_name'];
       $qsold = $item['quantity_sold'];
       $tp = $item['total_price'];
       $dates=$item['date_sold'];
        echo '<tr>';
        echo '<td>'.$count.'</td>';
        echo '<td>'.$item_name.'</td>'; 
        echo '<td>'.$qsold.'</td>';
        echo '<td>'.$tp.'</td>';
        echo '<td>'.$dates.'</td>'; 
      echo '</tr>'; 
      $count++;

     }
     echo '<tr><td colspan="3" style="text-align:center;">Total Amount: </td>';
      echo '<td colspan="2" style="text-decoration:bold;color:blue;">'.$sum. '</td></tr></table><br>';
      $sql = "SELECT DISTINCT item_name FROM sales WHERE date_sold = '$date'";
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
          $result1 = mysqli_query($conn,"SELECT SUM(total_price) AS totalsum,SUM(quantity_sold) AS totalsold FROM sales WHERE date_sold='$date'AND item_name='$item'"); 
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
    
    }
    else{
        echo '<tr><td colspan="5" >No records in database</td></tr>';
    }
}
   ?>