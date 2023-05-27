<?php 
 

 if(isset($_POST['upload']) && isset($_FILES['my_image']))
 {  include "connection.php";
    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    $img_name=$_FILES['my_image']['name'];
    $img_size=$_FILES['my_image']['size'];
    $tmp_name=$_FILES['my_image']['tmp_name'];
    $error=$_FILES['my_image']['error'];

    if($error===0)
    {
       if($img_size >125000)
       {
        $em="Sorry , your file us too large.";
        header("location:shopkepper.html.php?error=$em");
       }
       else
       {
         // echo "Not more than 1mb";
         $img_ex=pathinfo($img_name, PATHINFO_EXTENSION);
         echo($img_ex);
         $img_ex_lc=strtolower($img_ex);

         $allowed_exs=array("jpg", "jpeg", "png");

         if(in_array($img_ex_lc, $allowed_exs))
         {
              $new_img_name=uniqid("IMG-", true).'.'.$img_ex_lc;
              echo $new_img_name;
              $img_upload_path='uploads/'.$new_img_name;
              move_uploaded_file($tmp_name,$img_upload_path);
         }
         else
         {
            $em="unknown error occured!";
            header("Location:shopkepper.html?error=$em");
         }
       }
    }
    else 
    {
        $em="unknown error occurred!";
        header("location:shopkepper.html?error=$em");
    }
 }
 else
 {
    header("Location:shopkepper.html");
 }
?>