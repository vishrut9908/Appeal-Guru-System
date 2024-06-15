<?php
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
$sql = "select * from salary where id='$id'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
$key='qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
if ($count == 1) {
  while ($rows=mysqli_fetch_array($result)) {
    $dec=decryptthis($rows['bankname'],$key);
    $dec1=decryptthis($rows['accountnumber'],$key);
    
  
    $employeeid = $rows["employeeid"];
    $employeename = $rows["employeename"];
    $location = $rows["location"];
    $effectiveworkdays = $rows["effectiveworkdays"];
    $lop=$rows["lop"];
    $bankname=$dec;
    $accountnumber=$dec1;
    $basicfull=$rows["basicfull"];
    $basicactual=$rows["basicactual"];
    $hrafull=$rows["hrafull"];
    $hraactual=$rows["hraactual"];
    $specialallowancefull=$rows["specialallowancefull"];
    $specialallowanceactual=$rows["specialallowanceactual"];
    $deductionfull=$rows["deductionfull"];
    $deductionactual=$rows["deductionactual"];

    
  }
}
$eid=$_GET['eid'];
$sql1 = "select joiningdate,designation from employee where employeeid='$eid'";
$result1 = mysqli_query($con,$sql1);
$count1 = mysqli_num_rows($result1);
if ($count1 == 1) {
  while ($rows1=mysqli_fetch_array($result1)) {
    $joiningdate = $rows1["joiningdate"];
    $designation = $rows1["designation"];
  }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Payslip | Appeal Guru</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
<script type="text/javascript" src="html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>

</head>

<body style="background: rgb(255,255,255);width: 595px;height: 842px;margin: auto;" id="content">
    <div id="content3">
    <div class="table-responsive" style="overflow: hidden;" >
        <table class="table" id="content2">
            <thead>
                <tr>
                    <th class="heading-desc" style="border: 1px solid rgb(0,0,0) ;">
                        <div class="row">
                            <div class="col col-md-5" style="padding: 10px 10px;"><img src="assets/img/logo.jpeg" style="height: 70%;width: 100%;margin-top: 5px;"></div>
                            <div class="col col-md-7" style="padding: 10px 10px;">
                                <h6 style="text-align: center;font-weight: bold;color: rgb(0,0,0);font-size: 25px;margin-top: 20px;margin-right: 50px;">Global Enterprise</h6>
                                <p style="text-align: center;color: rgb(0,0,0);font-size: 12px;margin-right: 50px;">506, Darpan Building, Near Welcome Hotel, <br>R.C Dutt Road, Vadodara - 390007,<br>Gujarat, India</p>
                            </div>
                        </div>
                        <h1 style="color: rgb(0,0,0);text-align: center;font-size: 18px;font-weight: bold;">Payslip For The Month Of April,2021</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid rgb(0,0,0);padding: 0px;">
                        <div class="row">
                            <div class="col" style="border-left: 1px solid rgb(0,0,0);">
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);padding-left: 5px;">Name:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $employeename;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);padding-left: 5px;">Joining Date:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $joiningdate;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);padding-left: 5px;">Designation:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $designation;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);padding-left: 5px;">Location:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $location;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);padding-left: 5px;">Effective Work Days:<br></label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $effectiveworkdays;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);padding-left: 5px;">LOP:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $lop;?></label></div>
                                </div>
                            </div>
                            <div class="col" style="border-left: 1px solid rgb(0,0,0);">
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">Employee No.:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $employeeid;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">Bank Name:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $bankname;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">Bank Account No.:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);"><?php echo $accountnumber;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">PAN Number:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">XXX</label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">PF No.:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">XXX</label></div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">PF UAN:</label></div>
                                    <div class="col"><label class="col-form-label" style="float: left;color: rgb(0,0,0);">XXX</label></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php 
$bf=(int)$basicfull;
$hraf=(int)$hrafull;
$specialallowancef=(int)$specialallowancefull;
$totalfull=$bf+$hraf+$specialallowancef;
$ba=(int)$basicactual;
$hraa=(int)$hraactual;
$specialallowancea=(int)$specialallowanceactual;
$totalactual=$ba+$hraa+$specialallowancea;
$df=(int)$deductionfull;
$da=(int)$deductionactual;
$totaldeduction=$da;

$totalearning=$totalactual-$totaldeduction;

                ?>
                <tr>
                    <td style="border-left: 1px solid rgb(0,0,0);border-right: 1px solid rgb(0,0,0);padding: 0px;">
                        <div class="row">
                            <div class="col">
                                <div class="row" style="border-bottom: 1px solid rgb(0,0,0) ;">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;padding-left: 5px;">Earning</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);text-align: center;font-weight: bold;">Full</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">Actual</label></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);padding-left: 5px;">Basic</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);text-align: center;"><?php echo $basicfull;?></label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);"><?php echo $basicactual;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);padding-left: 5px;">HRA</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);text-align: center;"><?php echo $hrafull;?></label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);"><?php echo $hraactual;?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);padding-left: 5px;">Special Allowance</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);text-align: center;"><?php echo $specialallowancefull;?></label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);"><?php echo $specialallowanceactual;?></label></div>
                                </div>
                                <div class="row" style="border-top: 1px solid rgb(0,0,0);border-bottom: 1px solid rgb(0,0,0);">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;padding-left: 5px;">Total Earning(INR):</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);text-align: center;font-weight: bold;"><?php echo $totalfull; ?></label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;"><?php echo $totalactual; ?></label></div>
                                </div>
                            </div>
                            <div class="col" style="border-left: 1px solid rgb(0,0,0);">
                                <div class="row" style="border-bottom: 1px solid rgb(0,0,0) ;">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">Deduction</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">Full</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">Actual</label></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">Deduction</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;"><?php echo $deductionfull; ?></label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;"><?php echo $deductionactual; ?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">&nbsp;</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">&nbsp;</label></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">&nbsp;</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">&nbsp;</label></div>
                                </div>
                                <div class="row" style="border-top: 1px solid rgb(0,0,0);border-bottom: 1px solid rgb(0,0,0);">
                                    <div class="col col-md-6" style="text-align: left;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;">Total Deduction (INR):</label></div>
                                    <div class="col" style="text-align: right;"><label class="col-form-label" style="color: rgb(0,0,0);font-weight: bold;"><?php echo $totaldeduction; ?></label></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php 
function numberTowords($num)
{
    $ones = array(
1 => "one",
2 => "two",
3 => "three",
4 => "four",
5 => "five",
6 => "six",
7 => "seven",
8 => "eight",
9 => "nine",
10 => "ten",
11 => "eleven",
12 => "twelve",
13 => "thirteen",
14 => "fourteen",
15 => "fifteen",
16 => "sixteen",
17 => "seventeen",
18 => "eighteen",
19 => "nineteen"
);
$tens = array(
1 => "ten",
2 => "twenty",
3 => "thirty",
4 => "forty",
5 => "fifty",
6 => "sixty",
7 => "seventy",
8 => "eighty",
9 => "ninety"
);
$hundreds = array(
"hundred",
"thousand",
"million",
"billion",
"trillion",
"quadrillion"
);
$num = number_format($num,2,".",",");
$num_arr = explode(".",$num);
$wholenum = $num_arr[0];
$decnum = $num_arr[1];
$whole_arr = array_reverse(explode(",",$wholenum));
krsort($whole_arr);
$words = "";
foreach($whole_arr as $key => $i) {
if($i == 0) {
continue;
}
if($i < 20) {
$words .= $ones[intval($i)];
} elseif($i < 100) {
if(substr($i,0,1) == 0 && strlen($i) == 3) {
$words .= $tens[substr($i,1,1)];
if(substr($i,2,1) != 0) {
$words .= " ".$ones[substr($i,2,1)];
}
} else {
$words .= $tens[substr($i,0,1)];
if(substr($i,1,1) != 0) {
$words .= " ".$ones[substr($i,1,1)];
}
}
} else {
// $words .= $ones[substr($i,0,1)]." ".$hundreds[0].' and ';
if(substr($i,1,1) != 0 || substr($i,2,1) != 0) {
$words .= $ones[substr($i,0,1)]." ".$hundreds[0].' and ';
} else {
$words .= $ones[substr($i,0,1)]." ".$hundreds[0];
}
if(substr($i,1,2) < 20 && substr($i,1,1) != 0) {
$words .= " ".$ones[(substr($i,1,2))];
} else {
if(substr($i,1,1) != 0) {
$words .= " ".$tens[substr($i,1,1)];
}
if(substr($i,2,1) != 0) {
$words .= " ".$ones[substr($i,2,1)];
}
}
}
if($key > 0) {
$words .= " ".$hundreds[$key]." ";
}
}
$words .= $unit??' units';
if($decnum > 0) {
$words .= " and ";
if($decnum < 20) {
$words .= $ones[intval($decnum)];
} elseif($decnum < 100) {
$words .= $tens[substr($decnum,0,1)];
if(substr($decnum,1,1) != 0) {
$words .= " ".$ones[substr($decnum,1,1)];
}
}
$words .= $subunit??' subunits';
}
return $words;

}
                ?>
                <tr style="border-bottom: 1px solid rgb(0,0,0);border-left: 1px solid rgb(0,0,0);border-right: 1px solid rgb(0,0,0);">
                    <td>
                        <p style="color: rgb(0,0,0);">Net pay for the Month(Total Earning - Total Decuction): <?php echo $totalearning; ?><br>(In Words: <?php echo numberTowords("$totalearning");?>)</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="color: rgb(0,0,0);text-align: center;">This is a system generated pay slip and doesn't required signature.</p>
    </div>
    </div>
    <a href="manager-salary.php"><button style="margin-left: 35%;" >Back</button></a>
    <button id="cmd" onclick="saveDoc()" style="margin-left: 1%;">Download</button>
    <script type="text/javascript">

    var pdf = new jsPDF('p', 'pt', 'a4');
    var width = pdf.internal.pageSize.getWidth();
    var height = pdf.internal.pageSize.getHeight();

    function saveDoc() {
        window.html2canvas = html2canvas
        const doc = document.getElementsByTagName('div')[0];

        if (doc) {
            console.log("div is ");
            console.log(doc);
            console.log("hellowww");



            pdf.html(document.getElementById('content3'), {
                callback: function (pdf) {
                    pdf.save('DOC.pdf');
                }
            })
       }
     }
   </script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>