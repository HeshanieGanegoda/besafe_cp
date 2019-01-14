<?php
//including the database connection file
include("dbconfig.php");
//getting id of the data from url
$Mobile = $_GET['Mobile'];
//deleting the row from table

$rresulta =  "DELETE FROM `customer` WHERE Mobile=$Mobile";
$resulta = mysqli_query($conn, $rresulta);
//redirecting to the display page (index.php in our case)
header("Location:customer.php");
?>