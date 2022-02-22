<?php include('partials_front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //create sql query to display data base
                $sql= "SELECT * FROM fd_catagory WHERE active='yes'";

                //execute the query
                $res= mysqli_query($conn, $sql);

                //counr the row to check wather data data is available or not
                $count= mysqli_num_rows($res);

                if ($count>0) 
                {
                    //when catagory available
                    while ($row= mysqli_fetch_assoc($res)) 
                    {
                        //get data
                        $id= $row['id'];
                        $title= $row['title'];
                        $image_name= $row['image_name'];

                        ?>

                        <a href="<?php echo SITEURL; ?>/category-foods.php?catagory_id=<?php echo $id ?>">
                            <div class="box-3 float-container">

                                <?php
                                    if ($image_name=="") 
                                    {
                                        echo "Image Not Available";
                                    }
                                    else 
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>/images/catagory/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else 
                {
                    echo "Category Not Available";
                }

            ?>


            <!-- <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a> -->


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include('partials_front/footer.php');?>    