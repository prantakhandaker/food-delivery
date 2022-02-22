<?php include("partials/menu.php"); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Add Catagory</h1>
        
        <br><br>

        <?php 
        
        if(isset($_SESSION['add'])){

            echo($_SESSION['add']);
            unset($_SESSION['add']);
        }

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
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Catagory" class="btn-secoundary">
                    </td>
                </tr>
            </table>

        </form>
        
        <!-- main content end-->

        <?php 
        
             // Check Whether the submit button is clicked or not.

            if(isset($_POST["submit"]))
            {
                
                //get the value from form
                $title = $_POST["title"];

                //check radio button active or not
                if(isset($_POST["feature"]))
                {
                    
                    //get the value from
                    $feature = $_POST["feature"];
                    
                }
                else
                {
                    $feature = "no";
                }

                if(isset($_POST["active"]))
                {
                    
                    //get the value from
                    $active = $_POST["active"];
                    
                }
                else
                {
                    $active = "no";
                }

                //check ing selected or not
                if (isset($_FILES["image"]["name"]))
                {
                    $image_name =$_FILES["image"]["name"];

                    if ($image_name !="") 
                    {
                        # code...
                    

                        //auto rename our image
                        //get the extenction oof inage
                        $ext= end(explode('.',$image_name));

                        //rename image
                        $image_name= "food_catagory_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES["image"]["tmp_name"];

                        $destination_path ="../images/catagory/".$image_name;

                        //finally upload image
                        $upload= move_uploaded_file($source_path ,$destination_path);

                        if ($upload==false)
                        {
                            $_SESSION["upload"] = "Failed to upload image";
                            // redierct
                            header('location:'.SITEURL.'/admin/add.catagory.php');
                            //stop the process.
                            die();
                        }
                    }
                }
                else 
                {

                    $image_name ="";
                }

                //sql query o insert data into database
                $sql= "INSERT INTO fd_catagory SET
                    title='$title',
                    image_name='$image_name',
                    feature='$feature',
                    active='$active'
                ";

                //Executr query and save data into database
                $res = mysqli_query($conn , $sql);

                //check query exequeted or not
                if($res)
                {
                    // query executed and catagory added
                    $_SESSION ['add'] = 'Catagory Added Successfully';
                    // redirect page TO MANAGE Catagory
                    header('location:'.SITEURL.'/admin/manage.catagory.php');
                }
                else{
       
                    // failed to add catagory
                    $_SESSION ['add'] = 'Failed to Add Catagoty';
                    // redirect page TO MANAGE Catagory
                    header('location:'.SITEURL.'/admin/add.catagory.php');
                }
       

            }
        
        ?>

    </div>

</div>

<?php include("partials/footer.php"); ?>