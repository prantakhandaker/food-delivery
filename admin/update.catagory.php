<?php include("partials/menu.php"); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Update Catagory</h1>

        <br><br>

        <?php

        //check the data is set or not
        if (isset($_GET['id'])) {
            //get all the data
            $id = $_GET['id'];
            //sql query for all data
            $sql = "SELECT * FROM fd_catagory WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows to check wather thae data is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {

                //get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $feature = $row['feature'];
                $active = $row['active'];

                //echo '<pre>';
                // print_r($row);
                // exit();

            } else {
                //redirect with mcg
                $_SESSION['no-catagory'] = "Catagory Not Found";
                header('location:' . SITEURL . '/admin/manage.catagory.php');
            }
        } else {
            //redirect
            header('location:' . SITEURL . '/admin/manage.catagory.php');
        }

        ?>

        <br><br>

        <!-- main content start-->

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image:</td>
                    <td>
                        <?php

                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>/images/catagory/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            echo "Image Not Added";
                        }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select Img:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($feature == 'yes') echo "checked" ?> type="radio" name="feature" value="yes"> Yes
                        <input <?php if ($feature == "no") {
                                    echo "checked";
                                } ?> type="radio" name="feature" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if ($active == "no") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Catagory" class="btn-secoundary">
                    </td>
                </tr>
            </table>

        </form>

        <!-- main content end-->
    </div>

</div>

<?php

//check button click or not
if (isset($_POST['submit'])) {
    //echo "clicked";
    //get all value from our from
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $feature = $_POST['feature'];
    $active = $_POST['active'];

    //updae new image if selected
    //check wather the image is selected or not
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        //check wather the image is available or not
        if ($image_name != "") {
            //upload the new image

            //auto rename our image
            //get the extenction of image
            $ext = end(explode('.', $image_name));

            //rename image
            $image_name = "food_catagory_" . rand(0000, 9999) . '.' . $ext;

            $source_path = $_FILES["image"]["tmp_name"];

            $destination_path = "../images/catagory/" . $image_name;

            //finally upload image
            $upload = move_uploaded_file($source_path, $destination_path);

           

            if ($upload == false) {
                $_SESSION["upload"] = "Failed to upload image";
                // redierct
                header('location:' . SITEURL . '/admin/manage.catagory.php');
                //stop the process.
                die();
            }
            //remove the current mage if available
            if ($current_image != "") {
                $remove_path = "../images/catagory/" . $current_image;

                $remove = unlink($remove_path);

                //check the image remove or not
                if ($remove == false) {
                    $_SESSION['failed_remove'] = "Failed to remove the Image";
                    header('location:' . SITEURL . '/admin/manage.catagory.php');
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    //update database
    $sql2 = "UPDATE fd_catagory SET
                title= '$title',
                image_name= '$image_name',
                feature= '$feature',
                active= '$active'
                WHERE id=$id
            ";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //check query execute or not
    if ($res2 == true) {
        $_SESSION['update'] = "Catagory Updated";
        header('location:'.SITEURL.'/admin/manage.catagory.php');
    } else {
        $_SESSION['update'] = "Catagory Updated Failed";
        header('location:'.SITEURL.'/admin/manage.catagory.php');
    }
}

?>

<?php include("partials/footer.php"); ?>