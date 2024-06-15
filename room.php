		
            <div class="panel panel-default">
				<span style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span  id="user_details"><span class="fas fa-user"></span><span class="badge"><?php echo mysqli_num_rows($cmem); ?></span></span> <?php echo $chatrow['chat_name']; ?></strong></span>
				<div class="showme hidden" style="position: absolute; left:-120px; top:20px;">
					<div class="well">
						<strong>Room Member/s:</strong>
						<div style="height: 10px;"></div>
					<?php
						$rm=mysqli_query($conn,"select * from chat_member left join `employee` on employee.employeeid=chat_member.userid where chatroomid='$id'");
						while($rmrow=mysqli_fetch_array($rm)){
							?>
							<span>
							<?php
								$creq=mysqli_query($conn,"select * from chatroom where chatroomid='$id'");
								$crerow=mysqli_fetch_array($creq);
								
								if ($crerow['userid']==$rmrow['userid']){
									?>
										<span class="fas fa-user"></span>
									<?php
								}
								
							?>
							<?php echo $rmrow['employeename']; ?></span><br>
							<?php
						}
						
					?>
						
					</div>
				</div>
				<div class="pull-right">
					<?php
						if ($chatrow['userid']==$_SESSION['id']){
							?>
							<div class="col-md-3"><a href="chat.php" class="btn btn-primary"><span class="fas fa-arrow-left"></span> Lobby</a></div>
							<div class="col-md-3"><a href="#delete_room" data-toggle="modal" class="btn btn-danger"><span class="fas fa-trash"></span> Delete Room</a></div>
							<div class="col-md-3"><a href="#add_member" data-toggle="modal" class="btn btn-primary"><span class="fas fa-user"></span> Add Member</a></div>
							<div class="col-md-3"><a href="#delete_member" data-toggle="modal" class="btn btn-primary"><span class="fas fa-trash"></span> Delete Member</a></div>
							<?php
						}
						else{
							?>
							<a href="chat.php" class="btn btn-primary"><span class="fas fa-arrow-left"></span> Lobby</a>
							<a href="#leave_room" data-toggle="modal" class="btn btn-warning">Leave Room</a>
							<?php
						}
					?>
				</div>
			</div>
			<div>
				<div class="panel panel-default chatarea" >
					<div style="height:10px;"></div>
					<span style="margin-left:10px;">Welcome to <?php echo $chatrow['chat_name']; ?></span><br>
					<span style="font-size:10px; margin-left:10px;"><i>Note: Avoid using foul language and hate speech.</i></span>
					<div style="height:10px;"></div>
					<div id="chat_area" style="margin-left:10px; max-height:350px; overflow-y:scroll;">
					</div>
				</div>

				<div class="input-group">
					<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'appealgurustaff');

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx', 'txt'])) {
        echo '<script>alert("You file extension must be .zip, .pdf or .docx")</script>';
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
            if (mysqli_query($conn, $sql)) {
            	echo '<script>alert("File Uploaded Successfully, Press Send Button to Send File.")</script>';
                $value="<a href=download.php?path=uploads/$filename>$filename</a>";
                copy("uploads/$filename", "employee/uploads/$filename");
                copy("uploads/$filename", "client/uploads/$filename");
                ?>
                <?php
				
            	}
        		} else {
            		echo '<script>alert("Failed to upload file.")</script>';
        			}
    			}
				}?>
				<textarea style="overflow-y: scroll; " type="text" class="text-area" placeholder="Type message..." style="overflow:scroll;"  id="chat_msg" required><?php if(empty($value)){
		            echo "";
		        }else{ 
		            echo $value;
		        }?></textarea>
		        <button class="btn btn-primary" type="submit" id="send_msg" value="<?php echo $id; ?>" style="margin-bottom: 25px;">
					<span class="fas fa-comment"></span> Send
				</button><br/>
				
				<form method="post" enctype="multipart/form-data" >
				    <h3>Upload File</h3>
				     <input class="form-control" type="file" name="myfile">
				     <button class="btn btn-primary" type="submit" name="save" style="margin-top: 10px;"><span class="fas fa-file-upload"></span> Upload</button>
				</form>
				</div>
				
			</div>			
