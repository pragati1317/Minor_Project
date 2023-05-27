<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style.css">
    <link rel="stylesheet" href="styles\style1.css">
    <link rel="stylesheet" href="styles\style6.css">
   <script src="app_js\index.js"></script>
    <title>Hamari Mandi</title>

</head>
<body>
    <?php
     session_start();
     $userId=$_SESSION['userId'];
     require('./ecom/connection.php');
     require('./ecom/functions.php');
     
        $qr=mysqli_query($con,"select profession from users where userId='$userId';");
        $res=mysqli_fetch_assoc($qr);
        $profession=$res['profession'];
    ?>
    

    <div class="page1">
        <div class="navbar">
           
              <div class="leftnav">
             
                <ul>
                  <li><a href="./index.php">Go Back</a></li> 

                  <?php 
                  if($profession==3){
                    ?>
                <li class="dropdown pr-5" >
                       <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:transparent">
                            Rates
                        </a>

                       <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                 <a class="dropdown-item" href="#Create">Create</a>
                                    <a class="dropdown-item" href="#">Update</a>
                        <a class="dropdown-item" href="#">Remove</a>
                         </div>
                    </li>
                    <?php 
                  }
                    ?>
                  <li><a href="#rates">show</a></li>
                  </ul>

               </div>
             
           
            <div class="rightnav">
                <ul>
                      <li><a href="profile.php"><img src="./images/profile.png" alt="profile" srcset="" class="profile"></a></li>
                      <li> <form action="\ecom\functions.php" method="post">
                    
                        <button type="submit"  class="btn" name="logout" value="logout">logout</button>
                       </form></li>
                </ul> 
            </div>
        </div>


           <div style="float:center; margin:4rem;">
           <table class="table" id="rates">
            <thead>
             <tr>
            <th> cropId  &nbsp </th>
            <th> cropType   &nbsp </th>
            <th> rate      &nbsp   </th>
            <th> ReleaseDate  &nbsp  </th>
            
             </tr>
            </thead>
            <tbody>
            <?php

            //    require('ecommerce.php');  
            $query="select * from ratelist ;";
           if($profession==3)
            {
               $query = "select * from ratelist where userId='$userId' ;";
            }
               
                $queryfire=mysqli_query($con, $query);
            
                $num=mysqli_num_rows($queryfire);

                if(isset($_GET["action"]))
                {
                  if($_GET["action"]=="remove")
                  {
                    $cropId=$_GET["id"];
                    $q="delete from rateList where cropId='$cropId';";
                    mysqli_query($con, $q);
      
                  }
                }
              if($num>0)
              { 
                while($ratelist=mysqli_fetch_array($queryfire))
                {
                    ?>
          
         <tr>
            <td><?php echo $ratelist['cropId'] ;?> &nbsp </td>
            <td><?php echo $ratelist['cropType'];?> &nbsp </td>
            <td><?php echo $ratelist['rate'];?> &nbsp </td>
            <td><?php echo $ratelist['ReleaseDate'];?> &nbsp </td>
            <?php
            if($profession==3)
            {
              ?>
          <td><button type="submit" name="remove" class="btn  bg-info" ><a href="HamariMandi.php?action=remove&id=<?php echo $ratelist['cropId'];?>">remove</a></button></td>
          <?php
            }
          ?>
            </tr>
        
<?php 
                } 
                   
                  }  ?> 

                         </tbody>
                   </table>
                </div> 
     </div>
    </div>
                </div>
                </div> 
          <?php 
          if($profession==3)
          { 
          
            ?>


                <div class="register-photo">
        <div class="form-container" id="Create">
            <div class="image-holder"></div>
            <form action="Ratelist.php" method="post">
                <h2 class="text-center"><strong>Add Croop Ratelist</strong></h2>
                <div class="form-group ">
                    <label>cropType</label>
                    <input type="text" name="cropType" required>
                 </div>
                    <div class="form-group ">
                    <label>rate</label>
                    <input type="text" name="rate" required>
                  </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="Add">Add</button>
              </div</form>
        </div>
    </div>
      <?php

          }
      ?>   

</body>
 <script>
  let r=document.getElementById('rates');
        function rate()
        {
           r.style.display="block";
           return;
        }
                  </script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>