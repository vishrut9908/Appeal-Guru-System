<?php
	include('db.php');
	$id=$_REQUEST['id'];
	$user=$_POST['user'];
	
	if (empty($user)){
	?>
		<script>
			window.alert('Please select user');
			window.history.back();
		</script>
	<?php
	}
	else{
	mysqli_query($conn,"delete from chat_member where userid=$user");
	
	?>
		<script>
			window.alert('Member Deleted Successfully');
			window.history.back();
		</script>
	<?php
	}
?>