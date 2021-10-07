<?php  
 //This code is for search function of datasheets page
 if(isset($_POST["datepicker"]))
 {  
  include("connection.php");
  $output = '';
  $datepicker = $_POST["datepicker"];
  $query = "SELECT * FROM batt WHERE Date = '$datepicker'";
  $result = mysqli_query($conn, $query);
  $output .= '
    <table class="table custom-table">
        <tr class="bg-primary text-white">
          <th scope="col">
            <label class="control control--checkbox">
              <input type="checkbox"  id="checkall2">
              <div class="control__indicator"></div>
            </label>
          </th>
          
          <th scope="col">Date</th>
          <th scope="col">Time</th>
          <th scope="col">Battery 1</th>
          <th scope="col">Battery 2</th>
          <th scope="col">Battery 3</th>
          <th scope="col">Average</th>
        </tr>
  ';
  if(mysqli_num_rows($result) > 0)  
  {  
   while($row = mysqli_fetch_array($result))  
   {  
    $output .= '
    <tbody>
        <tr scope="row" class="<?php if(isset($classname)) echo $classname;?>">
          <th scope="row">
            <label class="control control--checkbox">
              <input type="checkbox" class="checkitem2" value="'.$row["id"].'">
              <div class="control__indicator"></div>
            </label>
          </th>
        <td>'.$row["Date"].'</td>
        <td>'.$row["Time"].'</td>
        <td>'.$row["battery1"].'</td>
        <td>'.$row["battery2"].'</td>
        <td>'.$row["battery3"].'</td>
        <td>'.$row["batttotal"].'</td>
        </tr>
    </tbody>
    ';
   }
  }
  else
  {
       $output .= ' 
            No records found.  
       ';  
  }  
  $output .= '</table>';  
  echo $output;  
 }  
 ?>

 <!-- JAVASCRIPT -->
<script src="assets_datasheets/js/jquery-3.3.1.min.js"></script>
<script src="assets_datasheets/js/popper.min.js"></script>
<script src="assets_datasheets/js/bootstrap.min.js"></script>
<script src="assets_datasheets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
//Select all
$('#checkall').change(function() {
    $('.checkitem').prop("checked", $(this).prop("checked"))
})
$('#checkall2').change(function() {
    $('.checkitem2').prop("checked", $(this).prop("checked"))
})
</script>