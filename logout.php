<?php
include"db.php";
session_start();
$employeeid=$_SESSION["id"];
$logintime=$_SESSION["logintime"];		
$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$logouttime = $date->format('Y-m-d H:i:s a');		
$insertquery = "INSERT INTO loginrecord(employeeid,logintime,logouttime) VALUES ('$employeeid','$logintime','$logouttime')";
$status = "Offline now";
$sql = mysqli_query($conn, "UPDATE employee SET status = '{$status}' WHERE employeeid={$employeeid}");
if(mysqli_query($con,$insertquery)) {
  echo "<script>alert('Logged out succesfully')</script>";
header('Location: index.php'); 
} else {
  echo "<script>alert('Logged out failed')</script>";
}
$sql_con = new mysqli('localhost', 'root', '', 'appealgurustaff');

if($stmt = $sql_con->prepare("SELECT employeeid, logintime,logouttime FROM loginrecord WHERE employeeid = ? and date(logintime)=? and date(logouttime)=?")) {
$id=$_SESSION['id'];
$selectdate=new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$selectdate=$selectdate->format('Y-m-d');
   $stmt->bind_param("iss", $id,$selectdate,$selectdate); 
   $stmt->execute(); 
   $stmt->bind_result($employeeid, $logintime,$logouttime);
$h=0;

   while ($stmt->fetch()) {
    $a=$logintime;
                                                    $b=$logouttime;
                                                    $hour = round((strtotime($b) - strtotime($a))/(3600),1); 
                                                    echo "$hour hours";
                                                    $h+=$hour; 
                                                    
}} 
if($h>8){
$id=$_SESSION['id'];

$sql3 = "select employeeid from attendance where employeeid=$id and day='$selectdate'";
$result3 = mysqli_query($con,$sql3);
$count3 = mysqli_num_rows($result3);
if ($count3 == 1) {
    unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["useremail"]);
  }else{
    $sql1 = mysqli_query($con, "INSERT INTO attendance(day,pal,employeeid) VALUES ('$selectdate','present','$id')");
unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["useremail"]);
}
}else if ($h<8) {
    $sql4 = "select employeeid from attendance where employeeid=$id and day='$selectdate'";
$result4 = mysqli_query($con,$sql4);
$count4 = mysqli_num_rows($result4);
if ($count4 == 1) {
    unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["useremail"]);
  }else{
$id=$_SESSION['id'];
$date2 = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$logouttime = $date2->format('H:i:s');
$date3 = new DateTime('22:00:00', new DateTimeZone('Asia/Kolkata'));
$logouttime1 = $date3->format('H:i:s');
$selectdate1=new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$selectdate1=$selectdate1->format('Y-m-d');
if ($logouttime > $logouttime1) {
  $sql2 = mysqli_query($con, "INSERT INTO attendance(day,pal,employeeid) VALUES ('$selectdate1','absent','$id')");
unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["useremail"]);
}else{
    unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["useremail"]);
}


}
}else{

unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["useremail"]);
}

/**/






   

?>
