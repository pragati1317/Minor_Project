
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="./styles/style2.css">
    <title>Profile_page</title>
</head>
<body>
      <?php 

            require('.\ecom\connection.php');
            require('.\ecom\functions.php');
        //  if(session_status()=== PHP_SESSION_NONE)
        //  {
        //    $login="NO";
        //  }   
        //  else
        //  { session_start();
        //     $login="YES";
        //     $user=$_SESSION['userId'];
        //     $res=profileValue($con,$user); 
        //  }
          
        if(session_status()!==PHP_SESSION_ACTIVE)
        {
           session_start();

            if($_SESSION['login']==='yes' )
            {
                $login="YES";
            $user=$_SESSION['userId'];
            $res=profileValue($con,$user); 
            } 
            else
           {
            $login='NO';
            }  
    
        } 
       
           ?>
           
      <style>
        a{
          top:auto;
          float:left;  
        }
        
      </style>    
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <a class="" href="./index.php">Go Back</a>
            <div class="col-md-3 border-right"> 
               
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php  if( $login=="YES") { echo $res['name']; } else { echo "Username";} ?></span><span class="text-black-50"><?php if( $login=="YES") { echo $res['email']; } else { echo "User Email"; }?></span><span> </span></div>
            </div>

          
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">

                <form action="profileUpdate.php" method="post">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                 <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label>
                        <input  class="border-0 " type="text" name="name" id="name" placeholder="<?php if( $login=="YES") {echo $res['name'] ; } else { echo "Enter Your name";}?>">
                                 </div>
                    <div class="row mt-3">
                        <div class="col-md-12 "><label class="labels">Mobile Number</label>
                         <span><input  class="border-0 " type="tel" name="Phone" id="phone" placeholder="<?php  if( $login=="YES") {echo $res['phone_no'];} else {echo "Enter Your phone Number"; }?>"> </span>
                        </div>
                     <div class="col-md-12"><label class="labels">Address Line 1</label>
                     <span><input  class="border-0 " type="text" name="Phone" id="AddressLine1" placeholder="Address1"></span>
                    </div>

                        <div class="col-md-12"><label class="labels">Email ID</label>
                         <span><input  class="border-0 " type="text" name="email" id="email" placeholder="<?php  if( $login=="YES") {echo $res['email'];  } else { echo "Enter Your Email";}?>"></span>
                        </div>
                        <div class="col-md-12"><label class="labels">Profession</label>
                         <span><input  class="border-0 " type="text" name="profession" id="profession" placeholder="<?php if( $login=="YES") { $value=$res['profession'];  professionValue($value); } else { echo "Profession";} ?>"></span>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="India" ></div>
                        <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                    </div>
                    <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button"  name="edit"
                    id="Profile" onclick="check()">Save Profile</button></div> -->
                  
                    <div class="mt-5 text-center" >
                        <input type="submit" name="edit" class="button"style="border-radius:0.5rem;padding:4px; color:white;  background-color:orange;"> 
                    </div>
                   
                    </form>
                </div>
            </div>
            
        </div>

         
           
</body>
</html>