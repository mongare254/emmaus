<?php
session_start();
if(isset($_POST['login'])){
require ('includes/config.php');
$username= $_POST['username'];
$password1= $_POST['password'];
$password=md5($password1);

$sql="SELECT * FROM users WHERE username ='$username' AND password ='$password'";
$result=mysqli_query($conn,$sql);
$check=mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);
if ($check==1){
    if ($row['type'] == 'admin'){
		$_SESSION['name']=$row['username'];
    	header('Location:dashboard.php');
    }
    else{
    	$_SESSION['name']=$row['username'];
    	header('Location:index.php');
    }
}
else{
	header('Location:login.php?wrongdetails');
}
}
?>