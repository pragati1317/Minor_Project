
<!DOCTYPE html>
<html>
	<!-- created by pragati -->
<head>
	<title></title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Dancing+Script" rel="stylesheet">
</head>
<body >
    <?php 
      require('ecomHeader.php');
    ?>
	<h1 class="text-center text-danger mb-5" 
	style="font-family: 'Abril Fatface', cursive;">Your Online Shop</h1>

	<div class="row">

	<?PHP
    //  echo "$userId"; 
    // session_start();
     require('connection.php');
   
      $userId=$_SESSION['userId'];
	  
      if(isset($_GET["action"]))
      {
        if($_GET["action"]==="remove")
        {
           $id=$_GET['id'];
           $q="delete from products where userId='$userId' and productId='$id' ";
           mysqli_query($con, $q);
       }
   }
	$query = " SELECT userId, title, slug, sku,price, discount,quantity FROM products  where userId='$userId'  ";
    $queryfire=mysqli_query($con, $query);

	$num=mysqli_num_rows($queryfire);

	if($num>0)
	{
		 while($product=mysqli_fetch_array($queryfire))
		 {
			 ?>
             <div class="col-lg-3 col-md-3 col-sm-12 m-auto">

                <form>
                   <div class="card">
                       <h6 class="card-title mt-2 mb-2" style=" margin:auto;"> <?php echo $product['title'] ;?></h6>
                       <h6 class="card-title " style=" font-size:small; color:grey; margin:auto;"> <?php echo $product['sku'] ;?></h6>
                       <div class="card-body" >
                         
                           <img src="../images/<?php  echo $product['slug'];?>" alt="Products" srcset="" class="img-fluid  mb-2" style="width:150px; height:200px;">
                          
                           <h6>&#8377 <?php echo $product['price']; ?>
                          <span> (<?php echo $product['discount']; ?> % off)</span> </h6>
                         <h6 class="badge badge-success "> 4.4 <i class="fa fa-star"></i></h6>
                         <h6 class="mr-3" style=" color:grey;"> Available Stock<span> <h6  class="badge badge-success" style="display:inline;" > <?PHP echo $product['quantity']; ?></h6></span></h6> 
                        <!-- <input type="number" name="Quantity" class="from-control" placeholder="Enter Quantity"  > -->
                       </div>
       
                       <div class="d-flex m-auto ">
                        <button class="btn btn-success mr-2 mb-5" ><a href="product.php?action=remove&id=<? echo $product['productId']; ?>"> Remove</a></button>
                        <button class="btn btn btn-warning mb-5" >Update</button>
                </div>
                   </div>
                </form>
                </div>
       
          <?PHP
                }
           }

        
           ?>
                   
                   </form>
       
               </div>
       
           </div>
</body>
</html>