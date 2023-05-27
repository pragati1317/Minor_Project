
<?php

require('connection.php');
require('functions.php');
session_start();
$userId=$_SESSION['userId'];
 if(isset($_GET["action"]))
 {
       if($_GET["action"]=="placeOrder")
       { 
            $cartId=$_SESSION['cartId'];
            $q="select * from cartitem where cartid='$cartId';";
            $queryfire=mysqli_query($con,$q);
            $num=mysqli_num_rows($queryfire);

            if($num>0)
            {
                // create session
                $code=rand(1,9999999);
                $sessionId="SN".$code."U";

                $createdAt=createAt();

                $SubTotal=0;
                $Discount=0;
            
                while($order=mysqli_fetch_array($queryfire))
                {
                    $random=rand(1,99999);
                    $orderId="OD".$random."IU";
                    $productId=$order['productid'];
                   
                    $price=$order['price'];
                    $discount=$order['discount'];
                    $quantity=$order['quantity'];

                    $q="select * from products where productId='$productId' ";
                    $row=mysqli_query($con,$q); 
                    $res=mysqli_fetch_assoc($row); 
                     $sku=$res['sku'];
                   $PlaceOrder="insert into orderitem (userId, productId, orderId, sku,price,discount,quantity,createdAt) values('$userId','$productId', '$orderId', '$sku','$price' ,'$discount', '$quantity', '$createdAt')";
                   mysqli_query($con,$PlaceOrder);
                    
                 
                   $Discount=(float)$Discount+(float)(($order['discount']*$order['price'])/100)*$order['quantity'];
                   $SubTotal=(float)$SubTotal+ (float)$order['price']*$order['quantity'];
                }
                $Total=((float)$SubTotal- (float)$Discount);
                // echo $Discount."<br>".$SubTotal."<br>".$Total."<br>";
                $OrderQuery="insert into agritech.Order(userId,sessionId,subTotal,itemDiscount,total,createdAt) values('$userId','$sessionId','$SubTotal','$Discount', '$Total', '$createdAt')";
               $check= mysqli_query($con,$OrderQuery);

            }
       }
       if($check)
       {
         $_SESSION['Total']=$Total;

       }
      header('location:../razorPay/index.php');
    }
?>