<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "db.php";
session_start();
if (isset($_SESSION['username']) == true) {
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    //redirect to logout.php
    header('Location:logout.php'); //change yoursite.com to the name of you site!!
} else{ //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}
} else {
    header('Location: login.php');
}
$id=$_GET['id'];
$clientid="";
$clientname="";
$sql = "select * from client where clientid='$id'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
if ($count == 1) {
  while ($rows=mysqli_fetch_array($result)) {
    
  
    $clientid = $rows["clientid"];
    $clientname = $rows["clientname"];
    $contactno = $rows["contactno"];
    $address=$rows["address"];
    $email=$rows["email"];
    
  }
}
if(isset($_POST['updateclient']))
{
$clientid=$_POST['clientid'];
$clientname=$_POST['clientname'];
$contactno=$_POST['contactno'];
$address=$_POST['address'];
$email=$_POST['email'];

$insertquery = "UPDATE client SET clientid='$clientid',clientname='$clientname',contactno='$contactno',address='$address',email='$email' where clientid='$clientid'";

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Record updated Successfully.');document.location='manager-client.php'</script>";

} else {
  echo "<script>alert('Record Not Updated.')</script>";
}

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manager Client | Appeal Guru</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-employee.php"><i class="fa fa-group"></i><span>Employee</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-client.php"><i class="fa fa-group"></i><span>Client</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-employee-client.php"><i class="fa fa-user-plus"></i><span>Employee's Client</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-employee-attendance.php"><i class="far fa-clock"></i><span>Employee's Attendance</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-employee-leave.php"><i class="fas fa-business-time"></i><span>Employee's Leave</span></a><a class="nav-link" href="manager-salary.php"><i class="fas fa-file-invoice-dollar"></i><span>Employee's Salary</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-employee-report.php"><i class="fas fa-chart-bar"></i><span>Employee's Report</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-tickets.php"><i class="fa fa-ticket"></i><span>Tickets</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="manager-reviews.php"><i class="far fa-comments"></i><span>Reviews</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="chat.php"><i class="fa fa-commenting-o"></i><span>Group Chat&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="users.php"><i class="fa fa-commenting-o"></i><span>Private Chat&nbsp;</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="zoom-meeting.php"><i class="fas fa-video"></i><span>Zoom Meeting</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="addtask.php"><i class="fas fa-plus"></i><span>Add task</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="holiday.php"><i class="fas fa-calendar"></i><span>Holidays</span></a></li>
                    <li class="nav-item"><a class="nav-link " href="data.php"><i class="fas fa-database"></i><span>Data</span></a></li>
                   
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                           
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter"><?php  
                                    $id=$_SESSION['id'];
                                    $query = "SELECT id FROM tickets where priority='high'"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // it return number of rows in the table. 
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // close the result. 
                        }  ?></span><i class="fas fa-ticket-alt fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Ticket Centre</h6>
<?php
                                    
                                        

                                    
                                $sql_con = new mysqli('localhost', 'root', '', 'appealgurustaff');

if($stmt = $sql_con->prepare("SELECT id,description,employeename from tickets where priority=?")) {
$priority="high";
   $stmt->bind_param("s", $priority); 
   $stmt->execute(); 
   $stmt->bind_result($id,$description, $employeename);

   while ($stmt->fetch()) {
                                
                            ?>
                                        <a class="dropdown-item d-flex align-items-center" href="manager-tickets.php?id=<?php echo $id; ?>">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500"><?php echo "$employeename"; ?></span>
                                                <p><?php echo "$description"; ?></p>
                                            </div>
                                        </a>
<?php }} ?>
                                        <a class="dropdown-item text-center small text-gray-500" href="manager-tickets.php">Show All Tickets</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter"><?php  
                                    $id=$_SESSION['id'];
                                    $query = "SELECT id FROM task where employeeid='$id'and status='no'"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // it return number of rows in the table. 
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // close the result. 
                        }  ?></span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Task Centre</h6>
<?php
                                    
                                        

                                    
                                $sql_con = new mysqli('localhost', 'root', '', 'appealgurustaff');

if($stmt = $sql_con->prepare("SELECT id,taskdetails, taskdatetime FROM task WHERE employeeid = ? and status=?")) {
$id1=$_SESSION['id'];
$status="no";
   $stmt->bind_param("is", $id1,$status); 
   $stmt->execute(); 
   $stmt->bind_result($id,$taskdetails, $taskdatetime);

   while ($stmt->fetch()) {
                                
                            ?>
                                        <a class="dropdown-item d-flex align-items-center" href="addtask.php?id=<?php echo $id; ?>">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500"><?php echo "$taskdatetime"; ?></span>
                                                <p><?php echo "$taskdetails"; ?></p>
                                            </div>
                                        </a>
<?php }} ?>
                                        <a class="dropdown-item text-center small text-gray-500" href="addtask.php">Show All Task</a>
                                    </div>
                                </div>
                            </li>
                           
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['username']; ?></span><?php $pp = $_SESSION['filename']; echo"<img src='profiles/".$pp."' class='border rounded-circle img-profile'>"; ?></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid" data-aos="fade" data-aos-duration="1500" data-aos-once="true">
                    <h3 class="text-dark mb-4">Employee</h3>
                    <div class="card shadow card-employee">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Add Employee&nbsp;</p>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <input class="form-control" type="text" placeholder="Client Id" name="clientid" value="<?php echo $clientid;?>" required>
                                <input class="form-control" type="text" placeholder="Client Name" name="clientname" value="<?php echo $clientname;?>" required>
                                <input class="form-control" type="tel" placeholder="Contact No." name="contactno" value="<?php echo $contactno;?>" required>
                                <textarea class="form-control" placeholder="Address" name="address" required><?php echo $address;?></textarea>
                                <input class="form-control" type="email" placeholder="Email" name="email" value="<?php echo $email;?>" required>
                                <button class="btn btn-primary" type="submit" name="updateclient">Update Client</button>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow card-employee">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Client Info</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Client Id</th>
                                            <th>Client Name</th>
                                            <th>Contact No.</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                        $result=mysqli_query($con,"select * from client")or die ("query 1 incorrect.....");

                        while(list($clientid,$clientname,$contactno,$address,$email)=mysqli_fetch_array($result))
                        { 
                        echo "<tr><td>$clientid</td><td>$clientname</td><td>$contactno</td>
                        <td>$address</td><td>$email</td>

                        <td><a href='manager-clientupdate.php?id=$clientid&action=update'><button style='background: var(--bs-orange);' class='btn btn-primary edit' type='button'><span><i class='fa fa-pencil'></i></span></button></a></td>
                        <td><a href='manager-employee.php?id=$clientid&action=delete'><button style='background: var(--bs-orange);' class='btn btn-primary delete' type='button' ><span><i class='fa fa-trash'></i></span></button></a></td></tr>";
                        }?>
                                            
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
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