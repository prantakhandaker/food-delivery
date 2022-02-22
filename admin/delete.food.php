<?php

    //include constance folder
    include('../config/constans.php');

    //check whether the data is set or not
    if (isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the data
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
       

        if ($image_name!= "") 
        {
            
            //image is available so remove it
            $path= '../images/food/'.$image_name;
            
            $remove= unlink($path);
    

            if ($remove==false) 
            {
                //failed messege
                $_SESSION['remove']="Failed to remove";
                //redirect to manage catagory
                header('location:'.SITEURL.'/admin/manage.food.php');
                //stop the remove proces
                die();
            }

        }

        //delete data from database
        $sql="DELETE FROM fd_food WHERE id=$id";

        //execute the quesy
        $res= mysqli_query($conn, $sql);

        //check whether the data is deleted or not
        if($res) 
        {
            $_SESSION['delete']= "Food   delete Successfully";
            //redirect to Manage catagory
            header('location:'.SITEURL.'/admin/manage.food.php');
        }
        else 
        {
            $_SESSION['delete']= "Food delete Failed";
            //redirect to Manage catagory
            header('location:'.SITEURL.'/admin/manage.food.php');
        }

        
    }

    

    else
    {
        $_SESSION['unoth']= "Unothorized Access";
        //redirect to catagory page
        header('loaction:'.SITEURL.'/admin/manage.food.php');
    }

?>