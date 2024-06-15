<?php
include "db.php";
/*$date1 = strtotime("2007-03-25 ");
$date2 = strtotime("2007-03-30 ");*/
$date2 = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$logouttime = $date2->format('H:i:s');
$date3 = new DateTime('22:00:00', new DateTimeZone('Asia/Kolkata'));
$logouttime1 = $date3->format('H:i:s');
$selectdate1=new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$selectdate1=$selectdate1->format('Y-m-d');
if ($logouttime > $logouttime1) {
  //$sql2 = mysqli_query($con, "INSERT INTO attendance(day,pal,employeeid) VALUES ('$selectdate1','absent','$id')"
	echo "yes";
echo "$logouttime";}

/*$datediff = $date2 - $date1;
$i=1;
$days=round($datediff / (60 * 60 * 24));
while($i<=$days){
	$date1 ="2007-03-25";
    $date1= date('Y-m-d', strtotime($date1. "+ $i days"));
   	echo $date1;
   	echo "hello";
   	$insertsql = "INSERT into attendance (day,pal, employeeid)
                  VALUES('$date1','leave', '1001')";
    mysqli_query($con,$insertsql);
    $i=$i+1;

}*/

?>