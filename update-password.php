<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>

        <?php 
            if(isset($_GET['ID']))
            {
                $ID = $_GET['ID'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-pri">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 

            //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
               // echo "Clicked";

               //1. Get the data from the form
                $ID = $_POST['ID'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

               //2. Check whether the user with current ID and Current password Exists or not
               $sql = "SELECT * FROM admin WHERE ID=$ID AND password ='$current_password' ";

               //Execute the Query
               $res = mysqli_query($conn, $sql);

               if($res == true)
               {
                   //Check whether data is available or not
                   $count = mysqli_num_rows($res);

                   if($count==1)
                   {
                       //User exists and password change
                       //echo "User Found";

                       // Check whether New password and confirm password match or not
                        if($new_password == $confirm_password)
                        {
                            //update the password
                            $sql2 = "UPDATE admin SET
                                password = '$new_password' 
                                WHERE ID=$ID
                            ";
                            //Execute the query
                            $res2 = mysqli_query($conn, $sql2);

                            //Checke whether the query is execute or not
                            if($res2 == true)
                            {
                                //Display success message
                                //redirect to the Manage Admin page with success message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                                //redirect the user
                                header('location:'.SITEURL.'admin/Manage-admin.php');


                            }
                            else
                            {
                                //Display error message
                                //redirect to the Manage Admin page with error message
                                $_SESSION['change-pwd'] = "<div class='error'>Password can not change</div>";
                                //redirect the user
                                header('location:'.SITEURL.'admin/Manage-admin.php');

                            }



                        }
                        else
                        {
                            //redirect to the Manage Admin page with error message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password is not match</div>";
                            //redirect the user
                             header('location:'.SITEURL.'admin/Manage-admin.php');

                        }

                   }
                   else
                   {
                       //User doesn't exists set massege and re direct
                       $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                       //redirect the user
                       header('location:'.SITEURL.'admin/Manage-admin.php');
                   }
               }

               //3. Check whether the new Password and confirm Password match or not

               //4. Change Password if all above is true

            }

?>


<?php include('parts/footer.php'); ?>