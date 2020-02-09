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
               
               <div>
                <?php
  //get the page's url
            $url = "http//:$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if(strpos($url, "additems.php?success") == true){
              echo '<div class="alert alert-success alert-dismissible">
              <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Registration successful</strong>
              </div>';
            }
            else if(strpos($url, "additems.php?alreadyexists") == true){
              echo '<div class="alert alert-warning alert-dismissible">
              <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Item exists</strong>
              </div>';
            }
            
            ?>
                 <h3>Register new items to stock here..</h3>
                 <div class="pagecontente">
                 <form class="form-group" method="POST" action='addits.php'>
                   <div class="placeholders">
                     <div class="col-md-8">
                       <label>ITEM NAME:</label>
                     <input type="text" name="itemname" placeholder="item name "class="form-control">
                     </div>
                     <div class="col-md-8">
                       <label>AMOUNT IN KGS:</label>
                     <input type="number" step='0.01' name="stock_bought" placeholder="Enter Stock bought in Kgs "class="form-control">
                     </div>
                     <div class="col-md-8">
                       <label>SELLING PRICE PER KG(KSHS):</label>
                     <input type="number" step='0.01' name="sp" placeholder="Enter Selling Price per kg "class="form-control">
                     </div>
                     <div class="col-md-8">
                       <label>CATEGORY:</label>
                     <input type="text"  name="cat" placeholder="Category "class="form-control" required> 
                     </div>
                     <div class="col-md-6 col-md-offset-3">
                       <button class="btn btn-primary" type="submit" name="regitem">SUBMIT</button>
                     </div>
                   </div>
                 </form>
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
                toastr["success"]( "Add item to stocks!");

              });
            </script>
          </body>
          </html>

