<?php

    //include constance page
    include('../config/constant.php');

    //echo "Delete Medical Center";
    if(isset($_GET['CenterId']) && isset($_GET['MCImage']))
    {
        //process to delete
        //echo "Process to delete";

        //1.Get id and image name
        $CeneterId = $_GET['CenterId'];
        $MCImage = $_GET['MCImage'];

        //2.remove the image if available
        //Check image is available or not and delete if only available
        if($MCImage != "")
        {
            //it has image and remove from folder
            //get the image path
            $path = "../assets/MC/".$MCImage;

            //remove image file from folder
            $remove = unlink($path);

            //check image is removed or not
            if($remove == false)
            {
                //faild to remove
                $_SESSION['upload'] = "<div class='error'> Faild to remove image</div>";
                //redirect to manage mc
                header('location:'.SITEURL.'admin/ManageMC.php');
                //stop the process of deleteing mc
                die();

            }
        }

        //3.delete mc fom database
        $sql = "DELETE FROM medicalcenters WHERE CenterId = $CeneterId";
        //execurte the query
        $res = mysqli_query($conn,$sql);

        //check the query is executed or not and session message
        //4.redirect manage mc with mesage

        if($res == true)
        {
            //MC deleted
            $_SESSION['delete'] = "<div class='success'>MC deleted succesfully</div>";
            header('location:'.SITEURL.'admin/ManageMC.php');
        }
        else
        {
            //faild to delete MC
            $_SESSION['delete'] = "<div class='error'>fail to delete MC</div>";
            header('location:'.SITEURL.'admin/ManageMC.php');
        }
        

    }
    else
    {
        //redirect to Manage MC page
        //echo "redirect";
        $_SESSION['Udelete'] = "<div class='error'>Faild to delete</div>";
        header('location:'.SITEURL.'admin/ManageMC.php');

    }
?>