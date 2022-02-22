<?php include('partials_front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>/food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
    
        if (isset($_SESSION['order'])) 
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //create sql query to display data base
                $sql= "SELECT * FROM fd_catagory WHERE active='yes' AND feature='yes' LIMIT 6";

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
                                        <img src="<?php echo SITEURL; ?>/images/catagory/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
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


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            //sql query to get the data
            $sql= "SELECT * FROM fd_food LIMIT 4";

            //execute the query
            $res= mysqli_query($conn, $sql);

            //count the rown to check whether the data is available or not
            $count= mysqli_num_rows($res);

            if ($count>0) 
            {
                while ($row= mysqli_fetch_assoc($res)) 
                {
                    //get all valuse
                    $id= $row['id'];
                    $title= $row['title'];
                    $price= $row['price'];
                    $description= $row['description'];
                    $image_name= $row['image_name'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">

                                <?php
                                    if ($image_name=="") 
                                    {
                                        echo "Image Not Available";
                                    }
                                    else 
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                 <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>/order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else 
            {
                echo "Food Is Not Available";
            }

            ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials_front/footer.php');?>    

