<?php 

require('./ecom/connection.php');
require('./ecom/functions.php');
session_start();

              // cropId should be create by system
              $userId=$_SESSION['userId'];
              $cropId=rand(1,9999999);
              $cropType=$_POST['cropType'];
              $rate=$_POST['rate'];
              
              date_default_timezone_set('Asia/kolkata');
             $ReleaseDate = date('y-m-d h:i:s');
             
             $q="insert into ratelist values('$userId' , '$cropId' , '$cropType' , '$rate' , '$ReleaseDate' ) ;";
             $queryFire=mysqli_query($con,$q);
             

             if($queryFire)
             {
                echo "<script> alter('successfully Added')
                </script>";
                header('location:HamariMandi.php');
             }
             else
             {
                echo "<script> alter('successfully Added')
                </script>";
                header('location:HamariMandi.php');
             }
            ?>
       