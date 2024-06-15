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
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{

$id=$_GET['id'];
/*this is delet query*/
mysqli_query($con,"delete from employee where employeeid=$id")or die("query is incorrect...");
}
if(isset($_POST['addemployee']))
{
    $employeeid=$_POST['employeeid'];
    $employeename=$_POST['employeename'];
    $birthdate=$_POST['birthdate'];
    $contactno=$_POST['contactno'];
    $emergencycontactname=$_POST['emergencycontactname'];
    $emergencycontactnumber=$_POST['emergencycontactnumber'];
    $address=$_POST['address'];
    $joiningdate=$_POST['joiningdate'];
    $designation=$_POST['designation'];
    $salary=$_POST['salary'];
    $type=$_POST['type'];
    $team=$_POST['team'];
    $teamno=$_POST['teamno'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    if ($type=="teamleader") {
        $insertquery = "INSERT INTO employee(employeeid,employeename,birthdate,contactno,emergencycontactname,emergencycontactnumber,address,joiningdate,designation,salary,type,teamid,email,password) VALUES ('$employeeid','$employeename','$birthdate','$contactno','$emergencycontactname','$emergencycontactnumber','$address','$joiningdate','$designation','$salary','$type','$teamno','$email','$password')";

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Record Inserted Successfully.')</script>";
} else {
  echo "<script>alert('Record Not Inserted.')</script>";
}

    }else if ($type=="teammember") {
        $insertquery1="INSERT INTO employee(employeeid,employeename,birthdate,contactno,emergencycontactname,emergencycontactnumber,address,joiningdate,designation,salary,type,teamid,email,password) VALUES ('$employeeid','$employeename','$birthdate','$contactno','$emergencycontactname','$emergencycontactnumber','$address','$joiningdate','$designation','$salary','$type','$team','$email','$password')";

if(mysqli_query($con,$insertquery1)) {
  echo "<script>alert('Record Inserted Successfully.')</script>";
} else {
  echo "<script>alert('Record Not Inserted.')</script>";
}

    }
else if ($type=="manager") {
        $insertquery2="INSERT INTO employee(employeeid,employeename,birthdate,contactno,emergencycontactname,emergencycontactnumber,address,joiningdate,designation,salary,type,teamid,email,password) VALUES ('$employeeid','$employeename','$birthdate','$contactno','emergencycontactname','emergencycontactnumber','$address','$joiningdate','$designation','$salary','$type','0','$email','$password')";

if(mysqli_query($con,$insertquery2)) {
  echo "<script>alert('Record Inserted Successfully.')</script>";
} else {
  echo "<script>alert('Record Not Inserted.')</script>";
}

    }else{
        echo "<script>alert('Record not Inserted Successfully.')</script>";
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
    <title>Manager Employee | Appeal Guru</title>
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
                    <li class="nav-item"><a class="nav-link" href="manager-reviews.php"><i class="far fa-comments"></i><span>reivews</span></a></li>
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
                                <label for="employeeid">Employee Id</label>
                                <input class="form-control" type="text" placeholder="Employee Id" name="employeeid" required>
                                <label for="employeename">Employee Name</label>
                                <input class="form-control" type="text" placeholder="Employee Name" name="employeename" required>
                                <label for="birthdate">BirthDate</label>
                                <input class="form-control" type="date" name="birthdate" required>
                                <label for="contactno">Contact No</label>
                                <input class="form-control" type="text" placeholder="Contact No." name="contactno" required>
                                <label for="contactno">Emergency Contact details:</label><br>
                                <label for="emergencycontactname">Contact Person Name</label>
                                <input class="form-control" type="text" placeholder="Contact Person Name" name="emergencycontactname" required>
                                <label for="contactno">Contact no(Emergency)</label>
                                <input class="form-control" type="text" placeholder="Contact Person Number" name="emergencycontactnumber" required>
                                <label for="address">Address</label>
                                <textarea class="form-control" placeholder="Address" name="address" required></textarea>
                                <label for="joiningdate">Joining Date</label>
                                <input class="form-control" type="date" name="joiningdate" required>
                                <label for="joiningdate">Designation</label>
                                <input class="form-control" type="text" name="designation" required>
                                <label for="salary">Salary</label>
                                <input class="form-control" type="text" placeholder="Salary" name="salary" required>
                                <label for="type">Select Employee type</label>
                                <div class="dropdown">
                                    
                                    <script type="text/javascript">
    function showteamno() {
        var selecttype= document.getElementById("selecttype");
        var teamno = document.getElementById("teamno");
        var team = document.getElementById("team");
        var teamlabel = document.getElementById("teamlabel");
        var teamnolabel = document.getElementById("teamnolabel");
        if (selecttype.value=="teamleader") {
            teamno.style.display="block";
            team.style.display="none";
            teamlabel.style.display="none";
            teamnolabel.style.display="block";
        }
        else if(selecttype.value=="teammember") {
            teamno.style.display="none";
            team.style.display="block";
            teamlabel.style.display="block";
            teamnolabel.style.display="none";
        }
        else if(selecttype.value=="manager") {
            teamno.style.display="none";
            team.style.display="none";
            teamlabel.style.display="none";
            teamnolabel.style.display="none";
        }
        else{
            teamno.style.display="none";
            team.style.display="none";
            teamlabel.style.display="none";
            teamnolabel.style.display="none";
    }
        }
</script>
<select class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" id="selecttype" onchange = "showteamno()" name="type" required>
        <option class="dropdown-item" value="0">--Select Option--</option>
        <option class="dropdown-item" value="teamleader">Team leader</option>
        <option class="dropdown-item" value="teammember">Team member</option>
        <option class="dropdown-item" value="manager">Manager</option>            
    </select>
                                    
                                </div>
                                    <label for="team" id="teamlabel" style="display:none;">Select Team</label>
                                    <select class="form-control" aria-expanded="false" data-bs-toggle="dropdown" id="team" style="display:none;" name="team" required>
                                        <option class="dropdown-item" value="0" required>--Select Option--</option>
                                        <?php
                                        $result=mysqli_query($con,"select employeeid,employeename,teamid from employee where type='teamleader'
                                            ")or die ("query 1 incorrect.....");

                        while(list($employeeid,$employeename,$teamid)=mysqli_fetch_array($result))
                        { 
                        echo "<option class='dropdown-item' value=$teamid required>$employeename</option>";
                        }?>
        
                  
    </select>
                                <label for="teamno" id="teamnolabel" style="display:none;">Enter Team no</label>
                                <input class="form-control" id="teamno" type="text" placeholder="Team no" style="display: none;" name="teamno" >
                                <label for="email"  >Enter Email</label>
                                <input class="form-control" type="email" placeholder="Email" name="email" required>
                                <button class="btn btn-primary" type="button" onclick = "generate()">Generate</button>
                                <label for="password">Enter Password</label>
                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" required>
                                <script>
                                    function mouseoverPass(obj) {
  var obj = document.getElementById('password');
  obj.type = "text";
}
function mouseoutPass(obj) {
  var obj = document.getElementById('password');
  obj.type = "password";
}
                                </script>
                                <button class="btn btn-primary" type="submit" name="addemployee">Add Employee</button>
                            </form>
                            <script>
        var el_down = document.getElementById("password");
          
        function generate() {
            el_down.value =Math.random().toString(36).slice(2) + 
                Math.random().toString(36)
                    .toUpperCase().slice(2);
                    
            } 
    </script> 
                        </div>
                    </div>
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
                                            <td><strong>Birth Date</strong></td>
                                            <td><strong>Contact No.</strong></td>
                                            <td><strong>Emergency Contact Person</strong></td>
                                            <td><strong>Emergency Contact No</strong></td>
                                            <td><strong>Address</strong></td>
                                            <td><strong>Joining date</strong></td>
                                            <td><strong>Designation</strong></td>
                                            <td><strong>Salary</strong></td>
                                            <td><strong>type</strong></td>
                                            <td><strong>Team Id</strong></td>
                                            <td><strong>Email</strong></td>
                                            <td><strong>Edit</strong></td>
                                            <td><strong>Delete</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable1">
                                        <?php
                                        $result=mysqli_query($con,"select * from employee LIMIT $start_from, $limit")or die ("query 1 incorrect.....");

                        while(list($employeeid,$employeename,$birthdate,$contactno,$emergencycontactname,$emergencycontactnumber,$address,$joiningdate,$designation,$salary,$type,$teamid,$email)=mysqli_fetch_array($result))
                        { 
                        echo "<tr><td>$employeeid</td><td>$employeename</td><td>$birthdate</td><td>$contactno</td><td>$emergencycontactname</td><td>$emergencycontactnumber</td><td>$address</td><td>$joiningdate</td><td>$designation</td><td>$salary</td><td>$type</td><td>$teamid</td>
                        <td>$email</td>

                        <td><a href='manager-employeeupdate.php?id=$employeeid&action=update'><button class='btn btn-primary edit' type='button'><span><i class='fa fa-pencil'></i></span></button></a></td>
                                            <td><a href='manager-employee.php?id=$employeeid&action=delete'><button class='btn btn-primary delete' type='button' ><span><i class='fa fa-trash'></i></span></button></a></td></tr>";
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
              $pagLink .= "<li class='page-item'><a class='page-link' href='manager-employee.php?page=".$i."'>".$i."</a></li>";   
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