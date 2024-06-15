<?php
include "db.php";

session_start();
if (isset($_SESSION['id']) == true) {
    $type=$_SESSION['type'];
    if ($type == "manager") {
        header('Location:index.php');
    }else if($type == "teamleader" OR $type == "teammember"){
        header('Location:employee/index.php');
    }else if ($type == "client") {
        header('Location:client/index.php');
    }

}else if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])) {

$employeeid = $_POST["employeeid"];
$password = $_POST["password"];
$password=md5($password);
$sql = "SELECT * FROM employee WHERE employeeid = '$employeeid' AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
$sql2 = "SELECT * FROM client WHERE clientid = '$employeeid' AND password = '$password'";
    $run_query2 = mysqli_query($con,$sql2);
    $count2 = mysqli_num_rows($run_query2);
    $row2 = mysqli_fetch_array($run_query2);
if($count == 1){
                $status = "Active now";
                $sql3 = mysqli_query($conn, "UPDATE employee SET status = '{$status}' WHERE employeeid = {$row['employeeid']}");
                
                $_SESSION['type'] =$row["type"];
                $type=$_SESSION['type'];
                if ($type == "manager") {
                    $_SESSION['username'] = $row["employeename"];
                $_SESSION['id']=$row["employeeid"];
                $_SESSION['useremail']=$row["email"];
                $_SESSION['success'] = "You are now logged in";
                $_SESSION['filename'] =$row["profilepic"];

                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $_SESSION['logintime'] = $date->format('Y-m-d H:i:s a');
                    $_SESSION['logged_in'] = true; //set you've logged in
$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
$_SESSION['expire_time'] = 5*60*60; //expire time in seconds: three hours (you must change this)
                    echo "<script> location.href='index.php'; </script>" ;
                die();
                exit();
                }
                else if ($type == "teamleader" OR $type == "teammember") {
                    $_SESSION['username'] = $row["employeename"];
                $_SESSION['id']=$row["employeeid"];
                $_SESSION['useremail']=$row["email"];
                $_SESSION['success'] = "You are now logged in";
                $_SESSION['filename'] =$row["profilepic"];

                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $_SESSION['logintime'] = $date->format('Y-m-d H:i:s a');
                    $_SESSION['logged_in'] = true; //set you've logged in
$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
$_SESSION['expire_time'] = 5*60*60; //expire time in seconds: three hours (you must change this)
                    echo "<script> location.href='employee/index.php'; </script>" ;
                die();
                exit();
                }
                
}else if($count2 == 1){
    
$status = "Active now";
$sql3 = mysqli_query($conn, "UPDATE client SET status = '{$status}' WHERE clientid = {$row2['clientid']}");
$_SESSION['username'] = $row2["clientname"];
                $_SESSION['id']=$row2["clientid"];
                $_SESSION['useremail']=$row2["email"];
                $_SESSION['success'] = "You are now logged in";
                $_SESSION['filename'] =$row2["profilepicture"];
                $_SESSION['type']="client";

                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $_SESSION['logintime'] = $date->format('Y-m-d H:i:s a');
                    $_SESSION['logged_in'] = true; //set you've logged in
$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
$_SESSION['expire_time'] = 5*60*60; //expire time in seconds: three hours (you must change this)
                    echo "<script> location.href='client/index.php'; </script>" ;
                die();
                exit();

}else{
                    echo "<script>alert('Check employeeid/clientid or password')</script>";
}

}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login | Appeal Guru</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/logo.png&quot;); background-size: 100% 50%; background-repeat: no-repeat;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>
                                    <form action="" method="post" class="user">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Employeeid..." name="employeeid" required></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password" required></div>
                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit" name="submit">Login</button>
                                        <hr>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>