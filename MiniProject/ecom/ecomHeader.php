<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Document</title>

</head>
<body>
    <style>
        .navbar
        {
         background: linear-gradient(30deg, rgb(14, 127, 14), rgb(200, 211, 21), rgb(60, 216, 65) , rgb(235, 211, 21), rgb(15, 211, 21));
        }
         </style>
<?php 

require('connection.php');
require('functions.php');

session_start();
$user=$_SESSION['userId'];
$res=profileValue($con,$user); 
?>
<div class="navbar"   >
            <div class="leftnav">
                 
                 <?php
                   
                    if($res['profession']==1)
                    {   ?>
                       <ul>
                       <a ><img src="../images/AgriTech!.png" alt="" srcset="" class="logo" style="width:70px; top:0.4rem;"></a>
                        <li><a href="shop.php" >SHOP</a></li> 
                         <li><a href="cart.php"> CART</a></li>
                       <li><a>WHISHLIST </a></li>
                       <li><a href="MyOrder.php">MY ORDER</a></li>  
                       <!-- <li><a href="#">ABOUTUS </a></li> -->
                    </ul>
                      <?php
                    }
                    else if($res['profession']==2)
                    { 
                        ?>
                         <ul>
                         <a ><img src="../images/AgriTech!.png" alt="" srcset="" class="logo" style="width:70px;"></a>
                        <li><a href="product.php"> Show </a> </li>
                        <li><a  href="AddShow.php">Add shop</a></li>
                        <li><a  href="./shopkepper.html">Add products</a></li>
                          
                        </ul>

                        <?php
                    }
                    
                 ?>
                   
            </div>
            <div class="rightnav">
                <ul>
                      <li><a href="../profile.php"><img src="../images/profile.png" alt="profile" srcset="" class="profile"></a></li>
                      <li> <form action="../logout.php" method="post">
                        <input type="submit" name="logout" value="logout">
                       </form></li>
                </ul> 
            </div>
        </div>
    
</body>
</html>