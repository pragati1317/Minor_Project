<?php


session_start();
session_unset();
session_destroy();
header("location: index.php");

setcookie('email_username','',time()-(60*60*24));
setcookie('password','',time()-(60*60*24));
?>