
<?php
session_start();
 require('connection.php');
  require('functions.php');
$userId=$_SESSION['userId'];

 $status=0;  // 0 -> new , 1-> cart , 2-> checkout, 3->paid , 4->complete , 5->Abandoned;
 $q="select * from cart where userId='$userId' ";
$result=mysqli_query($con, $q);
 $num=mysqli_num_rows($result);
 if($num==0)
 {  //  create sessionId
    $code=rand(1,99999);
    $cartId="C".$code ."Id";
   $_SESSION['cartId']=$cartId;

    $createdate=createAt();
    $queryfire="insert into cart values('$cartId','$userId' , '$createdate' )";
    $res=mysqli_query($con, $queryfire);
    header('location:AddItemToCart.php');
    // header('location:shop.php');
 }
 else 
 {
  
   $qr="select cartId from cart where userId='$userId'; ";
    $row=mysqli_query($con, $qr);
    $res=mysqli_fetch_assoc($row);

    $_SESSION['cartId']=$res['cartId'];


 }

// $rq;

if(isset($_GET["action"]))
{
    if($_GET["action"]=="add")
    {
      $productId=$_GET["id"];  
    //  $Quantity=$_GET['Quantity']; 
      // $rq=$_GET["Quantity"];
    }
    else if($_GET["action"]=="buyNow")
    {
       $productId=$_GET["id"];
     //  $Quantity=$_GET['Quantity']; 
    }


$cartId=$_SESSION['cartId'];
$q="select * from products where productId='$productId'";
$row=mysqli_query($con,$q);
$res=mysqli_fetch_assoc($row);

// product details
$price=$res['price'];
$discount=$res['discount'];


$check="select * from cartitem where productid='$productId' and cartid='$cartId'; ";
$queryfire=mysqli_query($con, $check);
$num=mysqli_num_rows($queryfire);
// $rq=$_SESSION['Quantity'];  // required quantity of that product 
//  //  $rq=(int) $rq;
//      $q=$res['quantity'] ; // check for the available stock 
   //  $quantity= $q + $Quantity; // for reset the value of stock
   // //     echo $quantity;
   // echo $Quantity;
    echo "Hello";

   // echo $num;
   //die();
     $quantity=$res['quantity'] +1;
     if($quantity>=0)
     {  if($num==1)
        {
            $qr="update cartitem set quantity+=1 where productId='$productId';";
          mysqli_query($con, $qr);
        }
        else 
        {
             // active will be 1 when click on buy now
    date_default_timezone_set('Asia/kolkata');
    $createdate =date('y-m-d h:i:s');
    $cartDetails=$res['title']."<br>".$res['slug']."<br>".$res['sku'];
    
    $AddToCart="insert into cartitem(productid, cartid,cart_details, price,discount,quantity,active, createdat) values('$productId', '$cartId','$cartDetails' ,'$price','$discount','$quantity',0, '$createdate' );";
     $finalQuery=mysqli_query($con, $AddToCart);
        
        }
        
     }
     else 
     {
        echo  "<script>alter('Limited stoke');</script>";
       
     }
}
   
        if($_GET["show"]=='yes')
           {
             header('location:cart.php');
           }
           else 
           {
            header('location:shop.php');
           } 

?>