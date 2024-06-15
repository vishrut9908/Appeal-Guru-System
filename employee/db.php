<?php


$conn = mysqli_connect("localhost","root","","appealgurustaff");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//MySQLi Procedural
$conn = mysqli_connect("localhost","root","","appealgurustaff");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$servername = "localhost";
$username = "root";
$password = "";
$db = "appealgurustaff";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>