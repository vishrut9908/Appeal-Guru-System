<?php
	include('db.php');
	session_start();
	if(isset($_POST['msg'])){		
		$msg=$_POST['msg'];
		$id=$_POST['id'];
		function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}
$key='qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
$msg=encryptthis($msg,$key);
		mysqli_query($conn,"insert into `chat` (chatroomid, message, employeeid, chat_date) values ('$id', '$msg' , '".$_SESSION['id']."', NOW())") or die(mysqli_error());
	}
?>