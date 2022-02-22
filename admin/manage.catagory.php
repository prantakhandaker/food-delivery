<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Catagory</h1>

        <!-- Primary Button-->
        <br /><br />

        <?php 
        
        if(isset($_SESSION['add'])){

            echo($_SESSION['add']);
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove'])){

            echo($_SESSION['remove']);
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete'])){

            echo($_SESSION['delete']);
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no-catagory'])){

            echo($_SESSION['no-catagory']);
            unset($_SESSION['no-catagory']);
        }

        if(isset($_SESSION['update'])){

            echo($_SESSION['update']);
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['upload'])){

            echo($_SESSION['upload']);
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['failed_remove'])){

            echo($_SESSION['failed_remove']);
            unset($_SESSION['failed_remove']);
        }
        
        ?>

        <br><br>

        <a href="<?php echo SITEURL; ?>/admin/add.catagory.php" class="btn-primary">Add Catagory</a>


        <br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                    
                        //sql query for get all data from database
                        $sql= "SELECT * FROM fd_catagory";

                        //execute query
                        $res= mysqli_query($conn, $sql);

                        //count rows
                        $count= mysqli_num_rows($res);

                        //create sirial number
                        $sn=1;

                        //check whethrt we have database or not
                        if ($count>0)
                        {
                            //we have data in database
                            //get the data
                            while ($row=mysqli_fetch_assoc($res)) 
                            {
                                $id= $row['id'];
                                $title= $row['title'];
                                $image_name= $row['image_name'];
                                $feature= $row['feature'];
                                $active= $row['active'];


                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>

                                        <td>
                                            <?php
                                        
                                                //check image exist or not
                                                if ($image_name!="") 
                                                {
                                                //display image
                                                ?>
                                                    <img src="<?php echo SITEURL;?>/images/catagory/<?php echo $image_name?>" width="100" >

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
                                            <a href="<?php echo SITEURL;?>/admin/update.catagory.php?id=<?php echo $id; ?>" class="btn-secoundary">Update Catagory</a>
                                            <a href="<?php echo SITEURL;?>/admin/delete.catagory.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Catagory</a>
                                        </td>
                                    </tr>
                                
                                <?php
                            
                            }
                        }
                        else 
                        {
                            //ew will display this messege inside table
                            ?>

                                <tr>
                                    <td colspan='6'>No Catagory Added</td>
                                </tr>

                            <?php
                        }
                    
                    ?>

                </table>
    </div>
</div>

<?php include("partials/footer.php") ?>