<?php 
 
// Load the database configuration file 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "appealgurustaff"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Fetch records from database 
$query = $db->query("SELECT * FROM messages ORDER BY msg_id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "privatemessages-data_" . date('Y-m-d') . ".csv"; 
    function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
$key='qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';  
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('MSG ID', 'Incoming ID', 'Outgoing ID', 'Message', 'Date Time'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){
    $dec=decryptthis($row['msg'],$key); 
        $lineData = array($row['msg_id'], $row['incoming_msg_id'], $row['outgoing_msg_id'], $dec, $row['dtime']); 
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