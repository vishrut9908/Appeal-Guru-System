<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("db.php");
session_start();
if (isset($_SESSION['username']) == true and $_SESSION['type'] == "manager") {
    
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    //redirect to logout.php
    header('Location:logout.php'); //change yoursite.com to the name of you site!!

} else{ //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
} 
}else {
    header('Location: login.php');
}
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{

$tname=$_GET['tname'];
/*this is delet query*/
mysqli_query($con,"truncate table $tname")or die("query is incorrect...");
header('Location: data.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Database | Appeal Guru</title>
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
                    <li class="nav-item"><a class="nav-link active" href="data.php"><i class="fas fa-database"></i><span>Data</span></a></li>
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
                <div class="container-fluid">
                    <h3 class="text-dark mb-1">Database Download</h3>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Attendance Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="attendanceexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Attendance Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=attendance&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Attendance Data</a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Group Chat Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="chatexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Chat Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button"  href="data.php?tname=chat&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Chat Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Files Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="filesexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Files Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=files&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete FIles Data</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Leaves Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="leavesexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Leaves Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=leaves&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Leaves Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Login Record Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="loginexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Login Record Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=loginrecord&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Login Record Data</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Meetings Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="meetingsexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Meetings Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=meetings&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Meetings Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Salary Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="salaryexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Salary&nbsp; Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=salary&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Salary Data</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Task Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="taskexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Task Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=task&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Task Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Tickets Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="ticketsexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Tickets Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=tickets&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Tickets Data</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Reviews/Feedback Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="reviewsexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Reviews/Feedback Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=review&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete Reviews/Feedback Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Private Chat Data</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="privatechatexport.php" style="background: var(--bs-orange);"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download P-Chat Data</a></li>
                                    <li class="list-group-item"><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="data.php?tname=messages&action=delete" 
    onclick="return confirm('Are you sure ?');" style="background: var(--bs-orange);"><i class="far fa-trash-alt fa-sm text-white-50"></i>&nbsp;Delete P-Chat Data</a></li>
                                </ul>
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