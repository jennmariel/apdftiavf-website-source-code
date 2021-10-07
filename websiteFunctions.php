<?php
// This code gets the latest batttotal data from batt table in the database
    function batttotalNavbar() {
    	include('connection.php');
    	$sql = "SELECT * FROM batt ORDER BY id DESC LIMIT 1";
    	$result = $conn->query($sql);
    	if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['batttotal']."%";
        }
        } else {
         echo "0 results";
        }
    	$conn->close();
    }
    
// This code gets the latest battery1 data from batt table in the database
    function batt1Navbar() {
    	include('connection.php');
    	$sql = "SELECT * FROM batt ORDER BY id DESC LIMIT 1";
    	$result = $conn->query($sql);
    	if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "1: ".$row['battery1']."%";
        }
        } else {
         echo "0 results";
        }
    	$conn->close();
    }

// This code gets the latest battery2 data from batt table in the database
    function batt2Navbar() {
        include('connection.php');
        $sql = "SELECT * FROM batt ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "2: ".$row['battery2']."%";
        }
        } else {
         echo "0 results";
        }
        $conn->close();
    }

// This code gets the latest battery3 data from batt table in the database
    function batt3Navbar() {
        include('connection.php');
        $sql = "SELECT * FROM batt ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "3: ".$row['battery3']."%";
        }
        } else {
         echo "0 results";
        }
        $conn->close();
    }
    
    function getChartData() {
        include('connection.php');
    	$battery1 = '';
    	$battery2 = '';
    	$battery3 = '';
    	$progress = '';
    	$timestamp = '';
    	$btimestamp = '';
    	$sql = "SELECT * FROM batt, polstats";
    	//$sql = "SELECT * FROM batt, polstats GROUP BY timestamp LIMIT = 15 ";
    	$result = mysqli_query($conn, $sql);
    	if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $battery1 = $battery1 . '"'. $row['battery1'].'",';
            $battery2 = $battery2 . '"'. $row['battery2'].'",';
            $battery3 = $battery3 . '"'. $row['battery3'].'",';
            $progress = $progress . '"'. $row['progress'].'",';
            $timestamp = $timestamp . '"'. $row['timestamp'].'",';
            $btimestamp = $btimestamp . '"'. $row['btimestamp'].'",';
        }
        $battery1 = trim($battery1,",");
        $battery2 = trim($battery2,",");
        $battery3 = trim($battery3,",");
        $progress = trim($progress,",");
        $timestamp = trim($timestamp,",");
        $btimestamp = trim($btimestamp,",");
        } else {
         //echo "0 results";
        }
    	$conn->close();
    }
?>