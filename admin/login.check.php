<?php 

    if (!isset($_SESSION['user'])) 
    {
        //user not log in
        //redirect
        $_SESSION['not-login']= "<div class= 'text-center'>Please log in first";
        header('location:'.SITEURL.'/admin/login.php');
    }


?>