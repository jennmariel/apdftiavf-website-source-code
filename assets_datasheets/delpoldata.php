<?php
    include('connection.php');
    $page = isset($_GET['p'])? $_GET['p']:'';
    if($page=='del') {
        $myid = $_POST['id'];
        $id = str_replace(' ',',', $myid);
        $sql = "DELETE FROM polstats WHERE id in($id)";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "SELECT * FROM polstats";
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()) {
            ?>
    <tr>
        <td>
        <label class="control control--checkbox">
          <input type="checkbox" class="checkitem" value="<?php echo $row['id'];?>">
          <div class="control__indicator"></div>
        </label>
        </td>
        <td><?php echo $row['Date'];?></td>
        <td><?php echo $row['Time'];?></td>
        <td><?php echo $row['plantid'];?></td>
        <td><?php echo $row["progress"]. '/' .$row["total"];?></td>
        <td><?php echo $row['stats'];?></td>
    </tr>
        <?php
        }
    }
?>