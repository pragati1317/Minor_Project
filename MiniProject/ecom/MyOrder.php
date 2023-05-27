<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body> 
     <?php  require('ecomHeader.php');
            $totalSum=0;
       $userId=$_SESSION['userId'];
        $query="select * from orderitem where userId='$userId';";
        $queryFire=mysqli_query($con, $query);
        $num=mysqli_num_rows($queryFire);
     ?>
<div class=" bg-white rounded-top mt-5" id="zero-pad">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12 pt-3">
            
      
            <div class="d-flex flex-column pt-4">
                <div><h5 class="text-uppercase font-weight-normal">My Order<?php echo " (".$num .")";?></h5></div>
                
            </div>
      
            <div class="d-flex flex-row px-lg-5 mx-lg-5 mobile" id="heading">
                <div class="px-lg-5 mr-lg-4" id="produc">PRODUCTS</div>
                <div class="px-lg-5 ml-lg-5" id="prc">Details</div>
                <div class="px-lg-5 ml-lg-4" id="quantity">QUANTITY</div>
                <div class="px-lg-5 ml-lg-4" id="total">TOTAL</div>
            </div>
                  
           
       <?php
        
        
        if($num>0)
        {$n=1;

            while($OrderItem=mysqli_fetch_array($queryFire))
            { 
                
                 $productId=$OrderItem['productId'];
                 $q1="select * from products where productId='$productId'";
                 $qf=mysqli_query($con,$q1);
                 $result=mysqli_fetch_assoc($qf);

                ?> 

            <div class="d-flex flex-row justify-content-between align-items-center pt-lg-4 pt-2 pb-3 border-bottom mobile">
                <div class="d-flex flex-row align-items-center">
                    <div><img src="../images/<?php echo $result['slug']; ?>" width="150" height="150" alt="" id="image"></div>
                    <div class="d-flex flex-column pl-md-3 pl-1">
                        <div><h6><?php echo  $result['title'];?></h6></div>
                        <div >Cart No:<span class="pl-2"> <?php echo $n;?> </span></div>
                        <div >Owner:<span class="pl-3 d-flex flex-column pl-md-2 pl-1"><?php echo $result['sku']; ?></span></div>
                        <div>Discount:<span class="pl-4"> (<?php echo $OrderItem['discount']; ?> % off)</span></div>
                    </div>        
                     <div class="m-auto px-lg-5 ml-lg-5"><b> <?php echo $OrderItem['quantity']?></b></div>
                <div class="pl-md-0 px-lg-5 ml-lg-5"><b> &#8377   <?php $subtotal=$OrderItem['price']*$OrderItem['quantity']; echo $subtotal ; ?></b></div>           
                </div >
                
              <button class="btn m-auto  bg-success" type="submit" ><a href="./shop.php">ReOrder</a></button>
            </div>
<?php

}
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>