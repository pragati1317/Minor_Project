<?php

session_start();

require('./ecom/connection.php');

// Selecting a database , which we want to use
$pass=$_POST['password'];
$phone=$_POST['phone'];


$q = " select * from users where phone_no='$phone' &&   password='$pass'  ";

$result=mysqli_query($con, $q); // validation

$num=mysqli_num_rows($result); 
 
if($num == 1)
{
     $row=mysqli_fetch_assoc($result);

     $_SESSION['userId']=$row['userId'];
    echo session_status();
    //die();
    $_SESSION['login']='yes';
    if($row['profession']==2)
    {
        header('location:./ecom/shop.php');
    }
    else
    {
       header('location:index.php');    
    }
    
}
else{

    header('location:login.php');
}


?> 