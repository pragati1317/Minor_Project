<?php

require('connection.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$v_code)
{
    require("PHPMailer/PHPMailer.php");  
    require("PHPMailer/SMTP.php");
    require("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);
    try {
        
      
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'pradhumnagothi678@gmail.com';                     //SMTP username
        $mail->Password   = 'toeavwjnodyouqej';                               //SMTP password
        $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       =587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('pradhumnagothi678@gmail.com', 'Farming Website');
        $mail->addAddress($email);    
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification from User Login Register';
        $mail->Body    = " Thanks fir Registration! Click the link below verify the email address <a href='http://localhost/pradumnagothi/verify.php?email=$email&v_code=$v_code'> Verify</a> ";
       
    
        $mail->send();
       return true;
    } catch (Exception $e) {
        return false;
    }
}

#for login
if(isset($_POST['login']))
{
    $query="SELECT * FROM users WHERE  gamil='$_POST[email_username]'  OR   name ='$_POST[username_email]' ";
    $result=mysqli_query($con,$query);

    if($result)
    {
       if(mysqli_num_rows($result)==1)
       {
        $result_fetch=mysqli_fetch_assoc($result);
        if($result_fetch['is_verified']==1)
        {
            if(password_verify($_POST['password'],$result_fetch['password']))
            {
                #if password matched
                $_SESSION['logged_in']=true;
                $_SESSION['username']=$result_fetch['username'];
                if(isset($_POST['remember_me'])){
                    setcookie('email_username',$_POST['email_username'],time()+(60*60*24));
                    setcookie('password',$_POST['password'],time()+(60*60*24));
                    
                }
                else
                {
                    setcookie('email_username','',time()-(60*60*24));
                    setcookie('password','',time()-(60*60*24));

                }
                header("location:../index.html");
    
    
            }
            else
            {
               #if incorrect password
               echo"
               <script>
                alert('Incorrect Password');
                window.location.href='index.php';
               </script>
               ";
            }
        }
        else
        {
            echo"
            <script>
             alert('email not verified');
             window.location.href='index.php';
            </script>
            "; 
        }
       
       }
       else
       {
        echo"
        <script>
         alert('email or Phone number Not Registered');
         window.location.href='index.php';
        </script>
        ";
       }
    }
    else
    {
        echo"
   <script>
    alert('Cannot Run Query');
    window.location.href='index.php';
   </script>
   "; 
    }
}

#for register
if(isset($_POST['register']))
{
 $user_exist_query="SELECT * FROM `registered_user`   WHERE `username`= '$_POST[username]' OR `email`='$_POST[email]'" ;
 $result=mysqli_query($con,$user_exist_query);

 if($result)
 {
if(mysqli_num_rows($result)>0)  #it will be executed if username or email is alraedy registered(taken)
{
   $result_fetch=mysqli_fetch_assoc($result);
   if($result_fetch['username']==$_POST['username'])
   { 
    #error for username already registerd
    echo"
    <script>
     alert('$result_fetch[username] - username already taken');
     window.location.href='index.php';
    </script>
    ";
   }
   else
   {
    #Error for email already registered
    echo"
    <script>
       alert('$result_fetch[email] - email already registered');
       window.location.href='index.php';
    </script>
    ";
   }
}
else  #it will be executed if no one has taken username or email  before
{
    $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
    $v_code= bin2hex(random_bytes(16)) ;
$query="INSERT INTO `registered_user`(`full_name`, `username`, `email`, `password`, `profession`, `verification_code`, `is_verified`) VALUES ('$_POST[full_name]','$_POST[username]','$_POST[email]','$password','$_POST[profession]','$v_code', '0')";
if(mysqli_query($con,$query) && sendMail($_POST['email'],$v_code))
{
   # if data inserted successfully
   echo"
   <script>
    alert('Registration Successful');
    window.location.href='index.php';
   </script>
   ";
}
else
{
    # if data cannot be inserted
    echo"
    <script>
     alert('Server Down');
     window.location.href='index.php';
    </script>
    ";   
}
}
 }
 else
 {
   echo"
   <script>
    alert('Cannot Run Query');
    window.location.href='index.php';
   </script>
   ";
 }
}

?>