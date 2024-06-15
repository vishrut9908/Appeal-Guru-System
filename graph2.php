<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
 $con = mysqli_connect('localhost','root','','appealgurustaff');
 $query = "SELECT count(*) as count_present_absent,employeename
FROM tickets group by employeename";

 $exec = mysqli_query($con,$query);
 $i=0;
 while($row = mysqli_fetch_array($exec)){
echo "<pre>";
print_r($row);
 //echo "['".$row['pal']."',".$row['count_present_absent']."],";
$label[$i] =$row["employeename"];
$count[$i]=$row["count_present_absent"];
$i++;
 }
 $count1 = mysqli_num_rows($exec);
 echo $count1;

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
    <?php
$a=0;
while ($a < $count1) { 

?>
    ['<?php echo $label[$a]; ?>',<?php echo $count[$a]; ?>],
<?php
$a++;
}?>   

    ]);

  var header = {
    title: 'Percentage of employees tickets',
    slices:{0:{color:'#666666'},1:{color:'#006EFF'}} 
  };
  var piechart=new google.visualization.PieChart(
document.getElementById('piechart'));
  piechart.draw(pie,header)
 }
 </script>
</head>
<body>
 <h3><?php echo $a; ?></h3>
 <div id="columnchart" style="width: 900px; height: 500px;"></div>
 <div id="piechart" style="width: 900px; height: 500px;"></div>
 <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>