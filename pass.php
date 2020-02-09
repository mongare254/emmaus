<?php

require 'logis.php';
require 'includes/config.php';
if(isset($_POST['cypass'])){
	$password=$_POST['cpass'];
	$newpass =$_POST['npass'];
    $cuser=$_SESSION['name'];
    $passh=md5($password);
    $passn=md5($newpass);
    
    $sql="SELECT * FROM users WHERE password='$passh' AND username ='$cuser'";
    $result= mysqli_query($conn,$sql);
    $check = mysqli_num_rows($result);
    
    if ($check == 1){
    	mysqli_query($conn, "UPDATE users set password ='$passn' WHERE username='$cuser'");
        header('Location:changepassword.php?successpass?');
    }
    else
        header('Location:changepassword.php?successfail?');

}


?>