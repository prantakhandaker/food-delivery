<?php include("partials/menu.php"); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>


        <?php
                
             //get id which one we want to selected admin
            $id = $_GET['id'];
           
            //sql query to deleteselect admin
            $sql = "SELECT * FROM fd_admin WHERE id = $id";
            //execute the query
            $res = mysqli_query($conn,$sql);
            
            //check the query execute or nor
            if($res){
                
                //check data is available or not
                $count = mysqli_num_rows($res);
                //check admin data available or not

                if($count==1){

                    $row=mysqli_fetch_assoc($res);

                    $full_name= $row['full_name'];
                    $username= $row['username'];

                }
                else{

                    //redirect to Admin
                    header('location:'.SITEURL.'/admin/manage.admin.php');
                }

            }

            
        ?> 

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Nmae</td>

                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                    </tr>

                <tr>
                    <td>Username</td>
                    
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                    </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="id" value = "<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secoundary">
                    </td>
                </tr>
            </table>

        </form>

   
    </div>

</div>

<?php

if(isset($_POST['submit']))
{
    //get all value from update
    $id= $_POST['id'];
    echo $full_name= $_POST['full_name'];
    $username= $_POST['username'];

    //create a sql query to update admin
    $sql = "UPDATE fd_admin SET
    
    full_name= '$full_name',
    username= '$username'
    WHERE id= $id
    ";

    //execute the query
    $res = mysqli_query($conn ,$sql);

    //check whether the query is executed or not
    if($res){

        $_SESSION['update']= "Admin updated";
        //redirect to manage admin page
        header('location:'.SITEURL.'/admin/manage.admin.php');
    }
    else{

        $_SESSION['update']= "Admin not updated";
        //redirect to manage admin page
        header('location:'.SITEURL.'/admin/manage.admin.php');
    }

}

?>

<?php include("partials/footer.php")?>