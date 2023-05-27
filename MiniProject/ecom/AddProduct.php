<?php 

session_start();

// if(!isset($_SESSION['phone'])) // Not go back to login page 
// {
//  header('location:login.php');
// }
?>

<?php
require('connection.php');

$Product_name=$_POST['title'];
$media=$_POST['media'];
$type=$_POST['ProductType'];

$price=$_POST['price'];
$discount=$_POST['discount'];
$quantity=$_POST['quantity'];

$userId=$_SESSION['userId'];
$sku="I am pragati Gupta";
// $userId=$_SESSION['userId'];
// $sku=$_SESSION['Name'];

$code=rand(1,999999);
$productId="PID".$code."sh";
$q="insert into products(productId, userId, title,slug,type,sku, price ,discount,quantity ) values('$productId','$userId' , '$Product_name' ,'$media','$type','$sku', '$price' , '$discount' , '$quantity');";
mysqli_query($con, $q);
header('location:product.php');
?>