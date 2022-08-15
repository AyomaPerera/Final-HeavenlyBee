<?php

    //include constance page
    include('../config/constant.php');

    //echo "Delete Products";
    if(isset($_GET['PID']) && isset($_GET['PImage']))
    {
        //process to delete
        //echo "Process to delete";

        //1.Get id and image name
        $PID = $_GET['PID'];
        $PImage = $_GET['PImage'];

        //2.remove the image if available
        //Check image is available or not and delete if only available
        if($PImage != "")
        {
            //it has image and remove from folder
            //get the image path
            $path = "../assets/PC/".$PImage;

            //remove image file from folder
            $remove = unlink($path);

            //check image is removed or not
            if($remove == false)
            {
                //faild to remove
                $_SESSION['upload'] = "<div class='error'> Faild to remove image</div>";
                //redirect to manage mc
                header('location:'.SITEURL.'admin/ManageProducts.php');
                //stop the process of deleteing mc
                die();

            }
        }

        //3.delete mc fom database
        $sql = "DELETE FROM products WHERE PID = $PID";
        //execurte the query
        $res = mysqli_query($conn,$sql);

        //check the query is executed or not and session message
        //4.redirect manage mc with mesage

        if($res == true)
        {
            //MC deleted
            $_SESSION['delete'] = "<div class='success'>MC deleted succesfully</div>";
            header('location:'.SITEURL.'admin/ManageProducts.php');
        }
        else
        {
            //faild to delete MC
            $_SESSION['delete'] = "<div class='error'>fail to delete Products</div>";
            header('location:'.SITEURL.'admin/ManageProducts.php');
        }
        

    }
    else
    {
        //redirect to Manage MC page
        //echo "redirect";
        $_SESSION['Udelete'] = "<div class='error'>Faild to delete</div>";
        header('location:'.SITEURL.'admin/ManageProducts.php');

    }
?>