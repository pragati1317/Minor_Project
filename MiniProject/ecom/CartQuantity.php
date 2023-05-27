<?php

require('connection.php');
//  Quantity increase
           if(isset($_GET["action"]))
            {$id=$_GET['Id'];

                  if($_GET["action"]=="increase")
                  {
                     
                     $q="update cartitem set quantity=quantity+1 where id='$id' ;";
                     mysqli_query($con,$q);
                  }
                  else if($_GET["action"]=="dec")
                  {
                    
                         $q="update cartitem set quantity=quantity-1 where id='$id' and quantity>0;";
                     $r=mysqli_query($con,$q);
       
                  }
                  else if($_GET["action"]=="del")
                  {
                     $q="delete from cartitem where id='$id';";
                     mysqli_query($con,$q);
                  }
            }
             header('location:cart.php');

            ?>