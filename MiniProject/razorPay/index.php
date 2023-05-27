
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../styles/style4.css">
</head>
<body>

<?php 
session_start();
require('../ecom/connection.php');
// require('functions.php');

$userId=$_SESSION['userId'];
$userDetails="select * from users where userId='$userId'";
$querryFire=mysqli_query($con,$userDetails);
$num=mysqli_num_rows($querryFire);
if($num==1)
{
  $res=mysqli_fetch_assoc($querryFire);
}

$locationDetails="select * from location where location_Id='$userId'";
$qr=mysqli_query($con,$locationDetails);
$num1=mysqli_num_rows($qr);

if($num1>0)
{
  $location=mysqli_fetch_assoc($qr);
}

$_SESSION['locationNum']=$num1;
?>
<h2>Farmy</h2>
<p>Fill the below form to checkout.</p>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/index.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Buyer Details</h3>
            <label for="fname">Fill your personal details below.</label> <br/>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe" value="<?php if($num==1){ echo $res['name']; } ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com"   value="<?php if($num==1){ echo $res['email']; } ?>" >
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Shipping Address</h3>
            <label for="fname">Enter your shipping address below.</label> <br/>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" value="<?php if($num1==1){ echo $location['Address_line1']; } ?>">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York" value="<?php if($num1==1){ echo $location['city']; }?> ">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY" value="<?php if($num1==1){ echo $location['state']; }?> ">
              </div>
              <!-- // <div class="col-50">
              //   <label for="zip">Zip</label>
              //   <input type="text" id="zip" name="zip" placeholder="10001">
              // </div> -->
            </div>

            <div class="row">
              <div class="col-50">
              <label> Enter Amount to pay</label>
                 <input type="number" name="amt" id="amt" placeholder="Enter amt"  value="<?php echo $_SESSION['Total']; ?>" ><br/><br/>
              </div>
              <div class="col-50">
              <label>
             <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
             </label>
              </div>
              
            </div>

            <div class="col-50">
              <input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()"/>
              </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div> 
 
<?php 

 if(isset($_POST['sameadr']))
 {
  $var1=$_SESSION['locationNum'];
  if($var1==0)
  {
      $locationId=$_SESSION['userId'];
      $Address=$_POST['address'];
      $city=$_POST['city'];
      $state=$_POST['state'];
     // $zip=$_POST['zip'];

    $check= $mysqli_query($con, "insert into location values('$locationId', '$Address', 'NULL','$city', '$state')");
 if($check)
 {
  echo '<script>alert("successful working"); </script>';
 }
 else 
 {
  echo '<script>alert("Nothing "); </script>';
 }
  }
 }

?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="../app_js/index.js"></script>
</html>

