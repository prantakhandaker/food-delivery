<?php
    include("../config/constans.php");

    //destroy session
    session_destroy();

    //redirect to login page
    header('location:'.SITEURL.'/admin/login.php');

?>