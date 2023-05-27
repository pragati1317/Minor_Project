<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style6.css">
    <title>Document</title>
</head>
<body>
<div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form  method="post">
                <h2 class="text-center"><strong>Create Your Shop</strong></h2>
                <div class="form-group"><input  type="text" name="shopname" placeholder="Shop name" required></div>
                <div class="form-group"><input  type="text" name="visit" placeholder="your shop website" required></div>              
                <div class="form-group"><input  type="text" name="Address1" placeholder="Address line 1" required></div>
                <div class="form-group"><input  type="text" name="Address2" placeholder="Address line 2" ></div>
                <div class="form-group"><input  type="text" name="city" placeholder="Enter your city"  required></div>
                <div class="form-group"><input type="text" name="state" placeholder="State"  required></div>
                <div class="form-group">
                    <label for="Shop Type">Shop Type</label>
                   <input type="radio" name="Shop Type"  class="shop" value="Machinery" checked/> Machinery
                   <input type="radio" name="Shop Type" class="shop"  value="Medicinary" />Medicinary
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="Add">Add</button></div</form>
        </div>
    </div>
</body>
</html>

<?php 

session_start();
require('connection.php');
require('functions.php');
 
 if(isset($_POST["Add"]))
 {
    $shopname=$_POST['shopname'];
    $Address1=$_POST['Address1'];
    $Address2=$_POST['Address2'];
    $visit=$_POST['visit'];
    $city=$_POST['city'];
    $state=$_POST['state'];

    $code=rand(1,99999);
    $shopId="SP".$code."ID";
    // $userId=$_SESSION['userId'];
     // $contact="select phone_no from users where userId='$userId';";
     $userId="user20014sh";
     $contact='9399810956';
    $Addshop="insert into shops values('$userId', '$shopId', '$shopname','$contact', '$visit');";
    $AddQuery=mysqli_query($con,$Addshop);
    // Here for location id we will use shop id 

    $locationAdd="insert into location values('$shopId','$Address1','$Address2','$city','$state');";
     $locationQuery=mysqli_query($con,$locationAdd);

     echo "<script> alert('Shop Details Successfully Added');</script>";
    
 }
?>