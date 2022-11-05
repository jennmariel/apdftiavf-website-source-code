<!-- POST-THESIS CHANGELOGS
 --disabled animation of charts
 --chart text placed in the middle
 --added View Datasheets (recommended)
 --fixed session bugs
 --fixed responsiveness for small screens
 --detailed annotations
 -- overall aesthetic
 -->

<?php
//This will prevent access to page without logging in
/*session_start();

if ($_SESSION["status"] != true){
    header("Location: index.php");
}*/

//This line will make the page auto-refresh each 5 seconds
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>

<!DOCTYPE html>
<html>
<title>Pollination Data</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets_home/style.css" >
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>

<body id="myPage">

<!-- NAVBAR -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Pollination Status</a>
  <a href="#battery" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Battery Percentage</a>
  <a href="#work" class="w3-bar-item w3-button w3-hide-small w3-hover-white">About Us</a>
  <a href="#team" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Group 3</a>
  <a href="#contact" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
    <div class="w3-dropdown-hover w3-hide-small">
     <button class="w3-button" title="">More   <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-card-4 w3-bar-block">
       <a href="https://mega.nz/folder/TthR0I6S" target="_blank" class="w3-bar-item w3-button">Documentations</a>
       <a href="https://github.com/jennmariel/apdftiavf-website-source-code" target="_blank" class="w3-bar-item w3-button">Full Code</a>
       <button onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button w3-hover-red">Logout</button>
      </div>
    </div>
    
    <div class="w3-right w3-hide-small w3-dropdown-hover">
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

<!-- NAVBAR ON SMALL SCREENS -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
<a href="#battery" class="w3-bar-item w3-button">Battery Percentage</a>
<a href="#work" class="w3-bar-item w3-button">About Us</a>
<a href="#team" class="w3-bar-item w3-button">Group 3</a>
<a href="#contact" class="w3-bar-item w3-button">Contact</a>
<a href="https://mega.nz/folder/TthR0I6S" target="_blank" class="w3-bar-item w3-button">Documentations</a>
<button onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button w3-hover-red">Logout</button>
</div>
</div>
<!--End of NAVBAR-->

<!-- IMAGE HEADER W/ TABLE -->
<div class="parallax"></div>
	<main>
		<div id="content">
		<h4 style="color:white;">Current Session Data</h4>
		<div class="table-wrapper w3-margin-top w3-margin-bottom">
			<table>
				<thead>
					<tr>
					<th>Date</th>
					<th>Time</th>
					<th>Plant Id</th>
					<th>Progress</th>
					<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// This code is for getting data from polstats table and display to website
						include('connection.php');
						//Get current date
						date_default_timezone_set('Asia/Manila');
                        $d = date("Y-m-d");
						$sql = "SELECT Date, Time, plantid, progress, total, stats FROM polstats WHERE Date = '$d'";
						$result = $conn->query($sql);
						if ($result->num_rows>0) {
						// output data of each row
    						while($row = $result->fetch_assoc()) {
    						echo "<tr><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["plantid"]. "</td><td>" . $row["progress"]. "/" . $row["total"]. "</td><td>" . $row["stats"]. "</td></tr>";
    						}
						echo "</table>";
						}
						else {$confirm = 1;}
						$conn->close();
					?>
				</tbody>
			</table>
		</div>
		</div>
		<div class="w3-display-bottomcenter">
          <button onclick="window.location.href='datasheets.php'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-dark-grey w3-hover-teal  w3-margin-right"><i class="fa fa-file-text" aria-hidden="true"></i> View Datasheets</button>
	      <button  onclick="confirmResult()" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-teal w3-margin-right"><i class="fa fa-download" aria-hidden="true"></i>    Export CSV</button>
	      <button onclick="window.location.href='ExportPDF.php'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-teal w3-margin-right" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>    Export PDF</button>
	      <button onclick="document.getElementById('id02').style.display='block'" style="border-radius: 4px" class="w3-button w3-medium w3-card-4 w3-white w3-hover-red w3-margin-right"><i class="fa fa-times-circle-o" aria-hidden="true"></i>    Reset</button>
		</div>
	</main>

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

<!-- MODAL FOR RESET -->
<div id="id02" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-top">
    <header class="w3-container w3-teal w3-display-container">
      <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
      <h4>Are you sure you want to reset?</h4>
    </header>
    <div class="w3-container">
      <p>This will clear all the table data.</p>
    </div>
    <div class="w3-container w3-light-grey w3-padding">
      <button class="w3-button w3-left w3-white w3-border w3-margin-right" 
   onclick="window.location.href='reset.php'">
          Yes</button>
      <button class="w3-button w3-left w3-white w3-border w3-margin-left" 
   onclick="document.getElementById('id02').style.display='none'">Cancel</button></div>
    </div>
  </div>

<!-- BATTERY STATUS CONTAINER -->
<div class="w3-container w3-padding-64 w3-center w3-theme-l5" id="battery">
    
<?php
//This code will fetch latest data from batt table from the database
	include('connection.php');
	$battery1 = '';
	$battery2 = '';
	$battery3 = '';
	$sql = "SELECT * FROM batt ORDER BY id DESC LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $battery1 = $row['battery1'];
        $battery2 = $row['battery2'];
        $battery3 = $row['battery3'];
    }
    } else {
     echo "0 results";
    }
	$conn->close();
?>

<h2>BATTERY PERCENTAGE</h2>
<div class="w3-row"><br>
<div class="w3-third outer">
<canvas id="chart1"></canvas>
	<script>
	//This code uses chart.js to make chart1 for battery percentage of DC Motor
		var value1 = <?php echo $battery1; ?>;
		var val1 = (value1*14/100).toFixed(2);
        var data1 = {
          labels: [
            "remaining",
            "utilized"
          ],
          datasets: [
            {
              data: [val1, (14-val1).toFixed(2)],
              backgroundColor: [
                "#63B7B7",
                "#ededed"
              ],
              hoverBackgroundColor: [
                "#63B7B7",
                "#ededed"
              ],
              hoverBorderColor: [
                "#63B7B7",
                "#ffffff"
              ]
            }]
        };
        
        var chart1 = new Chart(document.getElementById('chart1'), {
          type: 'doughnut',
          data: data1,
          options: {
            animation: false,
          	responsive: true,
            legend: {
              display: false
            },
            cutoutPercentage: 70,
            tooltips: {
            	filter: function(item, data) {
                var label = data.labels[item.index];
                if (label) return item;
              }
            }
          }
        });
	</script>
  <h4 class="percent" style="color:#696969"><?php echo $battery1. "%"; ?></h4>
  <h3><b>DC Motor Battery</b></h3>
  <h5>Full Capacity: 14V</h5>
</div>

<div class="w3-third outer">
<canvas id="chart2"></canvas>
    <script>
    //This code uses chart.js to make chart2 for battery percentage of Servo Motor
		var value2 = <?php echo $battery2; ?>;
		var val2 = (value2*14/100).toFixed(2);
        var data2 = {
          labels: [
            "remaining",
            "utilized"
          ],
          datasets: [
            {
              data: [val2, (14-val2).toFixed(2)],
              backgroundColor: [
                "#63B7B7",
                "#ededed"
              ],
              hoverBackgroundColor: [
                "#63B7B7",
                "#ededed"
              ],
              hoverBorderColor: [
                "#63B7B7",
                "#ffffff"
              ]
            }]
        };
        
        var chart2 = new Chart(document.getElementById('chart2'), {
          type: 'doughnut',
          data: data2,
          options: {
            animation: false,
          	responsive: true,
            legend: {
              display: false
            },
            cutoutPercentage: 70,
            tooltips: {
            	filter: function(item, data) {
                var label = data.labels[item.index];
                if (label) return item;
              }
            }
          }
        });
	</script>
  <h4 class="percent" style="color:#696969"><?php echo $battery2. "%"; ?></h4>
  <h3><b>Servo Motor Battery</b></h3>
  <h5>Full Capacity: 14V</h5>
</div>

<div class="w3-third outer">
<canvas id="chart3"></canvas>
	<script>
	//This code uses chart.js to make chart3 for battery percentage of Microprocessor
		var value3 = <?php echo $battery3; ?>;
		var val3 = (value3*8.3/100).toFixed(2);
        var data3 = {
          labels: [
            "remaining",
            "utilized"
          ],
          datasets: [
            {
              data: [val3, (8.3-val3).toFixed(2)],
              backgroundColor: [
                "#63B7B7",
                "#ededed"
              ],
              hoverBackgroundColor: [
                "#63B7B7",
                "#ededed"
              ],
              hoverBorderColor: [
                "#63B7B7",
                "#ffffff"
              ]
            }]
        };
        
        var chart3 = new Chart(document.getElementById('chart3'), {
          type: 'doughnut',
          data: data3,
          options: {
            animation: false,
          	responsive: true,
            legend: {
              display: false
            },
            cutoutPercentage: 70,
            tooltips: {
            	filter: function(item, data) {
                var label = data.labels[item.index];
                if (label) return item;
              }
            }
          }
        });
	</script>
  <h4 class="percent"style="color:#696969"><?php echo $battery3. "%"; ?></h4>
  <h3><b>Microprocessor Battery</b></h3>
  <h5>Full Capacity: 8.3V</h5>
</div>
</div>
</div>

<!-- "ABOUT OUR STUDY" CONNTAINER -->
<div class="w3-row-padding w3-padding-64 w3-theme-l1" id="work">

<div class="w3-quarter">
<h2><b>Automated Pollinating Device for Tomatoes in a Vertical Farm</b></h2>
<hr>
<h5 style="text-align:justify">Automated Pollinating Device is an attempt to provide an alternative for manual pollination to increase production in vertical farming to help in the increasing food source demand. It is an application of robotics and mechatronics in order to create a device that can pollinate plants with less or no human intervention. Beyond a handful of examples and conceptual designs, research into ground-based robotic pollination systems is very limited. Our research was intended to fill this gap.</h5>
</div>

<div class="w3-quarter">
  <img src="images/arm.png" alt="" style="width:100%">
  <div class="w3-container">
  <h3>Arm Design</h3>
  </div>
</div>

<div class="w3-quarter">
  <img src="images/iso.png" alt="" style="width:100%">
  <div class="w3-container">
  <h3>Isometric View</h3>
  </div>
</div>

<div class="w3-quarter">
  <img src="images/front.png" alt="" style="width:100%">
  <div class="w3-container">
  <h3>Front View</h3>
  </div>
</div>

<div class="w3-quarter">
  <img src="images/bottom.png" alt="" style="width:100%">
  <div class="w3-container">
  <h3>Bottom View</h3>
  </div>
</div>

<div class="w3-quarter">
  <img src="images/vibmotor.png" alt="" style="width:100%">
  <div class="w3-container">
  <h3>Vibration Motor</h3>
  </div>
</div>

<div class="w3-quarter">
  <img src="images/dimension.png" alt="" style="width:100%">
  <div class="w3-container">
  <h3>Dimensions</h3>
  </div>
</div>
</div>

<!-- TEAM CONTAINER -->
<div class="w3-container w3-padding-64 w3-center w3-theme-l5" id="team">
<h2>OUR TEAM</h2>
<p>Meet Group 3:</p>

<div class="w3-row"><br>

<div class="w3-third">
  <img src="images/jenn.jpg" alt="Jenn Mariel Biso" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Jenn Mariel Biso</h3>
</div>

<div class="w3-third">
  <img src="images/xave.jpg" alt="Xavier Ramos" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Xavier Ramos</h3>
</div>

<div class="w3-third">
  <img src="images/ella.jpg" alt="Ella Nicole Quinto" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Ella Nicole Quinto</h3>
</div>

<div class="w3-third">
  <img src="images/rose.jpg" alt="Rosemarie Sollesta" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Rosemarie Sollesta</h3>
</div>

<div class="w3-third w3-margin-top w3-hide-small">
  <img src="images/logonotitle.png" alt="Logo" style="width:45%" class="w3-circle w3-hover-opacity">
</div>

<div class="w3-third">
  <img src="images/lhyzel.jpg" alt="Lhyzel Tunguia" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Lhyzel Tunguia</h3>
</div>
</div>
</div>

<!-- CONTACT CONTAINER -->
<div class="w3-container w3-padding-64 w3-theme-l5" id="contact">
  <div class="w3-row">
    <div class="w3-col m5">
      <div class="w3-padding-16"><span class="w3-xlarge w3-border-teal w3-bottombar">Contact</span></div>
      <h3>Technological University of the Philippines-Taguig</h3>
      <p><i class="fa fa-map-marker w3-text-teal w3-xlarge"></i>    Km 14 East Service Road Western Bicutan, Taguig City</p>
      <p><i class="fa fa-phone w3-text-teal w3-xlarge"></i>    (+632) 823-2456(7)</p>
      <p><i class="fa fa-envelope-o w3-text-teal w3-xlarge"></i>    taguig@tup.edu.ph</p>
    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

function confirmResult() {
var confirm = "<?php echo $confirm;?>";
  if (confirm==1) {
    alert("Nothing to export.");
  }
  else {
    window.location.href="ExportCSV.php";
  }
}
</script>

</body>
</html>
