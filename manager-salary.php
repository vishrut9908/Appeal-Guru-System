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
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{

$id=$_GET['id'];
/*this is delet query*/
mysqli_query($con,"delete from salary where id='$id'")or die("query is incorrect...");
}
if (isset($_POST['updatesalary'])) {
    $employeeid=$_POST['employeeid'];
    $employeename=$_POST['employeename'];
    $appliedleaves=$_POST['appliedleaves'];
    $attendance=$_POST['attendance'];
    $location=$_POST['location'];
    $effectiveworkdays=$_POST['effectiveworkdays'];
    $lop=$_POST['lop'];
    $bankname=$_POST['bankname'];
    $accountnumber=$_POST['accountnumber'];
    $basicfull=$_POST['basicfull'];
    $basicactual=$_POST['basicactual'];
    $hrafull=$_POST['hrafull'];
    $hraactual=$_POST['hraactual'];
    $specialallowancefull=$_POST['specialallowancefull'];
    $specialallowanceactual=$_POST['specialallowanceactual'];
    $deductionfull=$_POST['deductionfull'];
    $deductionactual=$_POST['deductionactual'];
    $selectdate=new DateTime('now', new DateTimeZone('Asia/Kolkata'));
    $selectdate=$selectdate->format('Y-m-d');
    $status=$_POST['status'];
function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}
$key='qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
$bankname=encryptthis($bankname,$key);
$accountnumber=encryptthis($accountnumber,$key);

        $insertquery = "INSERT INTO salary(employeeid,employeename,appliedleaves,attendance,location,effectiveworkdays,lop,bankname,accountnumber,basicfull,basicactual,hrafull,hraactual,specialallowancefull,specialallowanceactual,deductionfull,deductionactual,updatedwhen,status) VALUES ('$employeeid','$employeename','$appliedleaves','$attendance','$location','$effectiveworkdays','$lop','$bankname','$accountnumber','$basicfull','$basicactual','$hrafull','$hraactual','$specialallowanceactual','$specialallowancefull','$deductionfull','$deductionactual','$selectdate','$status')";

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Record Inserted Successfully.')</script>";
} else {
  echo "<script>alert('Record Not Inserted.')</script>";
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
    <title>Salary | Appeal Guru</title>
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
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Employee's Salary</h3>
                    <div class="card shadow card-employee">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Add Employee&nbsp;</p>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <select class="form-control" aria-expanded="false" data-bs-toggle="dropdown" id="employee" name="employee" >
                                        <option class="dropdown-item" value="0">--Select Employee--</option>
                                        <?php
                                        $result=mysqli_query($con,"select employeeid,employeename from employee where employeeid not in(select employeeid from salary where status='paid')
                                            ")or die ("query 1 incorrect.....");

                        while(list($employeeid,$employeename)=mysqli_fetch_array($result))
                        { 
                        echo "<option class='dropdown-item' value=$employeeid>$employeename</option>";
                        }?>
                        </select><button class="btn btn-primary" type="submit" name="checkemployee" id="checkemployee" style="background: var(--bs-orange);">Check</button>
                    </form>
<?php 
//Salary code starts here//
if (isset($_POST['checkemployee'])) {
   $employeeid=$_POST['employee'];
   
$sql = "select * from leaves where aby='$employeeid'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
$sql2 = "select * from employee where employeeid='$employeeid'";
$result2 = mysqli_query($con,$sql2);
$count2 = mysqli_num_rows($result2);
if ($count2 == 1) {
  while ($rows=mysqli_fetch_array($result2)) {
    
    $salary = $rows["salary"];
    $employeename = $rows["employeename"];
    $employeeid=$rows["employeeid"];
  }
       
}
$sql3 = "select * from attendance where employeeid='$employeeid'and pal='present'";
$result3 = mysqli_query($con,$sql3);
$count3 = mysqli_num_rows($result3);
if ($count3 == 1) {
  while ($rows=mysqli_fetch_array($result3)) {
    
    $pal = $rows["pal"];
  }
       
}
$row = mysqli_num_rows($result); 
    $v=$row; 
    $attend=$count3;
}

?>                              <form action="" method="post">
                                <label class="form-label input-text">Employee ID</label>
                                <input class="form-control" type="text" placeholder="employee id" name="employeeid" value="<?php echo $employeeid; ?>" required>
                                <label class="form-label input-text">Employee Name</label>
                                <input class="form-control" type="text" placeholder="employee name" name="employeename" value="<?php echo $employeename; ?>" required>
                                <label class="form-label input-text">Applied Leaves</label>
                                <input class="form-control" type="text" placeholder="Applied leaves" name="appliedleaves" value="<?php echo $v; ?>" required>
                                <label class="form-label input-text">Attendance</label>
                                <input class="form-control" type="text" value="<?php echo $attend; ?>" placeholder="Attendance" name="attendance" required>
                                <label class="form-label input-text">Location</label>
                                <input class="form-control" type="text" id="location" name="location" required>
                                <label class="form-label input-text">Effective Workdays</label>
                                <input class="form-control" type="text" id="effectiveworkdays" name="effectiveworkdays" required>
                                <label class="form-label input-text">LOP</label>
                                <input class="form-control" type="text" id="lop" name="lop" required>
                                <label class="form-label input-text" style="color: black;">Bank Details</label>
                                <br>
                                <label class="form-label input-text">Bank Name</label>
                                <input class="form-control" type="text" id="bankname" name="bankname" required>
                                <label class="form-label input-text">Bank Account Number</label>
                                <input class="form-control" type="text" id="accountnumber" name="accountnumber" required>
                                <label class="form-label input-text" style="color: black;">Earning Block</label>
                                <br>
                                <label class="form-label input-text">Basic</label>
                                <input class="form-control" type="text" id="basicfull" name="basicfull" placeholder="Basic Full" required>
                                <input class="form-control" type="text" id="basicactual" name="basicactual" placeholder="Basic Actual" required>
                                <label class="form-label input-text">HRA</label>
                                <input class="form-control" type="text" id="hrafull" name="hrafull" placeholder="HRA Full" required>
                                <input class="form-control" type="text" id="hraactual" name="hraactual" placeholder="HRA Actual" required>
                                <label class="form-label input-text">Special Allowance</label>
                                <input class="form-control" type="text" id="specialallowancefull" name="specialallowancefull" placeholder="Special Allowance Full" required>
                                <input class="form-control" type="text" id="specialallowanceactual" name="specialallowanceactual" placeholder="Special Allowance Actual" required>
                                <label class="form-label input-text" style="color: black;">Deduction Block</label>
                                <br>
                                <label class="form-label input-text">Deduction</label>
                                <input class="form-control" type="text" id="Deductionfull" name="deductionfull" placeholder="Deduction Full" required>
                                <input class="form-control" type="text" id="deductionactual" name="deductionactual" placeholder="Deduction Actual" required>
                                
                                <label class="form-label input-text">Status</label>
                                <select class="form-control btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" id="status"  name="status" required>
        <option class="dropdown-item" value="0">--Select Status--</option>
        <option class="dropdown-item" value="paid">Paid</option>          
    </select>
                                <button class="btn btn-primary" type="submit" name="updatesalary" style="background: var(--bs-orange);">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Salary Info</p>
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
    td = tr[i].getElementsByTagName("td")[2];
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
                                            <th>Employee ID</th>
                                            <th>Employee name</th>
                                            <th>payslip</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable1">
                                        <?php
                                        $result=mysqli_query($con,"select id,employeeid,employeename from salary")or die ("query 1 incorrect.....");

                        while(list($id,$employeeid,$employeename)=mysqli_fetch_array($result))
                        { 
                        echo "<tr><td>$id</td><td>$employeeid</td><td>$employeename</td>

                                            <td><a href='payslip.php?id=$id&eid=$employeeid&action=view'><button class='btn btn-primary' type='button' ><span><i class='fa fa-money'></i></span></button></a></td>                        
                                            <td><a href='manager-salary.php?id=$id&action=delete'><button class='btn btn-primary delete' type='button' ><span><i class='fa fa-trash'></i></span></button></a></td></tr>";
                        }?>
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
<?php
$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM salary"); 
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