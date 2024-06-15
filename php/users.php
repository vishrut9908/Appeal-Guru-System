<?php
    session_start();
    include_once "db.php";
    $outgoing_id = $_SESSION['id'];
    $sql = "SELECT * FROM employee WHERE NOT employeeid = {$outgoing_id} and type='manager' ORDER BY employeeid DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>