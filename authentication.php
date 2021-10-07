<?php
//This code is for authenticating user login.
    include('connection.php');  
    $username = $_POST['user'];  
    $password = $_POST['pass'];
    $_SESSION["status"]=false;
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "select * from users where username = '$username' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($count == 1){
            $_SESSION["status"]= true;
            header("location: home.php");
            exit();
        }  
        else{  
            header("location: loginfail.html");
            exit();
        }  
?>