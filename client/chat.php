<?php include('session.php'); ?>
<?php include('header.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: var(--bs-orange);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Appeal Guru</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="clients-profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="chat.php"><i class="fas fa-window-maximize"></i><span>Chat Messenger</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="clients-tickets.php"><i class="fa fa-ticket"></i><span>Tickets</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            
                           
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['username']; ?></span><?php $pp = $_SESSION['filename']; echo"<img src='../profiles/".$pp."' class='border rounded-circle img-profile'>"; ?></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            <div class="container" style="background: transparent; width: 100%; margin-right: auto; margin-left: auto;">
                    
        <?php include('chatlist.php'); ?>
    </div>


<?php include('password_modal.php'); ?>
<?php include('out_modal.php'); ?>
<?php include('modal.php'); ?>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.responsive.js"></script>
<script>
$(document).ready(function(){
    
    $('#chatRoom').DataTable({
    "bLengthChange": true,
    "bInfo": true,
    "bPaginate": true,
    "bFilter": true,
    "bSort": false,
    "pageLength": 7
    });
    
    $('#myChatRoom').DataTable({
    "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
    "bLengthChange": false,
    "bInfo": false,
    "bPaginate": true,
    "bFilter": false,
    "bSort": false,
    "pageLength": 8
    });
    
    $(document).on('click', '.join_chat', function(){
        var cid=$(this).val();
        if ($('#status'+cid).val()==1){
            window.location.href='chatroom.php?id='+cid;
        }
        else if ($('#status'+cid).val()==2){
            $('#join_chat').modal('show');
            $('.modal-body #chatid').val(cid);
        }
        else{
            $.ajax({
                url:"addmember.php",
                method:"POST",
                data:{
                    id: cid,
                },
                success:function(){
                window.location.href='chatroom.php?id='+cid;
                }
            });
        }
    });
    
    $(document).on('click', '#addchatroom', function(){
        chatname=$('#chat_name').val();
        chatpass=$('#chat_password').val();
            $.ajax({
                url:"add_chatroom.php",
                method:"POST",
                data:{
                    chatname: chatname,
                    chatpass: chatpass,
                },
                success:function(data){
                window.location.href='chatroom.php?id='+data;
                }
            });
        
    });
    //
    $(document).on('click', '.delete2', function(){
        var rid=$(this).val();
        $('#delete_room2').modal('show');
        $('.modal-footer #confirm_delete2').val(rid);
    });
    
    $(document).on('click', '#confirm_delete2', function(){
        var nrid=$(this).val();
        $('#delete_room2').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
            $.ajax({
                url:"deleteroom.php",
                method:"POST",
                data:{
                    id: nrid,
                    del: 1,
                },
                success:function(){
                    window.location.href='index.php';
                }
            });
    });
    
    $(document).on('click', '.leave2', function(){
        var rid=$(this).val();
        $('#leave_room2').modal('show');
        $('.modal-footer #confirm_leave2').val(rid);
    });
    
    $(document).on('click', '#confirm_leave2', function(){
        var nrid=$(this).val();
        $('#leave_room2').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
            $.ajax({
                url:"leaveroom.php",
                method:"POST",
                data:{
                    id: nrid,
                    leave: 1,
                },
                success:function(){
                    window.location.href='index.php';
                }
            });
    });
 
});
</script>   
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © <a href="https://releff.com/" target="_blank" style="text-decoration: none; color: grey;">Releff Technologies</a> 2021</span></div>

                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>