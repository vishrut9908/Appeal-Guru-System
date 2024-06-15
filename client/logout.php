<?php
include"db.php";
session_start();
$clientid=$_SESSION["id"];
$status = "Offline now";
$sql = mysqli_query($conn, "UPDATE client SET status = '{$status}' WHERE clientid={$clientid}");
echo "<script>alert('Logged out succesfully')</script>";
  
header('Location: ../login.php'); 
unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["useremail"]);







	




   

?>
