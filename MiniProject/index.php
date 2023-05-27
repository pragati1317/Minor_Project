<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farming Informative website</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;500&family=Jockey+One&family=Overlock:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Dancing+Script" rel="stylesheet"> 
    <link rel="stylesheet" href="styles\style1.css">
    <link rel="stylesheet" href="styles\style.css">
    <link rel="stylesheet" href="styles\style5.css">
    <link rel="stylesheet" href="styles\style3.css">

</head>
<body >
     
<script src="app_js\index.js"></script>

<?php 
 require('ecom\connection.php');
 require('ecom\functions.php');
?>
     <header>
        <div class="navbar">
            <div class="leftnav">
              
                <ul> 
                     <li><a ><img src="./images/AgriTech!.png" alt="" srcset="" style="width:70px;" class="logo"></a></li>
                    <li><a href="#Home">Home</a></li>
                     <li><a href="./GovtNews/index.html">News</a></li>
                     <li > <a href="#">Government Scheme</a>  </li>
                       <li><a href="#About"> About</a></li> 
                       <li><a href="#contact"> Contact Us</a></li> 
                </ul>
            </div>
            <?php

        //     require('ecom/connection.php');
        //    session_start();
            ?>
            <div class="rightnav">
                <ul>
                    <li> <a href="login.php">Login </a></li>
                     <li > <a href="signUp.html">Sign Up </a></li>
                      <li><a href="profile.php"><img src="./images/profile.png" alt="profile" srcset=""></a></li>
                       <li> <form action="logout.php" method="post">
                        <input type="submit" name="logout" value="logout">
                       </form></li>
                </ul> 
            </div>
        </div>
</header>
<div class="page1" id="Home">
        <div class="page1container">
             <div class="mainContain" style="background-image: url('./images/2845443.jpg');"> </div>
           <div class="otherService">
            <div class="services"><span>View Weather</span>
                <button class="btn" target="blank"><a href="./weatherappwithjavascript/index.html" style="color:black">Explore more</a></button>
            </div>
            <?php 
         //  echo PHP_SESSION_ACTIVE;
        //    echo session_status();
           // die();
           if(session_status()!==PHP_SESSION_ACTIVE)
           {
            session_start();
           }
             
          
               if($_SESSION['login']==='yes')
               {
            
              $userId=$_SESSION['userId'];
              $q=mysqli_query($con,"select * from users where userId='$userId'");
              $res=mysqli_fetch_assoc($q);
              $profession=$res['profession'];
               if($res['profession']==3 || $res['profession']==1)
               {
                ?>
            <div class="services" > <span>Crop Ratelist</span>
                <button class="btn" onclick="window.location.href='HamariMandi.php'" target="blank"></a>Explore more</button>
            </div>
            <?php
               }
               if ($res['profession']==2 || $res['profession']==1)
               {

            ?>
            <div class="services"> <span>AgriTech Stores</span>
                <button class="btn" onclick="window.location.href='./ecom/shop.php'" target="blank">Explore more</button>
            </div>
            <?php
               }
              }
            
            ?>
          </div>
        </div>
       
    </div>
 
    <div class="page2" >
      <div class="pageheading" id ="StoresSearch">
         <h1>Search for Shops in your City</h1>
      </div>

           <form action="" method="post" class="Search">
            <input type="text" name="ShopSearch" id="search" placeholder="Shop Search">
             <!-- <div class="choice" >
              
                 <input type="button" value="machinery" name="submit" class="options">
            
              <input type="button" value="medicine" class="options">
            
             </div> -->
           
            <button type="submit" name="submit" class="bg-success"  style="border-radius:0.5rem;padding:4px; color:white; ">submit</button>

           </form>

           <?php

           if (isset($_POST["submit"])) {
	      $str = $_POST["ShopSearch"];
  
	$q="select * from location where location_id like 'SP%' and city='$str';";
    $querryfire=mysqli_query($con,$q);
	$num=mysqli_num_rows($querryfire);
	// $result =mysql_query($sth);  
	// echo $num;

    if($num>0)
	{
		
		?>
		 <br><br><br>
		<table align="center" border="1px" style="width:800px; line-hieght:300px; top:600px; margin:auto;">
			<tr>
				<th>Avaiable shop</th>
                <th>Address</th>
				<th>City</th>
				<th>contact</th>
				<th>visit</th>
			</tr>
			<?php	
				while($shoplocation=mysqli_fetch_array($querryfire))
	       	{
                $shopId=$shoplocation['location_id'];
                $shopQ="select * from shops where shopId='$shopId'";
                $qf=mysqli_query($con,$shopQ);
                $shops=mysqli_fetch_assoc($qf);
			?>
	
			<tr>
				<td><?php echo $shops['shopname']; ?></td>
				<td><?php echo $shoplocation['Address_line1']; ?></td>
				<td><?php echo $shoplocation['city']; ?></td>
				<td><?php echo $shops['contact']; ?></td>
				<td><a href="<?php echo $shops['visit']; ?>">view website<a></td>
			</tr>

 <?php 
			}
	}
		

		else{
			echo "City Does not exist";
		}
    }
 ?>

</table>
    </div>
      
      <div class="page1" id="About">
        <div class="pageheading">
        <h1 style="color:white;">About us </h1>
      </div>
      <div class="content">
        <div class="jobs">
           <h4>View Ratelist</h4>
           <h6> Farmer can view ratelist of crops update on daily basis</h6>
           <a href="HamariMandi.php">Explore More</a>
        </div>
        <div class="jobs">
           <h4>Search for Agritech Shops</h4>
           <h6>user can Search for Agriculture Medicinary and machinary shops</h6>
           <a href="#StoresSearch">Explore More</a>
        </div>
        <div class="jobs">
           <h4>Agiculture stores</h4>
           <h6>Agritech provide features of Buy and sell of Organic products and other equipments</h6>
           <a href=".\ecom\shop.php">Explore More</a>
        </div>
        <div class="jobs">
           <h4>Government Scheme</h4>
           <h6>Agritech focuses to spread an Awareness in between farmers</h6>
           <a href="">Explore More</a>
        </div>
        <div class="jobs">
           <h4> Farming News</h4>
           <h6>Agritech ensure to provides daily basis updated Farming News</h6>
           <a href="./GovtNews/index.html">Explore More</a>
        </div>
      </div>
  </div>

  <?php 
  require('footer.html')
  ?>


</body>
</html>