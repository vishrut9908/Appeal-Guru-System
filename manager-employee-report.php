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
?>
<?php
 $con = mysqli_connect('localhost','root','','appealgurustaff');
 $id=$_GET['id'];
 $query = "SELECT count(*) as count_present_absent,pal,
case 
when pal='present' then 'Present'
when pal='absent' then 'Absent'
end as pal FROM attendance where employeeid='$id' group by pal ";

 $exec = mysqli_query($con,$query);
 $i=0;
 while($row = mysqli_fetch_array($exec)){
 //echo "['".$row['pal']."',".$row['count_present_absent']."],";
$label[$i] =$row["pal"];
$count[$i]=$row["count_present_absent"];
$i++;
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
    <title>Employee Report | Appeal Guru</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript"
   src="https://www.gstatic.com/charts/loader.js">
 </script>
 <script type="text/javascript">
 //google.load("visualization", "1", {packages:["corechart"]});
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawPieChart);

 /*function drawChart() {
 var data = google.visualization.arrayToDataTable([

 ['Date', 'Employee Id'],
 
 
 ]);*/

 /*var options = {
 title: 'Date wise visits'
 };
 var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
 chart.draw(data, options);

 }
*/
 function drawPieChart()
 {
  var pie=google.visualization.arrayToDataTable([
    ['attendance','Number'],
    ['<?php echo $label[0]; ?>',<?php echo $count[0]; ?>],
    ['<?php echo $label[1]; ?>',<?php echo $count[1]; ?>],

    ]);
  var header = {
    title: 'Percentage of employee attendance',
    slices:{0:{color:'#666666'},1:{color:'#006EFF'}} 
  };
  var piechart=new google.visualization.PieChart(
document.getElementById('piechart'));
  piechart.draw(pie,header)
 }
</script>
<?php 
$query2="SELECT count(*) as count_present_absent,employeename
FROM tickets group by employeename";
$exec2 = mysqli_query($con,$query2);
 $i2=0;
 while($row2 = mysqli_fetch_array($exec2)){
 //echo "['".$row['pal']."',".$row['count_present_absent']."],";
$label2[$i2] =$row2["employeename"];
$count2[$i2]=$row2["count_present_absent"];
$i2++;

 }
 $count3 = mysqli_num_rows($exec2);
?>
<script type="text/javascript">
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawPieChart1);
 function drawPieChart1()
 {
  var pie2=google.visualization.arrayToDataTable([
    ['attendance','Number'],
    <?php
$a=0;
while ($a < $count3) { 

?>
    ['<?php echo $label2[$a]; ?>',<?php echo $count2[$a]; ?>],
<?php
$a++;
}?>   

    ]);
  var header2 = {
    title: 'Percentage of employees ticket',
    slices:{0:{color:'#666666'},1:{color:'#006EFF'}} 
  };
  var piechart2=new google.visualization.PieChart(
document.getElementById('piechart2'));
  piechart2.draw(pie2,header2)
 }
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
                <div class="container-fluid">
                    <h3 class="text-dark mb-1">Employee Report of <?php echo $id=$_GET['id']; ?></h3>
                    <div class="row">
                        <div class="col-lg-7 col-xl-8">
                            <div class="card shadow mb-4">
                                <div id="piechart" style="width: 900px; height: 500px;"></div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-xl-4">
                            <div class="card shadow mb-4">
                                
                                <div class="card-body">
                                    <div id="piechart2" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Sessions list</h6>
                                    <form action="" method="post">
                                    <span><input type="date" id="selectdate" name="selectdate"></span>

                                    <span><button type="submit" name="submit" id="submit">Check</button></span>
                                    <span><p></p></span>
                                </form>
                                </div>
                                <ul class="list-group list-group-flush" style="overflow: scroll;height: 300px;">
                                    <?php
                                    if(isset($_POST['submit'])){
                                        

                                    
                                $sql_con = new mysqli('localhost', 'root', '', 'appealgurustaff');

if($stmt = $sql_con->prepare("SELECT employeeid, logintime,logouttime FROM loginrecord WHERE employeeid = ? and date(logintime)=? and date(logouttime)=?")) {
$id=$_GET['id'];
$selectdate=$_POST['selectdate'];
   $stmt->bind_param("iss", $id,$selectdate,$selectdate); 
   $stmt->execute(); 
   $stmt->bind_result($employeeid, $logintime,$logouttime);
$h=0;
   while ($stmt->fetch()) {
                                
                            ?>
                                    <li class="list-group-item">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong><?php echo "$employeeid"; ?></strong></h6><span class="text-xs">Login time: <?php echo "$logintime"; ?>  </span><span class="text-xs">Logout time: <?php echo "$logouttime"; ?> </span><span class="text-xs">Session Time : <?php $a=$logintime;
                                                    $b=$logouttime;
                                                    $hour = round((strtotime($b) - strtotime($a))/(3600),1); 
                                                    echo "$hour hours";
                                                    $h+=$hour; 
 
                                                 ?> </span>
                                            </div>
                                        </div>
                                    </li>
                                    <?php }} }?>
                                </ul>
                            </div>
                    </div>
                    <?php echo "$h";?>Hours
                   
                    <div class="card shadow card-employee">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Employee Info</p>
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
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td><strong>Employee Id</strong></td>
                                            <td><strong>Employee Name</strong></td>
                                            <td><strong>Contact No.</strong></td>
                                            <td><strong>Address</strong></td>
                                            <td><strong>Joining date</strong></td>
                                            <td><strong>Salary</strong></td>
                                            <td><strong>type</strong></td>
                                            <td><strong>Team Id</strong></td>
                                            <td><strong>Email</strong></td>
                                            <td><strong>View</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable1">
                                        <?php
                                        $result=mysqli_query($con,"select employeeid,employeename,contactno,address,joiningdate,salary,type,teamid,email from employee LIMIT $start_from, $limit")or die ("query 1 incorrect.....");

                        while(list($employeeid,$employeename,$contactno,$address,$joiningdate,$salary,$type,$teamid,$email)=mysqli_fetch_array($result))
                        { 
                        echo "<tr><td>$employeeid</td><td>$employeename</td><td>$contactno</td>
                        <td>$address</td><td>$joiningdate</td><td>$salary</td><td>$type</td><td>$teamid</td>
                        <td>$email</td>

                                            <td><a href='manager-employee-report.php?id=$employeeid'><button class='btn btn-primary' type='button' ><span><i class='fa fa-eye'></i></span></button></a></td></tr>";
                        }?>
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
<?php
$result_db = mysqli_query($conn,"SELECT COUNT(employeeid) FROM employee"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='manager-report.php?page=".$i."'>".$i."</a></li>";   
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