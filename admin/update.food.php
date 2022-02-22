<?php include("partials/menu.php");?>

<?php 

    if (isset($_GET['id'])) 
    {   
        //get all details
        $id= $_GET['id'];

        //sql query
        $sql2= "SELECT * FROM fd_food WHERE id=$id";

        //execute the query
        $res2= mysqli_query($conn, $sql2);

        //get the value based on execution
        $row2= mysqli_fetch_assoc($res2);

        //get individual value of selected food
        $title= $row2['title'];
        $description = $row2['description'];
        $price= $row2['price'];
        $current_image= $row2['image_name'];
        $current_catagory= $row2['catagory_id'];
        $feature= $row2['feature'];
        $active= $row2['active'];

    }
    else 
    {
        header('location:'.SITEURL.'/admin/manage.food.php');
    }

?>


<div class="main-content">

    <div class="wrapper">

        <h1>Update Food</h1>

        <br><br>

        <br><br>


        <!-- main content start-->
        
        <form action="" method="POST" enctype ="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5"><?php echo $description ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        
                        <?php 
                        
                            if ($current_image=="") 
                            {
                                echo "Image Not Available";
                            }
                            else 
                            {
                                ?>
                                
                                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $current_image; ?>" width= "100px">

                                <?php
                            }
                        
                        ?>

                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>

                    <td>
                        <select name="catagory">

                            <?php 
                            
                                //create sql queries to get all active catagory
                                $sql= "SELECT * FROM fd_catagory WHERE active='yes'";

                                //execute the query
                                $res= mysqli_query($conn, $sql);

                                //count rows to check catagory is available or not
                                $count = mysqli_num_rows($res);

                                //if count>0 we have catagory else don't have any catagory
                                if ($count>0) 
                                {
                                    while ($row= mysqli_fetch_assoc($res)) 
                                    {
                                        //get the details of catagory
                                        
                                        $catagory_title= $row['title'];
                                        $catagory_id= $row['id'];

                                        ?>
                                            <option <?php if($current_catagory==$catagory_id){echo "selected";}?> value="<?php echo $catagory_id; ?>"><?php echo $catagory_title; ?></option>
                                            
                                        <?php
                                       
                                    }
                                }
                                else 
                                {
                                    
                                    ?>
                                        <option value="0">No Category Found</option>
                                    <?php

                                }
                            
                            ?>
                        
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($feature=='yes') echo "checked"?> type="radio" name ="feature" value="yes"> Yes
                        <input <?php if($feature=='no') echo "checked"?> type="radio" name ="feature" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=='yes') echo "checked"?> type="radio" name ="active" value="yes"> Yes
                        <input <?php if($active=='no') echo "checked"?> type="radio" name ="active" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden"name="current_image"value="<?php echo $current_image;?>">
                        <input type="hidden"name="id"value="<?php echo $id;?>">
                        <input type="submit"name="submit"value="Update Food"class="btn-secoundary">
                    </td>
                </tr>

            </table>

        </form>
    
        <!-- main content end-->

        <?php 
            //check wether the button is clicked or not
            if (isset($_POST['submit'])) 
            {
                //get all data form from
                $title= $_POST['title'];
                $description = $_POST['description'];
                $price= $_POST['price'];
                $current_image= $_POST['current_image'];
                $catagory= $_POST['catagory'];
                $feature= $_POST['feature'];
                $active= $_POST['active'];

                //CHECK THE UPLOAD BUTTON IS CLICKED OR NOT
                if (isset($_FILES['image']['name'])) 
                {
                    $image_name= $_FILES['image']['name'];
                    //check wether the image is available or not
                    if ($image_name!="") 
                    {
                        //rename the image
                        $ext= end(explode('.', $image_name));

                        $image_name= "food_name".rand(0000,9999).'.'.$ext;

                        //get hte source path & destination path
                        $src_path= $_FILES['image']['tmp_name'];

                        $dest_path= "../images/food/".$image_name;

                        //upload the image
                        $upload= move_uploaded_file($src_path, $dest_path);

                        //check image is uploaded or not
                        if ($upload==false) 
                        {
                            //failed to upload
                            $_SESSION['food_upload']= "Upload failed ";
                            //redirect to manage food
                            header('location:'.SITEURL.'/admin/manage.food.php');
                            //stop
                            die();
                        }
                        if ($current_image != "") 
                        {
                            //remove the current image
                            $remove_path= "../images/food/".$current_image;

                            $remove= unlink($remove_path);

                            //check current image is remove or not
                            if ($remove==false) 
                            {
                                $_SESSION['remove_failed']="Image Remove Failed";
                                //redirect
                                header('location:'.SITEURL.'/admin/update.food.php');
                                //stop 
                                die();
                            }
                        }

                    }
                    else 
                    {
                        $image_name= $current_image;
                    }
                }
                else 
                {
                    $image_name= $current_image;
                }

                //update all data
                $sql3= "UPDATE fd_food SET

                title= '$title',
                description = '$description',
                price= $price,
                image_name= '$image_name',
                catagory_id= '$catagory',
                feature= '$feature',
                active= '$active'
                WHERE id= $id
                ";
            

                //execute the query
                $res3= mysqli_query($conn, $sql3);

                //check query execute or not
                if($res3) 
                {
                    $_SESSION['upload_1']="Food Updated Successfully";
                    //redirect
                    header('location:'.SITEURL.'/admin/manage.food.php');
                }
                else 
                {
                    $_SESSION['upload_1']="Food Updated Failed";
                    //redirect
                    header('location:'.SITEURL.'/admin/manage.food.php');
                    echo "<script>window.location.href='/admin/manage.food.php';</script>";
                }

            }
        ?>
    </div>


</div>


<?php include("partials/footer.php"); ?>
