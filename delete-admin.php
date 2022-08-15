<?php

    //include constant.php file here
    include('../config/constant.php');

    //1. get the ID of Admin to be deleted

    echo $ID = $_GET['ID'];

    //2. Create SQL Query to Delete Admin

    $sql = "DELETE FROM admin WHERE ID=$ID";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if($res==true)
    {
        //Query executed successfully and Admin Deleted
        //echo "Admin Deleted";
        //Create Session variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/Manage-admin.php');
    }
    else
    {
        //Failed to delete Admin
        //echo "Failed to Delete Admin";
        $_SESSION['delete']="<div class='error'>Failed to Delete Admin. Try again Later</div>";
        header('location:'.SITEURL.'admin/Manage-admin.php');
    }

    //3. Redirect to Manage Admin page with message (with success / error)
    
        header('location:'.SITEURL.'admin/Manage-admin.php');



    //4. 

?>