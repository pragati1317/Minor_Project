<?php
             
              require('connection.php');
            session_start();
              if(isset($_POST['edit']))
              {
                $id=$_SESSION['userId'];
                $name=$_POST['name'];
                $phone=$_POST['phone'];
                 $profession=$_POST['profession'];
                 $email=$_POST['email'];
                 $state=$_POST['state'];
                 $city=$_POST['city'];

                 $select="select * from users where userId='$id'";
                 $sql=mysqli_query($con, $select);
                 $row=mysqli_fetch_assoc($sql);
                      
                 $res=$row['userId'];
                  if($name==NULL)
                  {  $name=$_SESSION['name'];
                  }
                 
                  if($phone==NULL)
                  {
                    $phone=$_SESSION['phone'];
                  }
                  
                  if($profession==NULL)
                  {
                    $profession=$_SESSION['profession'];
                  }
        
                  if($email==NULL)
                  {
                    $email=$_SESSION['email'];
                  }
                 
                    
                  if($res===$id)
                  {
                    $update="update users set name='$name', phone_no='$phone',  gmail='$email' , profession='$profession'  where userId='$userId' ";
                    $sql2=mysqli_query($con, $update);
                     if($sql2)
                  {
                     header('location:index.html');
                  }
                  else
                  {
                    header('location:profile.php');
                  }
                  }
                  
                
                }
                 ?>