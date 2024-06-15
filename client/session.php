<?php
	session_start();
	include('db.php');
	if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    //redirect to logout.php
    header('Location:logout.php'); //change yoursite.com to the name of you site!!
} else{ //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}
	if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
	header('location:../login.php');
    exit();
	}
	
	$sq=mysqli_query($conn,"select * from client where clientid='".$_SESSION['id']."'");
	$srow=mysqli_fetch_array($sq);
		
	
	
	$user=$srow['clientname'];
?>