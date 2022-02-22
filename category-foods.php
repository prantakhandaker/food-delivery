<?php include('partials_front/menu.php');?>

<?php 

    //check wather id is passed or not
    if(isset($_GET['catagory_id'])) 
    {
        $catagory_id= $_GET['catagory_id'];
        //GET THE THTLE FROM DATABASE
        $sql= "SELECT title FROM fd_catagory WHERE id=$catagory_id";

        //execute the query
        $res= mysqli_query($conn, $sql);

        //counr the row to check wather data data is available or not
        $row= mysqli_fetch_assoc($res);
        
        //get the title
        $catagory_title= $row['title'];

    }
    else 
    {
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $catagory_title; ?>"</a></h2>

            
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- food menu starts here -->

    <section class="food-menu">
        <div class="container">


            <?php
                    
                    //sql query for selecting food based on catagory
                    $sql2= "SELECT * FROM fd_food WHERE catagory_id=$catagory_id";

                    //execute the query
                $res2= mysqli_query($conn, $sql2);

                //count the rown to check whether the data is available or not
                $count2= mysqli_num_rows($res2);

                if ($count2>0) 
                {
                    while ($row2= mysqli_fetch_assoc($res2)) 
                    {
                        //get all valuse
                        $id= $row2['id'];
                        $title= $row2['title'];
                        $price= $row2['price'];
                        $description= $row2['description'];
                        $image_name= $row2['image_name'];

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
    </section>
    

<?php include('partials_front/footer.php');?>