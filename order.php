<?php include('partials_front/menu.php');?>

    <?php 
    
        //check wather the food id is set or not
        if (isset($_GET ['food_id'])) 
        {
            //get the food id and details of selected food
            $food_id= $_GET['food_id'];

            //get the details of selectd food
            $sql= "SELECT * FROM fd_food WHERE id=$food_id";

            //execute the query
            $res= mysqli_query($conn, $sql);

            //count the rows
            $count= mysqli_num_rows($res);

            if ($count==1) 
            {
                //get all details
                $row= mysqli_fetch_assoc($res);
                $title= $row['title'];
                $price= $row['price'];
                $image_name= $row['image_name'];

            }
            else 
            {
                //RESIRECT TO home baby.
                header('location:'.SITEURL);
            }
        }
        else 
        {
            //RESIRECT TO home baby.
            header('location:'.SITEURL);
        }

    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <?php ?>

            <form action="" method= "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php 
                        
                            //check image is available or not
                            if ($image_name=="") 
                            {
                                //image not available
                                echo "Image Not Available.";
                            }
                            else 
                            {
                                ?>

                                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php
                            }
                        
                        ?>

                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Full Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php
            
                //check wather the button is clicked or no
                if (isset($_POST['submit'])) 
                {
                    //get all details from
                    $food= $_POST['food'];
                    $price= $_POST['price'];
                    $qty= $_POST['qty'];

                    $total= $price * $qty; //total price of food...

                    $order_date= date('y-m-d h:i:sa'); //date

                    $status= "Ordered";

                    $customer_name= $_POST['full-name'];
                    $customer_contact= $_POST['contact'];
                    $customer_email= $_POST['email'];
                    $customer_address= $_POST['address'];
                    

                    //save the order in database
                    //create sql to save database
                    $sql= "INSERT INTO fd_order SET
                        food= '$food',
                        price= '$price',
                        qty= '$qty',
                        total= '$total',
                        order_date= '$order_date',
                        status= '$status',
                        customer_name= '$customer_name',
                        customer_contact= '$customer_contact',
                        customer_email= '$customer_email',
                        customer_address= '$customer_address'
                    ";

                    //execute the query
                    $sql= mysqli_query($conn, $sql);

                    //check quey executed or not..
                    if ($res) 
                    {
                        
                        $_SESSION['order']= "Food Order Successfilly";
                        header('location:'.SITEURL);

                    }
                    else 
                    {

                        $_SESSION['order']= "Food Order Failed";
                        header('location:'.SITEURL);
                        
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials_front/footer.php');?>