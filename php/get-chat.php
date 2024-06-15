<?php 
    session_start();
    if(isset($_SESSION['id'])){
        
        include_once "db.php";
        $outgoing_id = $_SESSION['id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN employee ON employee.employeeid = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
$key='qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $dec=decryptthis($row['msg'],$key);
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    '.$row['dtime'].'

                                    <p>'.$dec .'</p>
                                </div>
                                </div>';
                }else{
                    $dec=decryptthis($row['msg'],$key);
                    $output .= '<div class="chat incoming">
                                <img src="profiles/'.$row['profilepic'].'" alt="">
                                <div class="details">
                                    '.$row['dtime'].'
                                    <p>'. $dec .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>