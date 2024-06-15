<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("db.php");
session_start();
if (isset($_SESSION['username']) == true) {
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    //redirect to logout.php
    header('Location:logout.php'); //change yoursite.com to the name of you site!!
} else{ //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}
} else {
    header('Location:../login.php');
}
if (isset($_POST['addreview'])) {
    $reviewfor=$_POST['reviewfor'];
    if ($reviewfor == "employee") {
        $employeename=$_POST['employeename'];
        $id=$_SESSION['id'];
        $review=$_POST['review'];
        $selectdate=new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $selectdate=$selectdate->format('Y-m-d');
        $insertquery = "INSERT INTO review(clientid,reviewfor,reviewforname,review,reviewdate) VALUES ('$id','$reviewfor','$employeename','$review','$selectdate')";

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Review recorded Successfully.')</script>";
} else {
  echo "<script>alert('Review not recorded.')</script>";
}
    }else if ($reviewfor == "company") {
        $id=$_SESSION['id'];
        $review=$_POST['review'];
        $selectdate=new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $selectdate=$selectdate->format('Y-m-d');
        $insertquery = "INSERT INTO review(clientid,reviewfor,reviewforname,review,reviewdate) VALUES ('$id','$reviewfor','$reviewfor','$review','$selectdate')";

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Review recorded Successfully.')</script>";
} else {
  echo "<script>alert('Review not recorded.')</script>";
}
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard | Appeal Guru</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#myModal").modal('show');
        });
         
    </script>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: var(--bs-orange);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Appeal Guru</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="clients-profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="chat.php"><i class="fas fa-window-maximize"></i><span>Chat Messenger</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="clients-tickets.php"><i class="fa fa-ticket"></i><span>Tickets</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                           
                            
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['username']; ?></span><?php $pp = $_SESSION['filename']; echo"<img src='../profiles/".$pp."' class='border rounded-circle img-profile'>"; ?></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

<script type="text/javascript">
    function showemployeename() {
        var reviewfor= document.getElementById("reviewfor");
        var employeename = document.getElementById("employeename");
        
        if (reviewfor.value=="employee") {
            employeename.style.display="block";
        }else{
            employeename.style.display="none";
            

    }
        }
</script>
<?php 
$selectdate=new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$selectdate=$selectdate->format('Y-m-d');

$dateString = $selectdate;

//Last date of current month.
$lastDateOfMonth = date("Y-m-t", strtotime($dateString));

                            ?>
                            <?php if($selectdate == $lastDateOfMonth){ ?>
               <?php echo"<div id='myModal' class='modal fade'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title'>Feedback / Review</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick='myFunction()'>&times;</button>
                            </div>
                            <div class='modal-body'>
                            <form action='' method='post'>
                                <select class='form-control' onchange = 'showemployeename()' name='reviewfor' id='reviewfor'>
                                    <optgroup label='Select Reviewer'>
                                        <option value='0' selected>--Select option--</option>
                                        <option value='employee'>Employee</option>
                                        <option value='company'>Company</option>
                                    </optgroup>
                                </select>
                                <textarea class='form-control' placeholder='Employee name' style='display:none;' name='employeename' id='employeename'></textarea>
                                <textarea class='form-control' placeholder='Feedback / Review' name='review'></textarea>
                            </div>
                            <div class='modal-footer'><button class='btn btn-primary' type='submit' name='addreview'>Submit</button></div>
                            </form>
                        </div>
                    </div>
                </div>"?>
                    <?php } ?>
<script>
function myFunction() {
  $('#myModal').modal('hide');
}
</script>
                
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Employee's Online</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php  $query = "SELECT employeeid FROM employee where status='Active now'"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // it return number of rows in the table. 
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // close the result. 
                        }  ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Tickets</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php
                                                $id=$_SESSION['id'];
                                              $query = "SELECT id FROM tickets where clientid='$id'"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // it return number of rows in the table. 
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // close the result. 
                        }  ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-ticket-alt fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pending Tickets</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php  
                                            $id=$_SESSION['id'];
                                            $query = "SELECT id FROM tickets where clientid='$id' and status='not resolved'"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // it return number of rows in the table. 
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // close the result. 
                        }  ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-ticket-alt fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>

            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © <a href="https://releff.com/" target="_blank" style="text-decoration: none; color: grey;">Releff Technologies</a> 2021</span></div>

                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>