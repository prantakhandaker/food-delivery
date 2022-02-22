<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <!-- Primary Button-->
        <br /><br />

        <a href="<?php echo SITEURL; ?>/admin/add.food.php" class="btn-primary">Add Food</a>


        <br /><br />


        <?php 
        
        if(isset($_SESSION['add']))
        {

            echo($_SESSION['add']);
            unset($_SESSION['add']);
        } 

        if(isset($_SESSION['delete']))
        {

            echo($_SESSION['delete']);
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['remove']))
        {

            echo($_SESSION['remove']);
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['unoth']))
        {

            echo($_SESSION['unoth']);
            unset($_SESSION['unoth']);
        }

        
        if(isset($_SESSION['food_upload']))
        {

            echo($_SESSION['food_upload']);
            unset($_SESSION['food_upload']);
        }

        if(isset($_SESSION['upload_1']))
        {

            echo($_SESSION['upload_1']);
            unset($_SESSION['upload_1']);
        }

        ?>

        <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Feature</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                    
                        // CREATE sql query to get all food
                        $sql= "SELECT * FROM fd_food";

                        //execute the query
                        $res= mysqli_query($conn, $sql);

                        //count row to check we have food or not
                        $count= mysqli_num_rows($res);

                        //create serial number
                        $sn= 1;

                        if ($count>0) 
                        {
                            //get data from database
                            while ($row= mysqli_fetch_assoc($res)) 
                            {
                               
                                //get data from individual colums
                                $id= $row['id'];
                                $title= $row['title'];
                                $price= $row['price'];
                                $image_name= $row['image_name'];
                                $feature= $row['feature'];
                                $active= $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td>
                                            <?php 
                                                //echo $image_name;
                                                //check image exist or not
                                                if ($image_name!="") 
                                                {
                                                //display image
                                                ?>
                                                    <img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name?>" width="100" >

                                                <?php 
                                                }
                                                else 
                                                {
                                                    echo "Image not Added";
                                                }

                                            ?>
                                        </td>
                                        <td><?php echo $feature; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>/admin/update.food.php?id=<?php echo $id; ?>" class="btn-secoundary">Update</a>
                                            <a href="<?php echo SITEURL; ?>/admin/delete.food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }

                    ?>


                </table>
    </div>
</div>

<?php include("partials/footer.php") ?>