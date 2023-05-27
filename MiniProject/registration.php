<?php

//   Querry for connect with mysql
require('./ecom/connection.php');


// Selecting a database , which we want to use
session_start();
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['password'];
$phone=$_POST['phone'];
$profession=$_POST['Profession'];
// date_default_timezone_set('Asia/kolkata');
// $registeredAt = date('y-m-d h:i:s');

$code=rand(1,99999);

$userId="user".$code.'sh';
$q = " select * from users where phone_no='$phone' && password='$pass'  ";
$result=mysqli_query($con, $q); // validation
$num=mysqli_num_rows($result); 
// echo $profession;
if($num==1)
{
    echo "already register";
}
else{
     if(preg_match("/^[0-9]{9,11}$/" , $phone))
     {

        $_SESSION['userId']=$userId;
        $qy="insert into users(userId,name, phone_no,  password,email,profession,verification_code) values ( '$userId', '$name' ,'$phone' ,'$pass','$email','$profession','0') ";
        mysqli_query($con, $qy); 
        $_SESSION['login']='yes';
        // header('location:index.html');
        header('location:index.php');
    
     }
   
     else 
     {
        $ErrMsg="Phone Number is invalid";
        echo $ErrMsg;
     }
  
}


?>