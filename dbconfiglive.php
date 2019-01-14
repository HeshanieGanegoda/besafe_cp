<?php
$conn = mysqli_connect('18.216.191.70:3308', 'super_admin', 'qscwdvefb12345678');
if (!$conn){
    die("Database Connection Failed" . mysqli_error($conn));
}
$select_db = mysqli_select_db($conn,'bank_atm_DB');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($conn));
}



?>