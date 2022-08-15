<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Location for place</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!--Add place Form Starts-->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Place Name: </td>
                    <td>
                        <input type="text" name="title" placeholder = "Name of plcae">
                    </td>
                </tr>

                

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="Featured" value="Yes">yes
                        <input type="radio" name="Featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="Active" value="Yes">Yes
                        <input type="radio" name="Active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Service" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <!--Add Services Form End-->

        <?php
            //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the value from servic form
                $SName = $_POST['SName'];

                //for radio input, we need to check whether the button select or not
                if(isset($_POST['Featured']))
                {
                    //Get the value from form
                    $Featured = $_POST['Featured'];
                }
                else
                {
                    //set the value
                    $Featured = "No";
                }

                if(isset($_POST['Active']))
                {
                    $Active = $_POST['Active'];
                }
                else
                {
                    $Active = "No";
                }

                //Check whether the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['SImage']);
                //die();//Break the code here

                if(isset($_FILES['Image']['name']))
                {
                    //Upload the image
                    //To upload image we need image name, source path and destination
                    $SImage = $_FILES['Image']['name'];

                    //Upload the image is image selected
                    if($SImage != "")
                    {

                        

                        //Auto rename image
                        //Get the Extention of our image (jpg, png, gif etc)
                        $ext = end(explode('.',$SImage));

                        //Rename the image
                        $SImage = "Service_".rand(000,999).'.'.$ext;



                        $source_path = $_FILES['Image']['tmp_name'];

                        $destination_path ="../assets/SImages/".$SImage;

                        //Finally upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        //Check whether the image is uploaded or not
                        //And if thr image is not uploaded then we will stop the process and redirect
                        if($upload == false)
                        {
                            //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                            //redirect to add service page
                            header('location:'.SITEURL.'admin/add-Services.php');
                            //Stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //Don't Upload image and set the image name as blank
                    $SImage="";
                }

                //2. Create SQL query to insert services into database
                $sql = "INSERT INTO services SET
                    SName='$SName',
                    SImage='$SImage',
                    Featured = '$Featured',
                    Active = '$Active'
                ";

                //3. Execute the Query and Save in the Database
                $res = mysqli_query($conn,$sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query Executed and Services Added
                    $_SESSION['add'] = "<div class='success'>Service Add Succesfull</div>";
                    //Redirect to Manage Service Page
                    header('location:'.SITEURL.'admin/Manage-Services.php');

                }
                else
                {
                    //Failed to add service
                    $_SESSION['add'] = "<div class='error'>Failed to add Service</div>";
                    //Redirect to Manage Service Page
                    header('location:'.SITEURL.'admin/add-Services.php');
                }

            }
        ?>
    </div>
</div>


<?php include('parts/footer.php'); ?>