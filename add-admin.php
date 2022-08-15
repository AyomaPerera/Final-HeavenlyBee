<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />
        <br />

        <?php 
            if(isset($_SESSION['add']))//Check the session whether set or not
            {
                echo $_SESSION['add'];//display the message if set
                unset($_SESSION['add']);//remove the session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="Name" placeholder="Enter Your name"></td>
                </tr>

                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="UserName" placeholder="Enter Your User Name">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="Password" placeholder="Enter Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>


    </div>

</div>

<?php include('parts/footer.php'); ?>

<?php 
    //Process the value from form and Save it in DataBase

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $Name = $_POST['Name'];
        $UserName=$_POST['UserName'];
        $Password=md5($_POST['Password']);//Password encryption with md5

        //2. SQL Query to Save the Data into database
        $sql = "INSERT INTO admin SET
            Name='$Name',
            UserName='$UserName',
            PassWord='$Password'
        ";

            

        //3. Execute Query and Saving Data in to Database.
        $res = mysqli_query($conn, $sql) or die(mysqli_error());


        //4. Check whether the (Query is Excuted) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data inserted
            // echo "Data Inserted";
            //Create a session variable to Display messages
            $_SESSION['add'] = "<div class='success'>Admin Added Sucessfully</div>";
            //Redirect Page to manage admin
            header("location:".SITEURL.'admin/Manage-admin.php');
        }
        else
        {
            //Failed to Insert Data
            // echo "Fail to Insert Data";
            //Create a session variable to Display messages
            $_SESSION['add'] = "<div class='error'>Fail to add admin</div>";
            //Redirect Page to Add Admin page
            header("location:".SITEURL.'admin/add-admin.php');
        }


    }
    
?>