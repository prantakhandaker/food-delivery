
<?php include("partials/menu.php");?>

<div class="main-content">

    <div class="wrapper">

        <h1>Add Food</h1>

        <br><br>

        <?php 


        
            if(isset($_SESSION['upload'])){

                echo($_SESSION['upload']);
                unset($_SESSION['upload']);
            } 

      

        ?>

        <br><br>


        <!-- main content start-->
        
        <form action="" method="POST" enctype ="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Catagory Title">
                    </td>
                </tr>

                <tr>
                    <td>Discription:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Caragory:</td>

                    <td>
                        <select name="catagory">

                            <?php 
                            
                                //create sql queries to get all actibe catagory
                                $sql= "SELECT * FROM fd_catagory WHERE active='yes'";

                                //execute the query
                                $res= mysqli_query($conn, $sql);

                                //count rows to check catagory is available or not
                                $count = mysqli_num_rows($res);

                                //if count>0 we have catagory else dont have any catagory
                                if ($count>0) 
                                {
                                    while ($row= mysqli_fetch_assoc($res)) 
                                    {
                                        //get the details of catagory
                                        $id= $row['id'];
                                        $title= $row['title'];

                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else 
                                {
                                    
                                    ?>
                                        <option value="0">No Catagory Found</option>
                                    <?php

                                }
                            
                            ?>
                        
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name ="feature" value="yes"> Yes
                        <input type="radio" name ="feature" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name ="active" value="yes"> Yes
                        <input type="radio" name ="active" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-secoundary">
                    </td>
                </tr>
            </table>

        </form>

        <!-- main content end-->
                        
        <?php


            //check wather the button is clicked or not
            if (isset($_POST['submit'])) 
            {

               
                //GET THE DATA form from
                
                $title= $_POST['title'];
                $description= $_POST['description'];
                $price= $_POST['price'];
                $catagory= $_POST['catagory'];
                
                //  echo '<pre>';
                // print_r($_POST);
                // exit();

                //check wather the featuer and active button clicked or not
                if (isset($_POST['feature'])) 
                {
                    $feature= $_POST['feature'];

                }
                else 
                {
                    $feature= "no";
                }

                if (isset($_POST['active'])) 
                {
                    $active= $_POST['active'];
                }
                else 
                {
                    $active= "no";
                }

                // echo '<pre>';
                // print_r($_FILES['Image']['name']);
                // exit();

                //check select image button clicked or not
                if (isset($_FILES['image']['name'])) 
                {
                    
               
                    //get the datails of selected image
                    $image_name= $_FILES['image']['name'];

                    //check imahe is selected or not if selsct then upload.
                    if ($image_name !="") 
                    {
                       
                        //get the wxtenction of selected image(png,jpg,jpeg)
                        $ext= end(explode('.', $image_name));

                        //create new image name
                        $image_name= 'food_name'.rand(0000,9999).'.'.$ext;

                        //upload the image
                        // get the source path or destination path

                        //source path is the current path of image.
                        $src= $_FILES['image']['tmp_name'];

                        //destination path
                        $dst = "../images/food/".$image_name;

                        //finally uplod the food image
                        $upload= move_uploaded_file($src, $dst);                      
                        
                        //check image upload or not
                        if ($upload==false) 
                        {
                            $_SESSION['upload']= "Failed to upload image";
                            header('location:'.SITEURL.'/admin/add.food.php');
                            //end here
                            die();
                        }

                    }
                }
                else 
                {
                    $image_name= "";
                }


                
              

                //create sql query and insert data into data base
                $sql2= "INSERT INTO fd_food SET
                title= '$title',
                description = '$description',
                price= $price,
                image_name= '$image_name',
                catagory_id= '$catagory',
                feature= '$feature',
                active= '$active'
                ";

                //execute the query
                $res2= mysqli_query($conn, $sql2);
                // echo '<pre>';
                // print_r($sql2);
                // exit();
                

                //check data inserted or not
                if ($res2) 
                {
                    $_SESSION['add']= "Food Added Successfully";
                    header('location:'.SITEURL.'/admin/manage.food.php');
                }
                else 
                {
                    $_SESSION['add']= "Food Added Failed";
                    header('location:'.SITEURL.'/admin/manage.food.php');
                }


            }

        ?>


    </div>

</div>

<?php include("partials/footer.php");?>