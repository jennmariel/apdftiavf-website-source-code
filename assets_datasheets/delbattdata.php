<?php
    include('connection.php');
    $page = isset($_GET['p'])? $_GET['p']:'';
    if($page=='del') {
        $myid = $_POST['id'];
        $id = str_replace(' ',',', $myid);
        $sql = "DELETE FROM batt WHERE id in($id)";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "SELECT * FROM batt";
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()) {
            ?>
    <tr>
        <td>
        <label class="control control--checkbox">
          <input type="checkbox" class="checkitem2" value="<?php echo $row['id'];?>">
          <div class="control__indicator"></div>
        </label>
        </td>
        <td><?php echo $row['Date'];?></td>
        <td><?php echo $row['Time'];?></td>
        <td><?php echo $row['battery1'];?></td>
        <td><?php echo $row["battery2"];?></td>
        <td><?php echo $row["battery3"];?></td>
        <td><?php echo $row["batttotal"];?></td>
    </tr>
        <?php
        }
    }
?>