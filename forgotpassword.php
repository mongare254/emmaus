<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
    <link rel="stylesheet" href="css/main.css" media="screen" >
    <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body class="">
    <div class="main-wrapper">
<?php echo date('Y-m-d') ?>
        <div class="">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <section class="section">
                        <div class="row mt-40">
                            <div class="col-md-10 col-md-offset-1 pt-50">
                                <h1 align="center">Emmaus Investments</h1>
                                <?php
  
                        $url = "http//:$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if(strpos($url, "login.php?wrongdetails") == true){
                            echo '<div class="alert alert-danger alert-dismissible" style="text-align:center;">
                            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Wrong details! Try Again!</strong>
                            </div>';
                        }
                        ?>
                                <div class="row mt-30 ">
                                    <div class="col-md-11">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title text-center">
                                                    <h4>Password Reset</h4>
                                                </div>
                                            </div>
                                            <div class="panel-body p-20">

                                                <div class="section-title">
                                                    <p style="color: green;text-decoration: underline;">Provide your email address or username below:</p>
                                                </div>

                                                <form class="form-horizontal" method="post" action="logis.php">
                                                   <div class="form-group">
                                                      <label>Username/Email Adddress:</label>
                                                      <div class="col-sm-10">
                                                         <input type="text" name="username" class="form-control" placeholder="UserName/Email Address">
                                                     </div>
                                                 </div>
                                            
                                             <div class="form-group mt-20">
                                              <div class="col-sm-offset-2 col-sm-10">

                                                 <button type="submit" name="semail" class="btn btn-primary btn-labeled pull-left">Submit<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                             </div>
                                         </div>
                                     </form>




                                 </div>
                             </div>
                             <!-- /.panel -->
                             <p class="text-muted text-center"><small>&copy;&nbsp;<?php echo date('Y')?> All rights reserved</small></p>
                         </div>
                         <!-- /.col-md-11 -->
                     </div>
                     <!-- /.row -->
                 </div>
                 <!-- /.col-md-12 -->
             </div>
             <!-- /.row -->
         </section>

     </div>
     <!-- /.col-md-6 -->
 </div>
 <!-- /.row -->
</div>
<!-- /. -->

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

<!-- ========== THEME JS ========== -->
<script src="js/main.js"></script>
<script>
    $(function(){

    });
</script>

<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>
</html>
