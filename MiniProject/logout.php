<?php
function logout()
{
    session_start();
    session_destroy();
   
    header('location:index.php');
}
if(isset($_POST['logout']))
{
   logout();
}

?>