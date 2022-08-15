<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Services</h1>

        <br><br>


        <?php
            //Check whether the id is set or not
            if(isset($_GET['SID']))
            {
                //Get the id and allother details
                //echo "Getting the data";
                $SID=$_GET['SID'];
                //create sql querry to get all other details
                $sql = "SELECT * FROM services WHERE SID = $SID";

                //Execute the qurry
                $res = mysqli_query($conn, $sql);

                //count the rows check whether SID is valid or not
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $SName = $row['SName'];
                    $current_SImage = $row['SImage'];
                    $Featured = $row['Featured'];
                    $Active = $row['Active'];


                } 
                else
                {
                    //redirect to manage servise with session message
                    $_SESSION['No-Service-Found'] = "<div class='error'>Service not found</div>";
                    header('location:'.SITEURL.'admin/Manage-Services.php');
                }

            }
            else
            {
                //redirect to manage catogeroy page
                header('location:'.SITEURL.'admin/Manage-Services.php');
            }
        ?>




        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>SName: </td>
                    <td>
                        <input type="text" name="SName" value="<?php echo $SName; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_SImage != "")
                            {
                                //Display the image
                                ?>
                                    <img src="<?php echo SITEURL; ?>assets/SImages/<?php echo $current_SImage; ?>" width="150px">
                                
                                <?php
                            }
                            else
                            {
                                //Display message
                                echo "<div class='error'>Image not added</div>";
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
                        <input <?php if($Featured == "Yes"){echo "Checked";} ?> type="radio" name="Featured" value="Yes">Yes

                        <input <?php if($Featured == "No"){echo "Checked";} ?> type="radio" name="Featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($Active == "Yes"){echo "Checked";} ?> type="radio" name="Active" value="Yes">Yes

                        <input <?php if($Active == "No"){echo "Checked";} ?> type="radio" name="Active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="SImage" value="<?php echo $current_SImage; ?>">
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
                //1.Get all the values from our form
                $SID = $_POST['SID'];
                $SName = $_POST['SName'];
                $current_SImage = $_POST['SImage'];
                $Featured = $_POST['Featured'];
                $Active = $_POST['Active'];

                //2.Updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['Image']['name']))
                {
                    //Get the image Details
                    $SImage = $_FILES['Image']['name'];

                    //check whether the image is availableor not
                    if($SImage != "")
                    {
                        //Image available
                        //A. upload the new image
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
                                header('location:'.SITEURL.'admin/Manage-Services.php');
                                //Stop the process
                                die();
                            }

                        //B. remover the current image if availabe
                        if($current_SImage != "")
                        {
                            $remove_path = "../assets/SImages/".$current_SImage;

                            $remove = unlink($remove_path);

                            //Check whether the image is remove or not
                            //If fail to remove then display message and stop the process 
                            if($remove == false)
                            {
                                //fail to remove image
                                $_SESSION['failed-removed'] = "<div class='error'>Fail to remove current image.</div>";
                                header('location:'.SITEURL.'admin/Manage-Services.php');
                                die();//stop the process

                            }
                        }
                        


                    }
                    else
                    {
                        $SImage = $current_SImage;
                    }

                }
                else
                {
                    $SImage = $current_SImage;
                }

                //3.Update the database
                $sql2 = "UPDATE services SET 
                    SNAME = '$SName',
                    SImage = '$SImage',
                    Featured = '$Featured',
                    Active = '$Active'
                    WHERE SID = $SID 

                ";
                //Excecute thr query
                $res2 = mysqli_query($conn,$sql2);


                //4.Redirect to manage servises page
                //Check whether query execute or no
                if($res2 == true)
                {
                    //Service updated
                    $_SESSION['update'] = "<div class='success'>Servise Update Successfully</div>";
                    header('location:'.SITEURL.'admin/Manage-Services.php');
                }
                else
                {
                    //fail to update service
                    $_SESSION['update'] = "<div class='error'>Fail to update service</div>";
                    header('location:'.SITEURL.'admin/Manage-Services.php');
                }


            }
        ?>

    </div>
</div>

<?php include('parts/footer.php'); ?>