<?php 
 
// Load the database configuration file 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "appealgurustaff"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Fetch records from database 
$query = $db->query("SELECT * FROM tickets ORDER BY id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "tickets-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Client ID', 'Client Name', 'Emailid', 'Subject', 'Description','Employee Name', 'Priority', 'Raised Date', 'Status', 'Resolved Date'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['id'], $row['clientid'], $row['clientname'], $row['emailid'], $row['subject'], $row['description'], $row['employeename'], $row['priority'], $row['raiseddate'], $row['status'], $row['resolveddate']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
}else{
   
    echo "<script>confirm('No data found to download');</script>";
    echo "<script>window.location.href = 'data.php';</script>";

} 
exit; 
 
?>