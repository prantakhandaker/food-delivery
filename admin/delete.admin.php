<?php

    include("../config/constans.php");

    //get id which one we want to delete
    $id =$_GET['id'];
 
    //sql query to delete admin
    $sql = "DELETE FROM fd_admin WHERE id =$id";

    //execute the query
    $res = mysqli_query($conn , $sql);

    //chwck query execute successfully or not
    if($res)
    {
       
       // echo "Admin Deleted";
       //create section variable to display messeag
       $_SESSION['delete'] = "Admin Delete Successfully";
       //redirect to manage admin page
       header('location:'.SITEURL.'/admin/manage.admin.php');

    }
    else{

        //create section variable to display messeag
       $_SESSION['delete'] = "Admin Ddelete Failed";
       //redirect to manage admin page
       header('location:'.SITEURL.'/admin/manage.admin.php');

    }

    //redirect to manage admin page with massege.

?>
