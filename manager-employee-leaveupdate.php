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
    header('Location: login.php');
}
$id=$_GET['id'];
$employeeid="";
$sql = "select * from leaves where id='$id'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
if ($count == 1) {
  while ($rows=mysqli_fetch_array($result)) {
    
    $employeeid = $rows["aby"];
    
  }
}

if (isset($_POST['updateleave']) && $_GET['action']=='accept') {
$reason=$_POST['reason'];
$startingdate=$_POST['startingdate'];
$endingdate=$_POST['endingdate'];
$action=$_GET['action'];
$id=$_GET['id'];
$arby=$_SESSION['id'];
$insertquery = "UPDATE leaves SET ar='$action',arby='$arby',rreason='$reason' where id='$id'";
$startdate=strtotime($startingdate);
$enddate=strtotime($endingdate);
$datediff = $enddate - $startdate;
$i=0;
$days=round($datediff / (60 * 60 * 24));
while($i<=$days){
    $employeeid=$_POST['employeeid'];
    $startdate=$startingdate;
    $startdate= date('Y-m-d', strtotime($startdate. "+ $i days"));
    $insertsql = "INSERT into attendance (day,pal, employeeid)
                  VALUES('$startdate','leave', $employeeid)";
    mysqli_query($con,$insertsql);
    $i=$i+1;

}

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Record updated Successfully.');document.location='manager-employee-leave.php'</script>";

} else {
  echo "<script>alert('Record Not Updated.')</script>";
}
}
else if (isset($_POST['updateleave']) && $_GET['action']=='reject') {
$reason=$_POST['reason'];
$action=$_GET['action'];
$id=$_GET['id'];
$arby=$_SESSION['id'];
$insertquery = "UPDATE leaves SET ar='$action',arby='$arby',rreason='$reason' where id='$id'";

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Record updated Successfully.');document.location='manager-employee-leave.php'</script>";

} else {
  echo "<script>alert('Record Not Updated.')</script>";
}
}
$id=$_GET['id'];
$sql = "select startingdate,endingdate from leaves where id='$id'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
if ($count == 1) {
  while ($rows=mysqli_fetch_array($result)) {
    
  
    $startingdate = $rows["startingdate"];
    $endingdate = $rows["endingdate"];
    
    
  }
}
$limit = 10;  
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
    } 
    else{ 
    $page=1;
    };  
$start_from = ($page-1) * $limit;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
<script src=
"https://code.jquery.com/jquery-3.2.1.slim.min.js" 
                integrity=
"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
                crossorigin="anonymous">
      </script>
        <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
                integrity=
"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
                crossorigin="anonymous">
      </script>
        <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
                integrity=
"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous">
      </script>
        <script src=
"https://code.jquery.com/jquery-3.5.1.js"
                integrity=
"sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" 
                crossorigin="anonymous">
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
                <div class="card-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <input class="form-control" type="text" value="<?php echo $employeeid; ?>" placeholder="Employee ID" name="employeeid" required>
                                <input class="form-control" type="date" value="<?php echo $startingdate; ?>" placeholder="Starting date" name="startingdate" required>
                                <input class="form-control" type="date" value="<?php echo $endingdate; ?>" placeholder="Ending date" name="endingdate" required>
                                    <textarea class="form-control" placeholder="Reason" name="reason" required></textarea>
                                    <button class="btn btn-primary" type="submit" name="updateleave">Submit</button>
                            </form>
                        </div>
                <div class="container-fluid" data-aos="fade" data-aos-duration="1500" data-aos-once="true">
                    <h3 class="text-dark mb-4">Employee's Leave</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Employee's Leave Info</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" id="searchfilter" onkeyup="myFunction()" ></label></div>
                                </div>
                            </div>
                            <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchfilter");
  filter = input.value.toUpperCase();
  table = document.getElementById("dataTable1");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Applied By</th>
                                            <th>Subject</th>
                                            <th>Starting date</th>
                                            <th>Ending date</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable1">
                                    <?php
                                        $result=mysqli_query($con,"select id,aby,subject,startingdate,endingdate,message from leaves LIMIT $start_from, $limit")or die ("query 1 incorrect.....");

                        while(list($id,$aby,$subject,$startingdate,$endingdate,$message)=mysqli_fetch_array($result))
                        { 
                        echo "<tr><td class='id'>$id</td><td class='applyby'>$aby</td><td class='subject'>$subject</td>
                        <td class='startingdate'>$startingdate</td><td class='endingdate'>$endingdate</td><td class='message'>$message</td>

                    </tr>";
                        }?>
                                            
                                        
                                    </tbody>
                                    
        
                                    
                                </table>
                            </div>
                            <script>
            $(function () {
                // ON SELECTING ROW
                $(".gfgselect").click(function () {
   //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
                    var a =
             $(this).parents("tr").find(".id").text();
                    var c =
             $(this).parents("tr").find(".applyby").text();
                    var d =
             $(this).parents("tr").find(".subject").text();
                    var e = 
             $(this).parents("tr").find(".startingdate").text();
             var f = 
             $(this).parents("tr").find(".endingdate").text();
             var g = 
             $(this).parents("tr").find(".message").text();
                    var p = "";
                    // CREATING DATA TO SHOW ON MODEL
                    p += 
              "<p id='a' name='id' >ID: "
                      + a + " </p>";
                    
                    p +=
              "<p id='c' name='applyby'>Applied by: " 
                      + c + "</p>";
                    p += 
              "<p id='d' name='subject' >Subject: "
                      + d + " </p>";
                    p += 
              "<p id='e' name='startingdate' >From: "
                      + e + " </p>";
                      p += 
              "<p id='f' name='endingdate' >To: "
                      + f + " </p>";
                      p += 
              "<p id='g' name='message' >Message: "
                      + g + " </p>";
                    //CLEARING THE PREFILLED DATA
                    $("#divGFG").empty();
                    //WRITING THE DATA ON MODEL
                    $("#divGFG").append(p);
                });
            });
        </script>
                            <!-- CREATING BOOTSTRAP MODEL -->
        <div class="modal fade" 
             id="gfgmodal"
             tabindex="-1"
             role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- MODEL TITLE -->
                        <h2 class="modal-title"
                            id="gfgmodallabel">
                          Selected row</h2>
                        <button type="button" 
                                class="close"
                                data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">
                              ×</span>
                        </button>
                    </div>
                    <!-- MODEL BODY -->
                    <div class="modal-body">
                        <div class="GFGclass" 
                             id="divGFG"></div>
                        <div class="modal-footer">
         <!-- The close button in the bottom of the modal -->
                            <button type="button"
                                    class="btn btn-secondary" 
                                    data-dismiss="modal">
                              Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                   <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
<?php
$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM leaves"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='manager-employee-leaveupdate.php?page=".$i."'>".$i."</a></li>";   
}
echo $pagLink . "</ul>";  
?>
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