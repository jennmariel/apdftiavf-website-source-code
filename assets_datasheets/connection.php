<?php
//database credentials - to establish connection to database

    $servername = "localhost";
	$username = "id16629113_user";
	$password = "#Unfathomable2021";
	$dbname = "id16629113_thesis_db";
      
    $conn = mysqli_connect($servername, $username, $password, $dbname);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>