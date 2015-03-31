<?php
$servername = "localhost";


// Create connection
$db = 'inventory';
$account = 'root';
$password = '';
$db_database = 'inventory';
$db_connect = mysqli_connect($servername,$account,$password,$db_database) or die(mysqli_connect_error());
$db_connect->query("set names utf8");
?>