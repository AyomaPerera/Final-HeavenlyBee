<!-- <?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Services</h1>

        <br><br>

        <?php 
            //Check wether SIDset or not
            if(isset($_GET['SID']))
            {
                //Get the all details
                //echo "Getting the data";
                $SID=$_GET['SID'];

                //create sql query to get all odetails
                $sql="SELECT * FROM services WHERE SID=$SID";

                //Execute the query
                $res = mysqli_query($conn,$sql);

                //count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    //Get all the data
                    $row=mysqli_fetch_assoc($res);
                    $SName=$row['SName'];
                    $Current_SImage=$row['SImage'];
                    $Featured=$row['Featured'];
                    $Active=$row['Active'];


                }
                else{
                    //Redirect to manage service page
                    $_SESSION['No-Service-Found'] = "<div class='error'>Service Not found</div>";
                    header('location:'.SITEURL.'admin/Manage-Services.php');
                }
            }
            else
            {
                //redirect to manage services page
                header('location:'.SITEURL.'admin/Manage-Services.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Service Name: </td>
                    <td>
                        <input type="text" name="SName" value="<?php echo $SName; ?>">

                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($Current_SImage!="")
                            {
                                //Display the image
                                ?>
                                    <img src="<?php echo SITEURL; ?>assets/SImages/<?php echo $Current_SImage; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Dispaly Massege
                                echo "<div class='error'>Image Not Added</div>";
                            }
                        
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="Image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($Featured == "Yes"){echo "Checked";} ?> type="radio" name="Featured" value="yes">yes
                        <input <?php if($Featured == "No"){echo "Checked";} ?> type="radio" name="Featured" value="No">No
                    </td>
                    
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($Active == "Yes"){echo "Checked";} ?> type="radio" name="Active" value="yes">yes
                        <input <?php if($Active == "No"){echo "Checked";} ?> type="radio" name="Active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="Current_SImage" value="<?php echo $Current_SImage; ?>">
                        <input type="hidden" name="SID" value="<?php echo $SID; ?>">
                        <input type="submit" name="submit" value="Update Service" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1. Get all details from form
                $SID = $_POST['SID'];
                $SName = $_POST['SName'];
                $Current_SImage=$_POST['Current_SImage'];
                $Featured=$_POST['Featured'];
                $Active=$_POST['Active'];

                //2.updating new image selecting
                //Check whether the image is selected or not
                if(isset($_FILES['Image']['name']))
                {
                    //Get the image details
                    $SImage=$_FILES['Image']['$name'];
                    //check image is available or not
                    if($SImage!="")
                    {
                        //Image available
                        //A.upload the new image

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
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                            //redirect to add service page
                            header('location:'.SITEURL.'admin/Manage-Services.php');
                            //Stop the process
                            die();
                        }


                            //B.remove the current image if available
                            if($Current_SImage!="")
                            {
                                    $remove_path="../assets/SImages/".$Current_SImage;
                                    $remove = unlink($remove_path);
                                    //check whether the image is remove or not
                                    //if failed to remove then stop the process
                                if($remove==false)
                                {
                                    //failed to remove
                                    $_SESSION['Failed-remove'] = "<div class='error'>Failed to remove current Image</div>";
                                    header('location:'.SITEURL.'admin/Manage-Servises');
                                    die();//stop the process
                                }
                            }
                        

                    }
                    else
                    {
                        $SImage==$Current_SImage;
                    }
                }
                else
                {
                    $SImage == $Current_SImage;
                }

                //3.update the database
                $sql2 = "UPDATE services SET 
                    SName = '$SName',
                    SImage = '$SImage',
                    Featured = '$Featured',
                    Active = '$Active'
                    WHERE SID = $SID
                
                ";

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                //4.redirect to Manage services

                //check whether it is executed or not
                if($res2==true)
                {
                    //Service updated
                    $_SESSION['update'] = "<div class='success'>Service updated successfully</div>";
                    header('location:'.SITEURL.'admin/Manage-Services.php');

                }
                else
                {
                    //failed to update service
                    $_SESSION['update'] = "<div class='error'>Failed to update Service</div>";
                    header('location:'.SITEURL.'admin/Manage-Services.php');
                }



            }
        ?>    

    </div>
</div>


<?php include('parts/footer.php'); ?> -->