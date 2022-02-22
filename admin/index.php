<?php include("partials/menu.php"); ?>


        <!--Main content start-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br>

                <?php 
                
                if(isset($_SESSION['login'])){

                    echo($_SESSION['login']);
                    unset($_SESSION['login']);
                }
                
                ?>
                <br><br>
                <div class="col-4 text-center">

                    <?php 
                    
                        //get all data from data base
                        $sql= "SELECT * FROM fd_catagory";

                        //execute the quara
                        $res= mysqli_query($conn, $sql);

                        //count all rows
                        $count= mysqli_num_rows($res);
                    
                    ?>
                    <h1><?php echo $count; ?></h1>
                     </br>
                    catagories
                </div>

                <div class="col-4 text-center">

                    <?php 
                        
                        //get all data from data base
                        $sql2= "SELECT * FROM fd_food";

                        //execute the quara
                        $res2= mysqli_query($conn, $sql2);

                        //count all rows
                        $count2= mysqli_num_rows($res2);
                    
                    ?>
                <h1><?php echo $count2; ?></h1>
                </br>
                    Food
                </div>

                <div class="col-4 text-center">

                    <?php 
                        
                        //get all data from data base
                        $sql3= "SELECT * FROM fd_order";

                        //execute the quara
                        $res3= mysqli_query($conn, $sql3);

                        //count all rows
                        $count3= mysqli_num_rows($res3);
                    
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    </br>
                    Total Order
                </div>

                <div class="col-4 text-center">

                    <?php 
                    
                        //create sql query to get revenue
                        $sql4= "SELECT SUM(total) AS Total FROM fd_order";

                        //execute the query
                        $res4= mysqli_query($conn, $sql4);

                        //get the value
                        $row4= mysqli_fetch_assoc($res4);

                        //get the total revenue
                        $total_revenue= $row4['Total'];


                    ?>

                    <h1><?php echo $total_revenue; ?></h1>
                     </br>
                    Total Revenue
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!--Main content end-->

  <?php include("partials/footer.php")?>      