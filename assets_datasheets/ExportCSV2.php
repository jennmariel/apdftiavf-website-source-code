<?php
//include database configuration file
include 'connection.php';

//Get current date
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");

//get records from database
$query = $conn->query("SELECT * FROM batt");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "battery_data_" . $d . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Date', 'Time', 'battery1', 'battery2', 'battery3', 'batttotal');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array( $row['Date'], $row['Time'], $row['battery1'], $row['battery2'], $row['battery3'], $row['batttotal']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}

else {
    header("location: datasheets.php");
}
exit;

?>