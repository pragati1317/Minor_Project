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
          $cart=mysqli_query($con, "select * from cart where userId='$userId'");
          $res=mysqli_fetch_assoc($cart);
          $cartId=$res['cartId'];
        $query="select * from cartitem where cartid='$cartId';";
        $queryFire=mysqli_query($con, $query);
        $num=mysqli_num_rows($queryFire);
     ?>
<div class="container bg-white rounded-top mt-5" id="zero-pad">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12 pt-3">
            
      
            <div class="d-flex flex-column pt-4">
                <div><h5 class="text-uppercase font-weight-normal">shopping bag <?php echo " (".$num .")";?></h5></div>
                
            </div>
      
            <div class="d-flex flex-row px-lg-5 mx-lg-5 mobile" id="heading">
                <div class="px-lg-5 mr-lg-5" id="produc">PRODUCTS</div>
                <div class="px-lg-5 ml-lg-5" id="prc">PRICE</div>
                <div class="px-lg-5 ml-lg-1" id="quantity">QUANTITY</div>
                <div class="px-lg-5 ml-lg-3" id="total">TOTAL</div>
            </div>
                  
           
       <?php
        
        
        if($num>0)
        {$n=1;
            $totalSum=0;

        
            while($CartItem=mysqli_fetch_array($queryFire))
            { 
                
                 $productId=$CartItem['productid'];
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
                        <div>Owner:<span class="pl-3"><?php echo $result['sku'] ; ?></span></div>
                        <div>Discount:<span class="pl-4"> (<?php echo $CartItem['discount']; ?> % off)</span></div>
                    </div>                    
                </div>
                <div class="pl-md-0 pl-1"><b> &#8377  <?php echo $CartItem['price'];?></b></div>
                <div class="pl-md-0 pl-2">
                        <a href="CartQuantity.php?action=dec&Id=<?php echo $CartItem['id'];?>">  <span class="fa fa-minus-square text-secondary"></a></span>
                        <span class="px-md-3 px-1"><?php echo $CartItem['quantity'];?></span>
                        <a href="CartQuantity.php?action=increase&Id=<?php echo $CartItem['id'];?>"><span class="fa fa-plus-square text-secondary"></a></span>
                </div>
                <div class="pl-md-0 pl-1"><b> &#8377   <?php $subtotal=$CartItem['price']*$CartItem['quantity']; echo $subtotal ; ?></b></div>
                <div class="close"><a href="CartQuantity.php?action=del&Id=<?php echo $CartItem['id']; ?>">&times;</a></div>
            </div>
<?php
 $n=$n+1;
 $totalSum=$totalSum + $subtotal;
}
        }
        ?>
        </div>
    </div>
</div>

<div class="container bg-light rounded-bottom py-4" id="zero-pad">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-sm bg-light border border-dark"><a href="shop.php">GO BACK</a></button>
                </div>
                <div class="px-md-0 px-1" id="footer-font">
                    <b class="pl-md-4">SUBTOTAL<span class="pl-md-4">&#8377  <?php echo $totalSum ;?>  </span></b>
                </div>
                <div>
                    <button class="btn btn-sm bg-dark text-white px-lg-5 px-3" type="submit" ><a href="order.php?action=placeOrder">CONTINUE</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>