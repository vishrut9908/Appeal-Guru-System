<?php
	include('db.php');
	if(isset($_POST['fetch'])){
		$id = $_POST['id'];
		
		$query=mysqli_query($conn,"select * from `chat` left join `employee` on employee.employeeid=chat.employeeid left join `client` on client.clientid=chat.employeeid where chatroomid='$id' order by chat_date asc") or die(mysqli_error());
		function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
$key='qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
		while($row=mysqli_fetch_array($query)){
			$dec=decryptthis($row['message'],$key);
		?>	
		<div>
			<img src="../profiles/<?php echo $row['profilepic'];echo $row['profilepicture']; ?>" style="height:30px; width:30px; position:relative; top:15px; left:10px;">
			<span style="font-size:10px; position:relative; top:7px; left:15px;"><i><?php echo date('M-d-Y h:i A',strtotime($row['chat_date'])); ?></i></span><br>
			<span style="font-size:11px; position:relative; top:-2px; left:50px;"><strong><?php echo $row['employeename']; echo $row['clientname']; ?></strong>: <?php echo $dec; ?></span><br>
		</div>
		<div style="height:5px;"></div>
		<?php
		}
	}	
?>