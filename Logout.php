<?php

    //include constant.php for SITEURL
    include('../config/constant.php');
    //1. Destory the session
    session_destroy();//Unsset $_SESSION['user']

    //2. Redirect to the session
    header('location:'.SITEURL.'admin/Login.php');
?>