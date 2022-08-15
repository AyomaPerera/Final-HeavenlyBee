<?php
    //Authorization - Access Control
    
    //Check whether the user is login or not
    if(!isset($_SESSION['user']))//If user session is not set
    {
        //User is not logged in
        //Redirect to login page with session
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel</div>";
        //Redirect to login Page
        header('location:'.SITEURL.'admin/Login.php');


    }
?>