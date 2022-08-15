<?php 
    //include constant file
    include('../config/constant.php');
    //echo "Delete page";
    //check whether the image id and umage name set or no
    if(isset($_GET['SID']) AND isset($_GET['SImage']))
    {
        //Get the value and delete
        //echo "Get value and delete";
        echo $SID = $_GET['SID'];
        echo $SImage = $_GET['SImage'];

        //remove the physical image file is available
        if($SImage != "")
         {
            //Image is available. so remove it
            $path = "../assets/SImages/".$SImage;
            //remove the image
           $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
           if($remove == false)
           {
                //set the session message 
                $_SESSION['remove'] = "<div class='error'>Failed to remove image.</div>";
                //redirect to manage service page
               header('location:'.SITEURL.'admin/Manage-Services.php');
                //stop the process
               die();
           }
       }

        //Delete data from database
        //sql query to delete data from database
        $sql="DELETE FROM services WHERE SID=$SID";

        //Execute the query
        $res = mysqli_query($conn,$sql);

        //check whether the data was delete from database or not
        if($res==true)
        {
            //Set success message and redirect
            $_SESSION['delete'] ="<div class='success'>Services deleted successfully</div>";
            //redirect to manage services
            header('location:'.SITEURL.'admin/Manage-Services.php');
        }
        else
        {
            //set fail message and redirect
            $_SESSION['delete'] ="<div class='error'>Fail to delete service</div>";
            //redirect to manage services
            header('location:'.SITEURL.'admin/Manage-Services.php');
        }

        


    }
    else
    {
        //redirect to manage service page
        header('location:'.SITEURL.'admin/Manage-Services.php');
    }
?>