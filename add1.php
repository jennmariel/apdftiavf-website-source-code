<?php
//This code is for authenticating user login.
    include('connection.php');  
    $Date = $_POST['date'];  
    $Time = $_POST['timepicker'];
    $timestamp = $_POST['date'].' '. $_POST['timepicker'];
    $plantid = $_POST['plantid'];
    $progress = $_POST['progress'];
    $total = $_POST['total'];
    $stats = $_POST['stats'];
      
    //to prevent from mysqli injection
    $Date = stripcslashes($Date);  
    $Time = stripcslashes($Time);
    $timestamp = stripcslashes($timestamp);
    $plantid = stripcslashes($plantid);
    $progress = stripcslashes($progress);
    $total = stripcslashes($total);
    $stats = stripcslashes($stats);
    
    $Date = mysqli_real_escape_string($conn, $Date); 
    $Time = mysqli_real_escape_string($conn, $Time);
    $timestamp = mysqli_real_escape_string($conn, $timestamp);
    $plantid = mysqli_real_escape_string($conn, $plantid);
    $progress = mysqli_real_escape_string($conn, $progress);
    $total = mysqli_real_escape_string($conn, $total);
    $stats = mysqli_real_escape_string($conn, $stats);

    if(!empty($_POST["plantid"]) && !empty($_POST["progress"]) && !empty($_POST["total"]) && !empty($_POST["stats"]))
    {
        $sql = "INSERT INTO polstats (plantid, progress, total, stats, Date, Time, timestamp)
	    VALUES ('".$plantid."', '".$progress."', '".$total."', '".$stats."', '".$Date."', '".$Time."', '".$timestamp."')";
	    if ($conn->query($sql) === TRUE) {
            header("location: datasheets.php");
            exit();
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
        }
    $conn->close();
?>