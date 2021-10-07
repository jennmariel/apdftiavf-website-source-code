<?php
Class dbObj{
/* Database connection start */
var $dbhost = "localhost";
var $username = "id16629113_user";
var $password = "#Unfathomable2021";
var $dbname = "id16629113_thesis_db";
var $conn;
function getConnstring() {
$conn = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
} else {
$this->conn = $conn;
}
return $this->conn;
}
}

include_once('pdf_mc_table.php');

//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->SetMargins(16, 16, 16);
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->Cell(40,10,'Battery Status Data',0,1,'C');
$pdf->Ln(2);


//set width for each column (6 columns)
$pdf->SetWidths(Array(30,30,30,30,30,28));

//set alignment
$pdf->SetAligns(Array('C','C','C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(7);

$db = new dbObj();
$connString =  $db->getConnstring();
$result = mysqli_query($connString, "SELECT Date, Time, battery1, battery2, battery3, batttotal FROM batt") or die("database error:". mysqli_error($connString));

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Courier','B',10);
$pdf->Cell(30,10,"Date",1,0,'C');
$pdf->Cell(30,10,"Time",1,0,'C');
$pdf->Cell(30,10,"Battery 1(%)",1,0,'C');
$pdf->Cell(30,10,"Battery 2(%)",1,0,'C');
$pdf->Cell(30,10,"Battery 3(%)",1,0,'C');
$pdf->Cell(28,10,"Average(%)",1,0,'C');

$pdf->Ln();

//reset font
$pdf->SetFont('Courier','',10);
//loop the data
foreach($result as $item){
	$pdf->Row(Array(
		$item['Date'],
		$item['Time'],
		$item['battery1'],
		$item['battery2'],
		$item['battery3'],
		$item['batttotal']
	));
}

//output the pdf
$pdf->Output();