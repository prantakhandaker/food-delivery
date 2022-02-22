<?php include("../config/constans.php"); ?>

<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <?php 
            if(isset($_SESSION['login']))
            {

                echo($_SESSION['login']);
                unset($_SESSION['login']);
            }
            
            if(isset($_SESSION['not-login']))
            {

                echo($_SESSION['not-login']);
                unset($_SESSION['not-login']);
            } 


            ?>
            <br><br>
            <!--login start-->
            <form action="" method="POST" class="text-center">
                Usermane: <br>

                <input type="text" name="username" placeholder="Username"><br><br>

                Password: <br>

                <input type="password" name="password" placeholder="Password"><br><br>
                

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            
            </form>
            <!--login end-->
        </div>

        
    </body>
</html>

<?php 

    //check login button clicked or not
    
    if(isset($_POST['submit']))
    {
        //get the data from form
        $username =$_POST["username"];
        $password =md5($_POST["password"]);

        //check sql pass match or not

        $sql = "SELECT * FROM fd_admin WHERE username ='$username' AND password ='$password'";

        //execute the query
        $res = mysqli_query($conn , $sql);

        //count rows whether the user availavle or not

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login']= "Login successfull";
            $_SESSION['user']= $username;
            header('location:'.SITEURL.'/admin');
        }
        else
        {
            $_SESSION['login']= "<div class='text-center'>Login failed</div>";
            header('location:'.SITEURL.'/admin/login.php');
        }



    }

?>