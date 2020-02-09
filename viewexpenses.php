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
             <br><br><br>
             <div class="panel">
              <div class="panel-heading">
               <div class="panel-title">
                 <h3>All purchases</h3>
               </div>
             </div>
             <div class="panel-body p-20">
             <?php

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 8;
$offset = ($pageno-1) * $no_of_records_per_page;

$conn=mysqli_connect("localhost","root","","emmauss");
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
echo '<div class="panel-body p-20">';

echo'<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">';
  echo '<thead>';
    echo '<tr>';
      echo'<th>#</th>';
      echo '<th>Expense Name</th>';
      echo '<th>Expense Cost</th>';
      echo '<th>Expense Date</th>';
    echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
$total_pages_sql = "SELECT COUNT(*) FROM expenses";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM expenses ORDER BY ex_date DESC LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conn,$sql);
$all_items = mysqli_fetch_all($res_data, MYSQLI_ASSOC);
          $count=1;
          foreach ($all_items as $item) {
           $ex_name = $item['ex_name'];
           $exdate = $item['ex_date'];
           $amspend= $item['ex_cost'];
            echo '<tr>';
            echo '<td>'.$count.'</td>';
            echo '<td>'.$ex_name.'</td>'; 
            echo '<td>'.$amspend.'</td>';
            echo '<td>'.$exdate.'</td>'; 
          echo '<tr>'; 
          $count++;
         }
         echo '</tbody>';
     echo '</table>';
mysqli_close($conn);
?>
<ul class="pagination">
<li><a href="?pageno=1">First</a></li>
<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
</li>
<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
</li>
<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
           </div>
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
                toastr["success"]( "All purchases made in stock are displayed here!");

              });
            </script>
            <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
          </body>
          </html>

