<?php



    $conn = mysqli_connect('localhost', 'hesh', 'hesh123');
        if (!$conn){
            die("Database Connection Failed" . mysqli_error($conn));
        }
    $select_db = mysqli_select_db($conn,'bank_atm_DB');
        if (!$select_db){
            die("Database Selection Failed" . mysqli_error($conn));
        }




?>