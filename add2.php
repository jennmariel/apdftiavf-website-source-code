<?php
//This code is for authenticating user login.
    include('connection.php');  
    $Date = $_POST['battdate'];  
    $Time = $_POST['btimepicker'];
    $btimestamp = $_POST['battdate'].' '. $_POST['btimepicker'];
    $batt1 = $_POST['batt1'];
    $batt2 = $_POST['batt2'];
    $batt3 = $_POST['batt3'];
    $batttotal = $_POST['batttotal'];
    
    //to prevent from mysqli injection
    $Date = stripcslashes($Date);
    $Time = stripcslashes($Time);
    $btimestamp = stripcslashes($btimestamp);
    $batt1 = stripcslashes($batt1);
    $batt2 = stripcslashes($batt2);
    $batt3 = stripcslashes($batt3);
    $batttotal = stripcslashes($batttotal);
    
    $Date = mysqli_real_escape_string($conn, $Date);
    $Time = mysqli_real_escape_string($conn, $Time);
    $btimestamp = mysqli_real_escape_string($conn, $btimestamp);
    $batt1 = mysqli_real_escape_string($conn, $batt1);
    $batt2 = mysqli_real_escape_string($conn, $batt2);
    $batt3 = mysqli_real_escape_string($conn, $batt3);
    $batttotal = mysqli_real_escape_string($conn, $batttotal);
    
    $sql = "INSERT INTO batt (battery1, battery2, battery3, batttotal, Date, Time, btimestamp)
		
	VALUES ('".$batt1."', '".$batt2."', '".$batt3."', '".$batttotal."', '".$Date."', '".$Time."', '".$btimestamp."')";
	
    if ($conn->query($sql) === TRUE) {
        header("location: datasheets.php");
        exit();
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>