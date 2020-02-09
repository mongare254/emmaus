<?php
ini_set('display errors', 1);
error_reporting('0');
session_start();
if(!isset($_SESSION['name'])){
  header('Location:login.php');
}
elseif(isset($_SESSION['name'])){
  $cuser=$_SESSION['name'];
}
require 'logis.php';

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Emmaus| Dashboard</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
  <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
  <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >s
  <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen" >
  <link rel="stylesheet" href="css/main.css" media="screen" >
  <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body class="top-navbar-fixed">
  <div class="main-wrapper">
    <?php include('includes/topbar.php');?>
    <div class="content-wrapper">
      <div class="content-container">

        <?php include('includes/leftbar.php');?>  

        <div class="main-page">
          <div class="pagecontente">
            <div class="col-md-8 col-md-offset-2">
                
            <div class="panel-body p-20">
                <h3>ALL SALES</h3>
                <div>
                    <form action="allsales.php?search" method="POST" class="col-md-4">
                        <label>Search by date:</label>
                        <input class="form-control" placeholder="search by date.." name="search">                  </form>
                </div><br>
                <?php
              require 'includes/config.php';
              echo'<table id="example"style="margin-top:39px;" class="display table table-striped table-bordered" cellspacing="0" width="100%">';
                echo '<thead>';
                  echo '<tr>';
                    echo'<th>#</th>';
                    echo '<th>Item Name</th>';
                    echo '<th>Amount Sold(kgs)</th>';
                    echo '<th>Total Price</th>';
                    echo '<th>Date sold</th>';
                  echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                  $datetoday=date('d/m/Y');
                  $sql = "SELECT * FROM sales ORDER BY date_sold DESC";
                  $result = mysqli_query($conn, $sql);
                  $all_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                  $allrows=mysqli_num_rows($result);
                  if($allrows>0){
                  foreach ($all_items as $item) {
                   $item_id = $item['item_id'];
                   $item_name = $item['item_name'];
                   $qsold = $item['quantity_sold'];
                   $tp = $item['total_price'];
                   $date=$item['date_sold'];
                    echo '<tr>';
                    echo '<td>'.$sales_id.'</td>';
                    echo '<td>'.$item_name.'</td>'; 
                    echo '<td>'.$qsold.'</td>';
                    echo '<td>'.$tp.'</td>';
                    echo '<td>'.$date.'</td>'; 
                  echo '<tr>'; 
                 }
                }
                else{
                  echo '<tr><td colspan="5" style="text-align:center;">No sales made today</td></tr>';
                }
               echo '</tbody>';
             echo '</table>';
             ?>
           </div>
            </div>
          </div>
        </div>
        <!-- /.main-page -->


      </div>
      <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /.main-wrapper -->

  <!-- ========== COMMON JS FILES ========== -->
  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/jquery-ui/jquery-ui.min.js"></script>
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script src="js/lobipanel/lobipanel.min.js"></script>
  <script src="js/iscroll/iscroll.js"></script>

  <!-- ========== PAGE JS FILES ========== -->
 
  <script src="js/counterUp/jquery.counterup.min.js"></script>
  
  <script src="js/toastr/toastr.min.js"></script>
  

  <!-- ========== THEME JS ========== -->
  <script src="js/main.js"></script>

  <script>
    $(function(){

                // Counter for dashboard stats
                $('.counter').counterUp({
                  delay: 10,
                  time: 1000
                });

                // Welcome notification
                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr["success"]( "All daily sales are displayed here!");

              });
            </script>
          </body>
          </html>

