<?php include('../config/constant.php'); ?>


<html>

<head>
    <title>Login - Heveanly Bee</title>
</head>

<body>
    <link rel="stylesheet" href="../css/admin.css">

</body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>

        <br><br>

        <!--Login form start here-->
        <form action="" method="POST" class="text-center">
            UserName: <br>
            <input type="text" name="Username" placeholder="Enter Username"><br><br>
            
            PassWord: <br>
            <input type="password" name="PassWord" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-pri">
            <br><br>

        </form>
        <!--Login form end here-->

        <p class="text-center">HeveanlyBee</p>
    </div>

</html>

<?php

    //Check whether the submit button clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //1. Get the Data from Login form
        $Username = $_POST['Username'];
        $PassWord = md5($_POST['PassWord']);

        //2. sql to check whether the user with username and password exist or not
        $sql = "SELECT * FROM admin WHERE UserName = '$Username' AND PassWord = '$PassWord'";

        //3. execute the query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        if($count == 1)
        {
            //User avilable and login success
            $_SESSION['login'] = "<div class='success text-center'>Login Success</div>";
            $_SESSION['user'] = $Username;//To check whether the user is logged in or not and logout will unset it.

            //redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');

        }
        else
        {
            //User not available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password Did not match</div>";
            //redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/Login.php');
        }
        
    }

?>