<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
 $con = mysqli_connect('localhost','root','','appealgurustaff');
 $query = "SELECT count(*) as count_present_absent,pal,
case 
when pal='present' then 'Present'
when pal='absent' then 'Absent'
end as pal FROM attendance where employeeid='1001' group by pal ";

 $exec = mysqli_query($con,$query);
 $i=0;
 while($row = mysqli_fetch_array($exec)){
echo "<pre>";
print_r($row);
 //echo "['".$row['pal']."',".$row['count_present_absent']."],";
$label[$i] =$row["pal"];
$count[$i]=$row["count_present_absent"];
$i++;
 }
?>
<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>
 Create Google Charts
 </title>
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
</head>
<body>
 <h3>Column Chart</h3>
 <div id="columnchart" style="width: 900px; height: 500px;"></div>
 <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>