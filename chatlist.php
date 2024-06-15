<?php error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<div class="col-lg-8">
    <div class="panel panel-default" >
		<span style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span class="fas fa-list"></span> List of Chat Rooms</strong></span>
		<div class="pull-right" >
			<a href="#add_chatroom" data-toggle="modal" class="btn btn-primary"><span class="fas fa-plus"></span> Add</a>
		</div>
	</div>
	<table width="100%" class="table table-striped table-bordered table-hover" id="chatRoom">
        <thead>
            <tr>
                <th>Chat Room Name</th>
				<th>Date Created</th>
				<th><span class="fas fa-lock"></span> Password || <span class="fas fa-user"></span> Member</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$cid=$_SESSION['id'];
			$query=mysqli_query($conn,"select * from chatroom where chatroomid in(select chatroomid from chat_member where userid='$cid' ) order by date_created desc");
			while($row=mysqli_fetch_array($query)){
			?>
			<tr>
				<input type="hidden" value="
				<?php
				$usera=array();
				$m=mysqli_query($conn,"select * from chat_member where chatroomid='".$row['chatroomid']."'");
				while($mrow=mysqli_fetch_array($m)){
					$usera[]=$mrow['userid'];
				}
				//1 member
				if (in_array($_SESSION['id'], $usera)){
					echo "1";
				}	
				else{
					//2 not member w/ pass
					if (!empty($row['chat_password'])){
						echo "2";
					}
					else{
					//3 not member w/o pass
						echo "3";
					}
				}
				?>
				
				"  id="status<?php echo $row['chatroomid']; ?>">
				<td>
					<?php
					$num=mysqli_query($conn,"select * from chat_member where chatroomid='".$row['chatroomid']."'");
					?>
					<span class="badge"><?php echo mysqli_num_rows($num); ?></span> <?php echo $row['chat_name']; ?>
				</td>
				<td><?php echo date('M d, Y - h:i A', strtotime($row['date_created'])); ?></td>
				<td><button value="<?php echo $row['chatroomid']; ?>" class="btn btn-info join_chat"><span class="fas fa-comment"></span> Join</button> &nbsp;
					<?php
					if (!empty($row['chat_password'])){
						echo '<span class="fas fa-lock"></span>&nbsp;';
					}
					$qq=mysqli_query($conn,"select * from chat_member where chatroomid='".$row['chatroomid']."'  and userid='".$_SESSION['id']."'");
					if (mysqli_num_rows($qq)>0){
						echo '<span class="fas fa-user"></span>';
					}
					?>
				</td>
			</tr>
			<?php
			}
		?>
        </tbody>
    </table>                     
</div>