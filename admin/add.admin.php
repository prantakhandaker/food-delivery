<?php include("partials/menu.php"); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>


        <?php
                
                if(isset($_SESSION['add'])){

                    echo($_SESSION['add']);
                    unset($_SESSION['add']);
                }
            
            ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Nmae</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secoundary">
                    </td>
                </tr>
            </table>

        </form>

   
    </div>

</div>

<?php include("partials/footer.php")?>



<?php 

    // process the value from and save into the database.

    // Check Whether the submit button is clicked or not.

    if(isset($_POST["submit"])){

            //get the data from form
        $full_name = $_POST["full_name"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
         

        //SQL query to save the data into database

        $sql = "INSERT INTO fd_admin SET
        
            full_name = '$full_name',
            username = '$username',
            password = '$password'
         ";
         

         //Executr query and save data into database
         $res = mysqli_query($conn , $sql) or die(mysqli_error ($conn));
            
           
         //Check Whether the data is inserted or not and display appropiate messege

         if($res==true)
         {
             //echo "Data inserted";
             // SESSON variable to display messege
             $_SESSION ['add'] = 'Admin Added Successfully';
             // redirect page TO MANAGE Admin
             header('location:'.SITEURL.'/admin/manage.admin.php');
         }
         else{

             //echo "Data not inserted";
             // SESSON variable to display messege
             $_SESSION ['add'] = 'Failed to Add Admin';
             // redirect page TO MANAGE Admin
             header('location:'.SITEURL.'/admin/add.admin.php');
         }



    }

?>