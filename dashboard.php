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
        <title>Emmaus Shop
             Management System | Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
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
                        <div class="col-md-8 col-md-offset-2">
                            <div style="margin:23px;" id="exampl">
                                <h3 style="color:violet; text-decoration:underline;">TODAY'S SALES</h3>
                                <?php
              require 'includes/config.php';
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
                  $datetoday=date('d/m/Y');
                  $sql = "SELECT * FROM sales WHERE date_sold='$datetoday'";
                  $result = mysqli_query($conn, $sql);
                  $all_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                  $allrows=mysqli_num_rows($result);
                  $result1 = mysqli_query($conn,"SELECT SUM(total_price) AS totalsum FROM sales WHERE date_sold='$datetoday' "); 
                  $row = mysqli_fetch_assoc($result1); 
                  $sum = $row['totalsum'];
                  $count=1;
                  if($allrows>0){
                  foreach ($all_items as $item) {
                   $item_id = $item['item_id'];
                   $item_name = $item['item_name'];
                   $qsold = $item['quantity_sold'];
                   $tp = $item['total_price'];
                   $timenow=$item['timenow'];
                    echo '<tr>';
                    echo '<td>'.$count.'</td>';
                    echo '<td>'.$item_name.'</td>'; 
                    echo '<td>'.$qsold.'</td>';
                    echo '<td>'.$tp.'</td>';
                    echo '<td>'.$timenow.'</td>'; 
                  echo '</tr>'; 
                  $count++;
  
                 }
                 echo '<tr><td colspan="3" style="text-align:center;">Total Amount: </td>';
                  echo '<td colspan="2" style="text-decoration:bold;color:blue;">'.$sum. '</td></tr>';
                  echo '<tr><td colspan="5" align="center"><i class="fa fa-print fa-2x" aria-hidden="true" style="cursor:pointer" OnClick="CallPrint(this.value)" ></i></td></tr>';
                  echo '<tr><td colspan="5" style="margin-left:50%;"><form class="form-inline" method="post" action="generate_pdf.php">
                  <button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary"><i class="fa fa-pdf"" aria-hidden="true"></i>
                  Generate PDF</button>
                  </form></td></tr>';
                }
                else{
                  echo '<tr><td colspan="5" style="text-align:center;">No sales made today</td></tr>';
                }
               echo '</tbody>';
             echo '</table>';
             ?>
             <?php include 'thissales.php';?>
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
        <script src="js/prism/prism.js"></script>
        <script src="js/waypoint/waypoints.min.js"></script>
        <script src="js/counterUp/jquery.counterup.min.js"></script>
        <script src="js/amcharts/amcharts.js"></script>
        <script src="js/amcharts/serial.js"></script>
        <script src="js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="js/amcharts/themes/light.js"></script>
        <script src="js/toastr/toastr.min.js"></script>
        <script src="js/icheck/icheck.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script src="js/production-chart.js"></script>
        <script src="js/traffic-chart.js"></script>
        <script src="js/task-list.js"></script>
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
                toastr["success"]( "Welcome to Emmaus Shop Management System!");

            });
        </script>
        <script>
            $(function($) {

            });


            function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
    </body>
</html>

