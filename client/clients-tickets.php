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

if (isset($_POST['addticket'])) {
    $clientid=$_SESSION['id'];
    $clientname=$_POST['name'];
    $emailid=$_POST['email'];
    $subject=$_POST['subject'];
    $description=$_POST['description'];
    $employeename=$_POST['employeename'];
    $priority=$_POST['priority'];
    $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
    $raiseddate= $date->format('Y-m-d H:i:s a');
    $status='not resolved';
    $insertquery = "INSERT INTO tickets(clientid,clientname,emailid,subject,description,employeename,priority,raiseddate,status) VALUES ('$clientid','$clientname','$emailid','$subject','$description','$employeename','$priority','$raiseddate','$status')";

if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Record Inserted Successfully.')</script>";
} else {
  echo "<script>alert('Record Not Inserted.')</script>";
}
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
    <title>Tickets | Appeal Guru</title>
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
                    <li class="nav-item"><a class="nav-link" href="clients-profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="chat.php"><i class="fas fa-window-maximize"></i><span>Chat Messenger</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="clients-tickets.php"><i class="fa fa-ticket"></i><span>Tickets</span></a></li>
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
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Tickets</h3>
                    <div class="card shadow card-employee">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold" style="color: var(--bs-orange);">Raise Ticket</p>
                        </div>
                        <?php 
                        $name1=$_SESSION['username'];
                        $email1=$_SESSION['useremail'];
                        ?>
                        <div class="card-body">
                            <form method="post" action="">
                                <input class="form-control" type="text" placeholder="Name" name="name" value="<?php echo $name1;?>" required>
                                <input class="form-control" type="email" placeholder="Email" name="email" value="<?php echo $email1;?>" required>
                                <input class="form-control" type="text" placeholder="Subject" name="subject" required>
                                <textarea class="form-control" placeholder="Description" name="description" required></textarea>
                                <input class="form-control" type="text" name="employeename" placeholder="Employee name" required>
                                <select class="form-select" name="priority" required>
                                    <optgroup label="Priority">
                                        <option value="0" selected="">--Select Priority--</option>
                                        <option value="high">High</option>
                                        <option value="medium">Medium</option>
                                        <option value="low">Low</option>
                                    </optgroup>
                                </select>

                                <button class="btn btn-primary" type="submit" name="addticket" style="background: var(--bs-orange);">Submit</button></form>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Client's Ticket Info</p>
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
    td1 = tr[i].getElementsByTagName("td")[6];
    if (td || td1) {
      txtValue = td.textContent || td.innerText;
      txtValue1 = td1.textContent || td1.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1) {
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
                                            <th>ID</th>
                                            <th>Client Id</th>
                                            <th>Client Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Description</th>
                                            <th>Employee name</th>
                                            <th>Priority</th>
                                            <th>Raised Date</th>
                                            <th>Status</th>
                                            <th>Resolved Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable1">
                                        <?php
                                        $cid=$_SESSION['id'];
                                        $result=mysqli_query($con,"select * from tickets where clientid='$cid' LIMIT $start_from, $limit ")or die ("query 1 incorrect.....");

                        while(list($id,$clientid,$clientname,$emailid,$subject,$description,$employeename,$priority,$raiseddate,$status,$resolveddate)=mysqli_fetch_array($result))
                        { 
                        echo "<tr><td>$id</td><td>$clientid</td><td>$clientname</td>
                        <td>$emailid</td><td>$subject</td><td>$description</td><td>$employeename</td><td>$priority</td><td>$raiseddate</td><td>$status</td><td>$resolveddate</td>

                        </tr>";
                        }?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                   <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
<?php
$cid=$_SESSION['id'];
$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM tickets where clientid='$cid'"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='clients-tickets.php?page=".$i."'>".$i."</a></li>";   
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