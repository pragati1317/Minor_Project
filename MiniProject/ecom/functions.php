<?php
function profileValue($con, $user)
{
    
    $q="select * from users where userId='$user' ;";
     $row=mysqli_query($con,$q); 
     $res=mysqli_fetch_assoc($row); 
     return $res;
}

// function FetchFeatures($con, $q)
// {
//     $row=mysqli_query($con,$q); 
//     $res=mysqli_fetch_assoc($row); 
//     return $res;
// }
function professionValue($value)
{
   switch ($value) { 
    case 1: 
        echo" farmer"; 
        break; 
    case 2: 
        echo "shopkepper";
         break;
    case 3 : 
        echo "vendor";
         break; 
    default:     
         echo"nothing";
         } 

}
function logout()
{
    session_start();
    session_destroy();
    
    header('location:../index.php');
}
if(isset($_POST['logout']))
{
   logout();
}

function createAt()
{
    date_default_timezone_set('Asia/kolkata');
    $createdate =date('y-m-d h:i:s');
    return $createdate;
}
?>