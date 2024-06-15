<?php 
    session_start();
    if(isset($_SESSION['id'])){
        include_once "db.php";
        function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}
$key='qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
        $outgoing_id = $_SESSION['id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if ($message != "") {
            
        
        $message=encryptthis($message,$key);
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $mtime = $date->format('Y-m-d H:i:s a');
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, dtime)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$mtime}')") or die();
        }
    }else{
        header("location: ../login.php");
    }}else{
        echo "<script>alert('Enter a message')</script>";
    }


    
?>