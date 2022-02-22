<?php include("partials/menu.php") ?>


        <!--Main content start-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <!-- Primary Button-->
                <br /><br />

                <a href="add.admin.php" class="btn-primary">Add Admin</a>

                <br /><br />

                <?php
                
                    if(isset($_SESSION['add'])){

                        echo($_SESSION['add']);
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){

                        echo($_SESSION['delete']);
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update'])){

                        echo($_SESSION['update']);
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found'])){

                        echo($_SESSION['user-not-found']);
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['password-not-match'])){

                        echo($_SESSION['password-not-match']);
                        unset($_SESSION['password-not-match']);
                    }

                    if(isset($_SESSION['change-password'])){

                        echo($_SESSION['change-password']);
                        unset($_SESSION['change-password']);
                    }
                
                ?>
                </br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>User Nmae</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // Get all Admin
                        $sql = "SELECT* FROM fd_admin";
                        //Execute the query
                        $res = mysqli_query($conn , $sql);

                        //Check query Executed Or Not
                        if($res){

                            $sn=1;

                            //Count Rows
                            $count = mysqli_num_rows($res);

                            if($count>0){
                                
                                //we have data in database
                                while($rows = mysqli_fetch_assoc($res)){
                                    // var_dump($rows);
                                    //gte data
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    //Display Value in Table
                                    ?>

                                         <tr>
                                                <td><?php echo $sn++; ?></td>
                                                <td><?php echo $full_name; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td>
                                                    <a href="<?php echo SITEURL ;?>/admin/update.password.php?id=<?php echo $id;?>"class="btn-primary">Change password</a>
                                                    <a href="<?php echo SITEURL ;?>/admin/Update.admin.php?id=<?php echo $id;?>"class="btn-secoundary">Update</a>
                                                    <a href="<?php echo SITEURL ;?>/admin/delete.admin.php?id=<?php echo $id;?>" class="btn-danger">Delete</a>
                                                </td>
                                        </tr>

                                    <?php

                                }
                            }
                        }

                    ?>

                   
                </table>

                <div class="clearfix"></div>
            </div>
        </div>
        <!--Main content end-->

<?php include("partials/footer.php") ?>