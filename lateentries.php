<?php
require 'includes/config.php';
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
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Emmaus|sales</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
  <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
  <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
  <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen" >
  <link rel="stylesheet" href="css/main.css" media="screen" >
  <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body>
<header style="margin:5px 0 10px 0;">
<nav class="navbar top-navbar bg-white box-shadow">
            	<div class="container-fluid">
                    <div class="row">
                        <div class="navbar-header no-padding">
                			<a class="navbar-brand" href="dashboard.php">
                			    Emmaus | Salespoint
                			</a>
                            <span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-outdent"></i></span>
                			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                				<span class="sr-only">Menu</span>
                				<i class="fa fa-ellipsis-v"></i>
                			</button>
                            <button type="button" class="navbar-toggle mobile-nav-toggle" >
                				<i class="fa fa-bars"></i>
                			</button>
                		</div>
                        <!-- /.navbar-header -->

                		<div class="collapse navbar-collapse" id="navbar-collapse-1">
                			<ul class="nav navbar-nav" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li class="hidden-sm hidden-xs"><a href="#" class="user-info-handle"><i class="fa fa-user"></i></a></li>
                                <li class="hidden-sm hidden-xs"><a href="#" class="full-screen-handle"><i class="fa fa-arrows-alt"></i></a></li>
                       
                				<li class="hidden-xs hidden-xs"><!-- <a href="#">My Tasks</a> --></li>
                               
                			</ul>
                            <!-- /.nav navbar-nav -->

                			<ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                             
                				
                				    <li><a href="logout.php" class="color-danger text-center"><i class="fa fa-sign-out"></i> Logout</a></li>
                					
                		
                            
                			</ul>
                            <!-- /.nav navbar-nav navbar-right -->
                		</div>
                		<!-- /.navbar-collapse -->
                    </div>
                    <!-- /.row -->
            	</div>
            	<!-- /.container-fluid -->
            </nav>

</header><br><br>

<section>
    <div class="container" >
       <div class="col-md-12">
           <div class="col-md-8 col-md-offset-2">
             <div>
             <?php
           //get the page's url
            $url = "http//:$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if(strpos($url, "index.php?outofstock") == true){
              echo '<div class="alert alert-warning alert-dismissible">
              <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Stock Unavailable</strong>
              </div>';
            }
            else if(strpos($url, "index.php?success") == true){
                echo '<div class="alert alert-success alert-dismissible">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sales registered successfully</strong>
                </div>';
              }
            ?>
                <form action="latehandler.php" method="POST" class="form-group">
                   <div class="col-md-10 col-md-offset-1">
                       <h3>Enter late Entries here:</h3>
                   </div>
                   <div class="col-md-10 col-md-offset-1">
                       <label>Select Item here:</label>
                       <select class="form-control" name="item" required>
                           <?php
                           require 'includes/config.php';
                             $sql = "SELECT  * FROM items";
                             $result = mysqli_query($conn, $sql);
                             $all = mysqli_fetch_all($result, MYSQLI_ASSOC);
                             foreach($all as $one){
                               echo "<option>".$one['item_name']."</option>";
                               }
                           ?>
                       </select>
                   </div>
                   <div class="col-md-10 col-md-offset-1">
                      <label>Quantity sold:</label>
                      <input class="form-control" placeholder='Quantity sold' type="number"step='0.01' name="qsold" required>
                   </div>
                   <div class="col-md-10 col-md-offset-1">
                      <label>FOR DATE:</label>
                      <input class="form-control" placeholder=' dd/mm/yyyy' type="text" name="dsold" required>
                   </div>
                   <div class="col-md-8 col-md-offset-2" style="margin-bottom:23px;">
                        <button class="btn btn-primary" type="submit" name="lentry">SUBMIT</button>
                   </div>
                </form><br><br><br><br>
                
                <div class="panel-body p-20 col-md-10 col-md-offset-1" >
                <h3 >Late Entries Made Today are displayed Here</h3><br>
              <?php
              require 'includes/config.php';
              echo'<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">';
                echo '<thead>';
                  echo '<tr>';
                    echo'<th>#</th>';
                    echo '<th>Item Name</th>';
                    echo '<th>Amount Sold(kgs)</th>';
                    echo '<th>Total Price</th>';
                    echo '<th>Date sold</th>';
                    echo '<th>Delete</th>';
                  echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                $datetoday=date('d/m/Y');
                $sql = "SELECT * FROM lateentries WHERE date_sold='$datetoday'";
                $result = mysqli_query($conn, $sql);
                $all_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $allrows=mysqli_num_rows($result);
                $result1 = mysqli_query($conn,"SELECT SUM(total_price) AS totalsum FROM lateentries WHERE date_in='$datetoday' "); 
                $row = mysqli_fetch_assoc($result1); 
                $sum = $row['totalsum'];
                if($allrows>0){
                foreach ($all_items as $item) {
                 $item_id = $item['l_id'];
                 $item_name = $item['item_name'];
                 $qsold = $item['qsold'];
                 $tp = $item['tprice'];
                 $fordate=$item['dsold'];
                  echo '<tr>';
                  echo '<td>'.$item_id.'</td>';
                  echo '<td>'.$item_name.'</td>'; 
                  echo '<td>'.$qsold.'</td>';
                  echo '<td>'.$tp.'</td>';
                  echo '<td>'.$fordate.'</td>'; 
                  echo "<td><a href='deleteitem.php?id=" . $item_id . "'><button class='btn btn-danger'>Delete</button></td>";
                echo '</tr>'; 
                echo '<tr>';
                
               }
               echo '<td colspan="3" style="text-align:center;">Total Amount: </td>';
                echo '<td colspan="2" style="text-decoration:bold;color:blue;">'.$sum. '</td>';
              }
              else{
                echo '<tr><td colspan="6" style="text-align:center;">No sales made today</td></tr>';
              }
             echo '</tbody>';
           echo '</table>';
           ?>
           </div>
             </div>
           </div>
       </div>
    </div>
</section>



<script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/jquery-ui/jquery-ui.min.js"></script>
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script src="js/lobipanel/lobipanel.min.js"></script>
  <script src="js/iscroll/iscroll.js"></script>

  <!-- ========== PAGE JS FILES ========== -->
 
  <script src="js/counterUp/jquery.counterup.min.js"></script>
  <script src="js/toastr/toastr.min.js"></script>
  <script src="js/DataTables/datatables.min.js"></script>

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
                toastr["success"]( "Enter late entries Here!");

              });
              
            </script>
</body>
</html>