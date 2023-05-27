
<?php

$con=mysqli_connect("localhost","root", "TOnu@6300", "agritech");
if(mysqli_connect_error()){
    echo"<script('Cannot connect to the database');</script>";
    exit();
}
?>