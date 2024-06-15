<?php
    session_start();
    include_once "db.php";

    $outgoing_id = $_SESSION['id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM employee WHERE NOT employeeid = {$outgoing_id} AND (employeename LIKE '%{$searchTerm}%') and type='manager' ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>