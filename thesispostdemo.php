<?php
//This code creates new record as per request

    include('connection.php');

    //Get current date and time
    date_default_timezone_set('Asia/Manila');
    $d = date("Y-m-d");
    $t = date("H:i:s");
    $timestamp = $d + ' ' + $t;

//INSERT DATA TO POLSTATS
    if(!empty($_POST["plantid"]) && !empty($_POST["progress"]) && !empty($_POST["total"]) && !empty($_POST["stats"]))
    {
    	$plantid = $_POST["plantid"];
    	$progress = $_POST["progress"];
    	$total = $_POST["total"];
    	$stats = $_POST["stats"];

        $check = "SELECT * FROM polstats WHERE plantid = '$plantid'"; // checking data
        $result = mysqli_query($conn, $check);
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE polstats SET progress='$progress', total='$total', stats='$stats', Date='$d', Time='$t', timestamp='$timestamp' WHERE plantid='$plantid'";
            if (mysqli_query($conn, $sql)) {
                echo "Record updated!\n";
                echo "polstats OK\n";
            }
            else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
        else {
            $sql = "INSERT INTO polstats (plantid, progress, total, stats, Date, Time, timestamp)
		
		    VALUES ('".$plantid."', '".$progress."', '".$total."', '".$stats."', '".$Date."', '".$Time."', '".$timestamp."')";
		    if ($conn->query($sql) === TRUE) {
		        echo "Record inserted!\n";
    		    echo "polstats OK\n";
    		} else {
    		    echo "Error: " . $sql . "<br>" . $conn->error;
    		}
            }
	}
	
//INSERT DATA TO BATT
	if(!empty($_POST['battery1']) && !empty($_POST['battery2']) && !empty($_POST['battery3']) && !empty($_POST['batttotal']))
    {
    	$battery1 = $_POST['battery1'];
    	$battery2 = $_POST['battery2'];
    	$battery3 = $_POST['battery3'];
    	$batttotal = $_POST['batttotal'];

	    $sql = "INSERT INTO batt (battery1, battery2, battery3, batttotal, Date, Time, btimestamp)
		
		VALUES ('".$battery1."', '".$battery2."', '".$battery3."', '".$batttotal."', '".$d."', '".$t."', '".$timestamp."')";
		
	    if ($conn->query($sql) === TRUE) {
	        echo "Record inserted!\n";
		    echo "batt OK\n";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
?>