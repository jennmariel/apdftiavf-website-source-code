<?php
//This code is for chart output
    include('connection.php');
	$battery1 = '';
	$battery2 = '';
	$battery3 = '';
	$batttotal = '';
	$progress = '';
	$timestamp = '';
	$btimestamp = '';
	$sql = "SELECT * FROM (SELECT * FROM batt ORDER BY id DESC LIMIT 10)Var1 ORDER BY id ASC;";
	$sql2 = "SELECT * FROM (SELECT * FROM polstats ORDER BY id DESC LIMIT 10)Var1 ORDER BY id ASC;";
	$result = mysqli_query($conn, $sql);
	$result2 = mysqli_query($conn, $sql2);
	if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $battery1 = $battery1 . '"'. $row['battery1'].'",';
        $battery2 = $battery2 . '"'. $row['battery2'].'",';
        $battery3 = $battery3 . '"'. $row['battery3'].'",';
        $batttotal = $batttotal . '"'. $row['batttotal'].'",';
        $btimestamp = $btimestamp . '"'. $row['btimestamp'].'",';
    }
	} if ($result2->num_rows > 0) {
    while ($row = mysqli_fetch_array($result2)) {
        $progress = $progress . '"'. $row['progress'].'",';
        $timestamp = $timestamp . '"'. $row['timestamp'].'",';
    }
    $battery1 = trim($battery1,",");
    $battery2 = trim($battery2,",");
    $battery3 = trim($battery3,",");
    $batttotal = trim($batttotal,",");
    $progress = trim($progress,",");
    $timestamp = trim($timestamp,",");
    $btimestamp = trim($btimestamp,",");
    } else {
     //echo "0 results";
    }
	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>Datasheets</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets_datasheets/css/icomoon.css">
<link rel="stylesheet" href="assets_datasheets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets_datasheets/css/style.css">
<link rel="stylesheet" href="assets_datasheets/css/search.css">
<!--For Datepicker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--For Timepicker-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body onload="viewdata(), viewdata2()">
<style>
body, html {
  height: 100%;
}
.table-background {
  background-color: #333;
  height: 60%; 
  position:relative;
}
</style>

<!-- NAVBAR -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="home.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white" title="Back to Homepage"><i class="fa fa-chevron-circle-left"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-teal"><i class="fa fa-file-text w3-margin-right"></i>All Data</a>
  <a href="#charts" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Charts</a>
    
 <div class="w3-right w3-hide-small">
    <div class="search-container w3-bar-item" style="display:flex, align-items:center">
        <input name="datepicker" id="datepicker" type="text" placeholder="yyyy-mm-dd" class="search-input" autocomplete="off">
        <button name="filter" type="submit" class="filter filter2 search-btn">
            <i class="fa fa-calendar"></i>
        </button>
    </div>
    <button onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button w3-hover-red">Logout</button>
    <div class="w3-hide-small w3-dropdown-hover">
	  <a class="w3-button w3-hover-teal" title="Battery Status">
	    <?php include_once('websiteFunctions.php'); batttotalNavbar();?>
	    <i class="fa fa-battery-full" style="font-size:20px;color:white"></i></a>
	  <div class="w3-dropdown-content w3-card-4 w3-bar-block">
        <b class="w3-bar-item w3-button">
	    <?php include_once('websiteFunctions.php'); batt1Navbar();?>
        </b>
        <b class="w3-bar-item w3-button">
	    <?php include_once('websiteFunctions.php'); batt2Navbar();?>
        </b>
        <b class="w3-bar-item w3-button">
	    <?php include_once('websiteFunctions.php'); batt3Navbar();?>
        </b>
      </div>
    </div>
   </div>
  </div>

<!-- NAVBAR ON SMALL SCREENS -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
    <a href="#charts" class="w3-bar-item w3-button">Charts</a>
    <button onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button w3-hover-red">Logout</button>
</div>
</div>
<!-- End of NAVBAR -->

<!--SEARCH ON SMALL SCREENS-->
<div class="w3-container w3-theme-l1 w3-hide-medium w3-hide-large" style="padding-top:64px;">
        <div class="search-container w3-bar-item" style="display:flex, align-items:center">
        <input name="datepicker" id="datepicker" type="text" placeholder="yyyy-mm-dd" class="search-input" autocomplete="off">
        <button name="filter" type="submit" class="filter filter2 search-btn">
            <i class="fa fa-calendar"></i>
        </button>
    </div>
</div>

<!-- POLLINATION DATA CONTAINER -->
<div class="table-background" style="padding-top:64px;">
<main>
	<div id= "content">
	<h3 style="color:white">Pollination Data</h3>
    <div id="data_table" class="table-wrapper table-responsive w3-margin-top w3-margin-bottom">
        <table class="table custom-table">
          <thead>
            <tr>  
              <th scope="col"> 
                  <label class="control control--checkbox">
                      <input type="checkbox" id="checkall">
                      <div class="control__indicator"></div>
                  </label>
              </th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Plant ID</th>
              <th scope="col">Progress</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody id="pol_data"></tbody>
        </table>
    </div>
    </div>
    <div class="w3-display-middleright">
      <button type="button" onclick="document.getElementById('Open1').style.display='block'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-green  w3-margin-right w3-margin-bottom"><i class="fa fa-plus" aria-hidden="true"></i>  Add</button>
      <!-- MODAL FOR ADDFORM-->
        <div id="Open1" class="w3-modal">
          <div class="w3-modal-content w3-card-4 w3-animate-top">
            <header class="w3-container w3-teal w3-display-container"> 
              <span onclick="document.getElementById('Open1').style.display='none'" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
              <h4>Add entry</h4>
            </header>
            <div>
              <form action="add1.php" method="POST" class="form-container">
            
                <label for="date" class="w3-half"><b>Date &ensp;</b>
                <input type="text" placeholder="yyyy-mm-dd" id="date" name="date" autocomplete="off" required></label>
            
                <label for="timepicker" class="w3-half"><b>Time &ensp;</b>
                <input type="text" placeholder="hh:mm:ss" id="timepicker" name="timepicker" autocomplete="off" required></label>

                <label for="plantid" class="w3-half"><b>Plant ID &ensp;</b>
                <input type="text" placeholder="Tomato0X" name="plantid" autocomplete="off" required></label>
                
                <label for="progress" class="w3-half"><b>Progress &ensp;</b>
                <input type="number" placeholder="Enter progress value" name="progress" required></label>
                
                <label for="total" class="w3-half"><b>Total &ensp;</b>
                <input type="number" placeholder="Enter total value" name="total" required></label>

                <label for="stats" class="w3-half"><b>Status &ensp;</b>
                <select type="text" id="stats" name="stats">
                  <option value="Done">Done</option>
                  <option value="In progress...">In progress...</option>
                </select></label>
                
                <div class="w3-container w3-light-grey w3-padding">
                  <button type="text" class="w3-button w3-right w3-white w3-border w3-margin-left" onclick="document.getElementById('Open1').style.display='none'">Cancel</button>
                  <button type="submit" class="w3-button w3-right w3-white w3-border w3-margin-right">Add</button></div>
              </form>
            </div>
          </div>
        </div>
      <button  onclick="window.location.href='assets_datasheets/ExportCSV1.php'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-teal w3-margin-right w3-margin-bottom"><i class="fa fa-download" aria-hidden="true"></i>    Export CSV</button>
      <button onclick="window.location.href='assets_datasheets/ExportPDF1.php'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-teal w3-margin-right w3-margin-bottom" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>    Export PDF</button>
     <button id="delsel" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-red w3-margin-right w3-margin-bottom"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
    </div>
</main>
</div>



<!-- BATTERY DATA CONTAINER -->
<div class="table-background" style="padding-bottom:64px;" id="batt">
<main>
	<div id= "content">
	<h3 style="color:white">Battery Data</h3>
    <div id="data_table2" class="table-wrapper table-responsive w3-margin-top w3-margin-bottom">
        <table class="table custom-table">
          <thead>
            <tr>
              <th scope="col">
                  <label class="control control--checkbox">
                      <input type="checkbox" id="checkall2">
                      <div class="control__indicator"></div>
                  </label>
              </th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Battery 1 (%)</th>
              <th scope="col">Battery 2 (%)</th>
              <th scope="col">Battery 3 (%)</th>
              <th scope="col">Average (%)</th>
            </tr>
          </thead>
          <tbody id="batt_data"></tbody>
        </table>
    </div>
    </div>
    <div class="w3-display-middleright">
      <button onclick="document.getElementById('Open2').style.display='block'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-green w3-margin-right w3-margin-bottom"><i class="fa fa-plus" aria-hidden="true"></i>  Add</button>
      <!-- MODAL FOR ADDFORM-->
        <div id="Open2" class="w3-modal">
          <div class="w3-modal-content w3-card-4 w3-animate-top">
            <header class="w3-container w3-teal w3-display-container"> 
              <span onclick="document.getElementById('Open2').style.display='none'" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
              <h4>Add entry</h4>
            </header>
            <div>
              <form action="add2.php" method="POST" class="form-container">
            
                <label for="battdate" class="w3-half"><b>Date &ensp;</b>
                <input type="text" placeholder="yyyy-mm-dd" id="battdate" name="battdate" autocomplete="off" required></label>
            
                <label for="btimepicker" class="w3-half"><b>Time &ensp;</b>
                <input type="text" placeholder="hh:mm:ss" id="btimepicker" name="btimepicker" autocomplete="off" required></label>

                <label for="batt1" class="w3-half"><b>Battery 1 (%) &ensp;</b>
                <input type="number" placeholder="Enter Battery 1 value" name="batt1" autocomplete="off" required></label>
                
                <label for="batt2" class="w3-half"><b>Battery 2 (%) &ensp;</b>
                <input type="number" placeholder="Enter Battery 2 value" name="batt2" autocomplete="off" required></label>
                
                <label for="batt3" class="w3-half"><b>Battery 3 (%) &ensp;</b>
                <input type="number" placeholder="Enter Battery 3 value" name="batt3" autocomplete="off" required></label>

                <label for="batttotal" class="w3-half"><b>Average (%) &ensp;</b>
                <input type="number" placeholder="Enter Average value" name="batttotal" autocomplete="off" required></label>
                
                <div class="w3-container w3-light-grey w3-padding">
                  <button type="text" class="w3-button w3-right w3-white w3-border w3-margin-left" onclick="document.getElementById('Open2').style.display='none'">Cancel</button>
                  <button type="submit" class="w3-button w3-right w3-white w3-border w3-margin-right">Add</button></div>
              </form>
            </div>
          </div>
        </div>
      <button  onclick="window.location.href='assets_datasheets/ExportCSV2.php'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-teal w3-margin-right w3-margin-bottom"><i class="fa fa-download" aria-hidden="true"></i>    Export CSV</button>
      <button onclick="window.location.href='assets_datasheets/ExportPDF2.php'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-teal w3-margin-right w3-margin-bottom" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>    Export PDF</button>
      <button id="delsel2" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-red w3-margin-right w3-margin-bottom"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>
	</div>
</main>
</div>

<!-- CHARTS CONTAINER -->
<div class="w3-container w3-padding-32 w3-theme-l1" id="charts">
    <h3 style="color:white">Charts</h3>
    <div class="row" style="padding-top:20px">
	  <div class="col-12 col-lg-6">
		<div class="card card-default w3-margin-bottom">
			<div class="card-header justify-content-center">
				<h3 class="text-center">Cluster Per Session</h3>
			</div>
			<div class="card-body">
	<canvas id="chart1"></canvas>
		<script>
			var ctx = document.getElementById("chart1").getContext('2d');
    		var myChart1 = new Chart(ctx, {
        	type: 'line',
		    data: {
		    labels: [<?php echo $timestamp; ?>],
		    datasets: 
		    [{
		      label: 'Tomato01',
		      data: [<?php echo $progress; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#0b84a5',
		      borderWidth: 2
		     },
		     {
		      label: 'Tomato02',
		      data: [<?php echo $progress; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#f6c85f',
		      borderWidth: 2
		     },
		     {
		      label: 'Tomato03',
		      data: [<?php echo $progress; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#ca472f',
		      borderWidth: 2
		     },
		     {
		      label: 'Tomato04',
		      data: [<?php echo $progress; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#9dd866',
		      borderWidth: 2
		     },
		     {
		      label: 'Tomato05',
		      data: [<?php echo $progress; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#ffa056',
		      borderWidth: 2
		     },
		     {
		      label: 'Tomato06',
		      data: [<?php echo $progress; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#6f4e7c',
		      borderWidth: 2
		     }]
		     },
		     
		     options: {
		      animation: false,
		      scales: {scales:{yAxes: [{beginAtZero: false}],
		      xAxes: [{autoskip: true, maxTicketsLimit: 15}]}},
		      tooltips:{mode: 'index'},
		      legend:{display: true,
		      position: 'top',
		      labels: {fontColor: 'rgb(0,0,0)', fontSize: 14}}
		     }
		    });
		</script>
			</div>
		</div>
	  </div>

	  <div class="col-12 col-lg-6">
		<div class="card card-default">
			<div class="card-header justify-content-center">
				<h3 class="text-center">Battery Status</h3>
			</div>
			<div class="card-body">
	<canvas id="chart2"></canvas>
		<script>
			var ctx = document.getElementById("chart2").getContext('2d');
    		var myChart2 = new Chart(ctx, {
        	type: 'line',
		    data: {
		    labels: [<?php echo $btimestamp; ?>],
		    datasets: 
		    [{
		      label: 'DC Motor Battery',
		      data: [<?php echo $battery1; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#9dd866',
		      borderWidth: 2
		     },

		     {
		      label: 'Servo Motor Battery',
		      data: [<?php echo $battery2; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#ffa056',
		      borderWidth: 2	
		     },
		     {
		      label: 'Microprocessor Battery',
		      data: [<?php echo $battery3; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#0b84a5',
		      borderWidth: 2	
		     },
		     {
		      label: 'Average',
		      data: [<?php echo $batttotal; ?>],
		      backgroundColor: 'transparent',
		      borderColor:'#6f4e7c',
		      borderWidth: 2	
		     }]
		     },
		     
		     options: {
		      animation: false,
		      scales: {scales:{yAxes: [{beginAtZero: false}],
		      xAxes: [{autoskip: true, maxTicketsLimit: 15}]}},
		      tooltips:{mode: 'point'},
		      legend:{display: true,
		      position: 'top',
		      labels: {fontColor: 'rgb(0,0,0)', fontSize: 14}}
		     }
		    });
		</script>
			</div>
		</div>
	  </div>
	</div>
</div>
    
<!-- MODAL FOR LOGOUT-->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-top">
    <header class="w3-container w3-teal w3-display-container"> 
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
      <h4>Confirm Redirection</h4>
    </header>
    <div class="w3-container">
      <p>Do you really want to exit?</p>
    </div>
    <div class="w3-container w3-light-grey w3-padding">
      <button class="w3-button w3-left w3-white w3-border w3-margin-right" 
   onclick="window.location.href='index.php'">
          <!--php sesh-->
          Yes</button>
      <button class="w3-button w3-left w3-white w3-border w3-margin-left" 
   onclick="document.getElementById('id01').style.display='none'">Cancel</button></div>
  </div>
</div>

<!-- FOOTER/CREDITS -->
<footer class="w3-container w3-padding-32 w3-theme-d1 w3-center">
  <h4>Credits</h4>
  <p>WebDesign References by <a href="https://www.w3schools.com/" target="_blank">w3.css</a></p>
  <p>and <a href="https://colorlib.com/" target="_blank">colorlib.com</a></p>
  <p>Hosted by <a href="https://www.000webhost.com/" target="_blank">000webhost.com</a></p>
  <div style="position:relative;bottom:100px;z-index:1;" class="w3-tooltip w3-right">
    <span class="w3-text w3-padding w3-teal w3-hide-small">Go To Top</span>   
    <a class="w3-button w3-theme" href="#myPage"><span class="w3-xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
  </div>
</footer>
	
<!-- JAVASCRIPT -->
<script src="assets_datasheets/js/jquery-3.3.1.min.js"></script>
<script src="assets_datasheets/js/popper.min.js"></script>
<script src="assets_datasheets/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.min.js'></script>
<script>
//Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

//View Table Data
function viewdata() {
    $.ajax({
        url:'assets_datasheets/delpoldata.php',
        type:'GET',
        success: function(data) {
            $('#pol_data').html(data)
        }
    })
}
function viewdata2() {
    $.ajax({
        url:'assets_datasheets/delbattdata.php',
        type:'GET',
        success: function(data) {
            $('#batt_data').html(data)
        }
    })
}

//Select all
$('#checkall').change(function() {
    $('.checkitem').prop("checked", $(this).prop("checked"))
})
$('#checkall2').change(function() {
    $('.checkitem2').prop("checked", $(this).prop("checked"))
})

//Delete selected
function delsel() {
    var id = $('.checkitem:checked').map(function(){
        return $(this).val()
    }).get().join(' ')
    $.post('assets_datasheets/delpoldata.php?p=del',{id: id}, function(data){
        alert("Successfully deleted.");
        viewdata()
    })
}
function delsel2() {
    var id = $('.checkitem2:checked').map(function(){
        return $(this).val()
    }).get().join(' ')
    $.post('assets_datasheets/delbattdata.php?p=del',{id: id}, function(data){
        alert("Successfully deleted.");
        viewdata2()
    })
}

$(function(){
    //Datepicker/Timepicker
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#date").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#battdate").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $('#timepicker').timepicker({
        timeFormat: 'HH:mm:ss'
    });
    $('#btimepicker').timepicker({
        timeFormat: 'HH:mm:ss'
    });
    
    //Used to filter entry based on search
    $('.filter').click(function(){  
        var datepicker = $('#datepicker').val();  
        if(datepicker != ''){  
             $.ajax({  
                  url:"assets_datasheets/filter.php",  
                  method:"POST",  
                  data:{datepicker:datepicker},  
                  success:function(data)  
                  {  
                       $('#data_table').html(data);
                  }  
             });  
        }  
        else{  
             alert("No date selected.");  
        }  
   });
    $('.filter2').click(function(){  
        var datepicker = $('#datepicker').val();  
        if(datepicker != ''){  
             $.ajax({  
                  url:"assets_datasheets/filter2.php",  
                  method:"POST",  
                  data:{datepicker:datepicker},  
                  success:function(data)  
                  {  
                       $('#data_table2').html(data);
                  }  
             });  
        }  
        else{  
             alert("No date selected.");  
        }  
   }); 
});

//Delete Confirmation    
$('#delsel').click(function() {
if(confirm("Are you sure you want to delete selected rows?")) {
    delsel();
    document.frmUser.submit();
    }
})

$('#delsel2').click(function() {
if(confirm("Are you sure you want to delete selected rows?")) {
    delsel2();
    document.frmUser.submit();
    }
})
</script>

</body>
</html>
