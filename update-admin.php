<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>

        <?php 
            //1. Get the ID of Selected Admin
            $ID=$_GET['ID'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM admin WHERE ID=$ID";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                //Check whether the data is available or not
                $count = mysqli_num_rows($res);

                //Check whether we have admin data or not
                if($count==1)
                {
                    //Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $Name = $row['Name'];
                    $UserName=$row['UserName'];
                }
                else
                {
                    //Redirect to Manage admin page
                    header('location:'.SITEURL.'admin/Manage-admin.php');
                }

            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="Name" value="<?php echo $Name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>UserName</td>
                    <td>
                        <input type="text" name="UserName" value="<?php echo $UserName; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
        //echo "Button Clicked";
        //Get all the values from form to update
        $ID=$_POST['ID'];
        $Name=$_POST['Name'];
        $UserName=$_POST['UserName'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE admin SET
        Name = '$Name',
        UserName = '$UserName' 
        WHERE ID = '$ID'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/Manage-admin.php');

        }
        else
        {
            //Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin. Try again Later</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/Manage-admin.php');
        }
    }

?>


<?php include('parts/footer.php') ?>
