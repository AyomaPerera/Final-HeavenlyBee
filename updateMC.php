<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Medical Centers and Product Shops</h1>

        <br><br>


        <?php
            //Check whether the id is set or not
            if(isset($_GET['CenterId']))
            {
                //Get the id and allother details
                //echo "Getting the data";
                $CenterId=$_GET['CenterId'];
                //create sql querry to get all other details
                $sql = "SELECT * FROM medicalcenters WHERE CenterId = $CenterId ";

                //Execute the qurry
                $res = mysqli_query($conn, $sql);

                //count the rows check whether SID is valid or not
                // $count = mysqli_num_rows($res);
                // if($count == 1)
                // {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $CenterName = $row['CenterName'];
                    $current_MCImage = $row['MCImage'];
                    $EmailAddress = $row['EmailAddress'];
                    $Address = $row['Address'];
                    $TelePhone = $row['TelePhone'];
                    $cSID = $row['SID'];
                    $latitude = $row['latitude'];
                    $longtiude = $row['longtiude'];
                    $Featured = $row['Featured'];
                    $Active = $row['Active'];


                // } 
                // else
                // {
                //     //redirect to manage servise with session message
                //     $_SESSION['No-MC-Found'] = "<div class='error'>Medical Center not found</div>";
                //     header('location:'.SITEURL.'admin/ManageMC.php');
                // }

            }
            else
            {
                //redirect to manage catogeroy page
                header('location:'.SITEURL.'admin/ManageMC.php');
            }
        ?>




        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Center Name: </td>
                    <td>
                        <input type="text" name="CenterName" value="<?php echo $CenterName; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_MCImage == "")
                            {
                                //image not available
                                echo "<div class='error'>Image not available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>assets/MC/<?php echo $current_MCImage; ?>" width = '100px'>
                                <?php
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
                    <td>Email: </td>
                    <td>
                        <input type="email" name="EmailAddress" placeholder="Email of the MC" value="<?php echo $EmailAddress; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <textarea name="Address" cols="30" rows="5" placeholder="Address of the Ayurvedic medical center"><?php echo $Address; ?></textarea>
                    </td>
                </tr>

                

                <tr>
                    <td>Telephone: </td>
                    <td>
                        <input type="tel" name="TelePhone" value="<?php echo $TelePhone; ?>">
                    </td>
                </tr>




                <tr>
                    <td>Service Id: </td>
                    <td>
                        <select name="SID">
                            <?php 
                                //create php codes to display services from database
                                //1.create sql query to get all active services from database 

                                $sql1 = "SELECT * FROM Services WHERE Active = 'Yes'";
                                //Executing the query
                                $res1 = mysqli_query($conn,$sql1);

                                //count rows to check whether we have services or not
                                $count = mysqli_num_rows($res1);

                                //if count is greater than 0, we have services, else we don't have services
                                if($count > 0)
                                {
                                    //We have services
                                    while($row=mysqli_fetch_assoc($res1))
                                    {
                                        //get the details of the services
                                        
                                        $SName = $row['SName'];
                                        $SID = $row['SID'];

                                        ?>
                                        <option <?php if($cSID == $SID){echo "selected";} ?> value="<?php echo $SID; ?>"><?php echo $SName; ?></option>
                                        <?php
                                    
                                    }
                                }
                                else
                                {
                                    //We don't have services
                                    
                                        echo "<option value='0'>MC not Available</option>";
                                    
                                }

                                //2.Display services in dropdown
                            ?>
                            
                            
                        </select>

                    </td>
                </tr>

                <tr>
                    <td>latitude : </td>
                    <td>
                        <input type="text" name="latitude" value="<?php echo $latitude; ?>">
                    </td>
                </tr>

                <tr>
                    <td>longtiude : </td>
                    <td>
                        <input type="text" name="longtiude" value="<?php echo $longtiude; ?>">
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
                        <input type="hidden" name="current_MCImage" value="<?php echo $current_MCImage; ?>">
                        <input type="hidden" name="CenterId" value="<?php echo $CenterId; ?>">
                        <input type="submit" name="submit" value="Update MC" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1.Get all the values from our form
                $CenterId = $_POST['CenterId'];
                $CenterName = $_POST['CenterName'];
                $current_MCImage = $_POST['current_MCImage'];
                $EmailAddress = $_POST['EmailAddress'];
                $Address = $_POST['Address'];
                $TelePhone = $_POST['TelePhone'];
                $SID = $_POST['SID'];
                $latitude = $_POST['latitude'];
                $longtiude = $_POST['longtiude'];
                $Featured = $_POST['Featured'];
                $Active = $_POST['Active'];

                //2.Updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['Image']['name']))
                {
                    //Get the image Details
                    $MCImage = $_FILES['Image']['name'];

                    //check whether the image is availableor not
                    if($MCImage != "")
                    {
                        //Image available
                        //A. upload the new image
                            //Auto rename image
                            //Get the Extention of our image (jpg, png, gif etc)
                            // $ext = end(explode('.',$MCImage));

                            // //Rename the image
                            // $MCImage = "Service_".rand(000,999).'.'.$ext;



                            $source_path = $_FILES['Image']['tmp_name'];

                            $destination_path ="../assets/MC/".$MCImage;

                            //Finally upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);
                            //Check whether the image is uploaded or not
                            //And if thr image is not uploaded then we will stop the process and redirect
                            if($upload == false)
                            {
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                //redirect to add service page
                                header('location:'.SITEURL.'admin/ManageMC.php');
                                //Stop the process
                                die();
                            }

                        //B. remover the current image if availabe
                            if($current_MCImage != "")
                            {
                                $remove_path = "../assets/MC/".$current_MCImage;

                                $remove = unlink($remove_path);

                                //Check whether the image is remove or not
                                //If fail to remove then display message and stop the process 
                                if($remove == false)
                                {
                                    //fail to remove image
                                    $_SESSION['failed-removed'] = "<div class='error'>Fail to remove current image.</div>";
                                    header('location:'.SITEURL.'admin/ManageMC.php');
                                    die();//stop the process

                                }
                            }
                        }
                    else
                    {
                            $MCImage = $current_MCImage;
                     }
                    }
                else
                {
                    $MCImage = $current_MCImage;
                }

                //3.Update the database
                $sql2 = "UPDATE medicalcenters SET 
                    CenterName = '$CenterName',
                    MCImage = '$MCImage',
                    EmailAddress = '$EmailAddress',
                    Address = '$Address',
                    
                    TelePhone = $TelePhone,
                    SID = $SID,
                    latitude = $latitude,
                    longtiude = $longtiude,
                    Featured = '$Featured',
                    Active = '$Active'
                    WHERE CenterId = $CenterId

                ";
                //Excecute thr query
                $res2 = mysqli_query($conn,$sql2);


                //4.Redirect to manage servises page
                //Check whether query execute or no
                if($res2 == true)
                {
                    //Service updated
                    $_SESSION['update'] = "<div class='success'>Servise Update Successfully</div>";
                    header('location:'.SITEURL.'admin/ManageMC.php');
                }
                else
                {
                    //fail to update service
                    $_SESSION['update'] = "<div class='error'>Fail to update service</div>";
                    header('location:'.SITEURL.'admin/ManageMC.php');
                }


            }
        ?>

    </div>
</div>

<?php include('parts/footer.php'); ?>