<?php include("partials/menu.php"); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Change Password</h1>

        <br><br>

        <?php
        
        if(isset($_GET['id'])){

            $id=$_GET['id'];
        }

        ?>



        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Old Password</td>

                    <td>
                        <input type="password" name="current_password" placeholder ="Current Password" >
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    
                    <td>
                        <input type="password" name="new_password" placeholder ="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    
                    <td>
                        <input type="password" name="confirm_password" placeholder ="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="id" value = "<?php echo $_GET['id']?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secoundary">
                    </td>
                </tr>
            </table>

        </form>

   
    </div>

</div>

<?php

    //check the update button clicked or not

    if(isset($_POST['submit']))
    {
        //get the data
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
            
        //check thwe user exists or not
        $sql = "SELECT * FROM fd_admin WHERE id= $id AND password = '$current_password'";
        
         //execute the query
        $res = mysqli_query($conn , $sql);

        if($res){

            $count = mysqli_num_rows($res);

            if($count==1){

                //check pass match or not
                if($new_password==$confirm_password){

                    //update the password
                    $sql2 = "UPDATE fd_admin SET
                    password = '$new_password'
                    WHERE id= $id";

                    //execute the query
                    $res2= mysqli_query($conn, $sql2);

                    //query execute or not
                    if ($res2)
                    {
                        
                        //redirect with error massege
                        $_SESSION['change-password']= "Password Changed";
                        header('location:'.SITEURL.'/admin/manage.admin.php');

                    }else 
                    {
                        //redirect with error messege
                        $_SESSION['change-password']= "Password Changed Failed";
                        header('location:'.SITEURL.'/admin/manage.admin.php');
                    }

                }
                else{

                    //redirect with error messege
                    $_SESSION['password-not-match']= "Password not Match";
                    header('location:'.SITEURL.'/admin/manage.admin.php');
                    }

                }
            
            else
            {
                $_SESSION['user-not-found']= "User not found";
                header('location:'.SITEURL.'/admin/manage.admin.php');
            }

        }
           


    }
?>

<?php include("partials/footer.php")?>