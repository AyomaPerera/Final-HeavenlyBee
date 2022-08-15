<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Ayurvedic Medical Centers</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);

            }
        ?>
        <form action="" method = "POST" enctype = "multipart/form.data">
            <table class="tbl-30">

                <tr>
                    <td>Medical Center: </td>
                    <td>
                        <input type="text" name="CenterName" placeholder="Name of the Medical Center">
                    </td>
                </tr>

                <tr>
                    <td>MC Image: </td>
                    <td>
                        <input type="file" name="Image">
                    </td>
                </tr>

                <tr> 
                    <td>Email: </td>
                    <td>
                        <input type="email" name="EmailAddress" placeholder="Email of the MC">
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <textarea name="Address" cols="30" rows="5" placeholder="Address of the Ayurvedic medical center"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Location: </td>
                    <td>
                        <textarea name="Location" cols="30" rows="10" placeholder="Location of the medical center"></textarea>
                    </td>
                    
                </tr>

                <tr>
                    <td>Telephone: </td>
                    <td>
                        <input type="tel" name="TelePhone" >
                    </td>
                </tr>

                <tr>
                    <td>Service Id: </td>
                    <td>
                        <select name="SID">
                            <?php 
                                //create php codes to display services from database
                                //1.create sql query to get all active services from database 

                                $sql = "SELECT * FROM Services WHERE Active = 'Yes'";
                                //Executing the query
                                $res = mysqli_query($conn,$sql);

                                //count rows to check whether we have services or not
                                $count = mysqli_num_rows($res);

                                //if count is greater than 0, we have services, else we don't have services
                                if($count > 0)
                                {
                                    //We have services
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of the services
                                        $SID = $row['SID'];
                                        $SName = $row['SName'];

                                        ?>
                                        <option value="<?php echo $SID; ?>"><?php echo $SName; ?></option>
                                        <?php
                                    
                                    }
                                }
                                else
                                {
                                    //We don't have services
                                    ?>
                                        <option value="0">No service found</option>
                                    <?php
                                }

                                //2.Display services in dropdown
                            ?>
                            
                        </select>

                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="Featured" value="Yes">Yes
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
                        <input type="submit" name="submit" value="Add MC" class="btn-primary">

                    </td>
                </tr>

            </table>
        </form>



        <?php
            //check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the food in database
                //echo "clicked";

                //1.Get the data from form
                $CenterName = $_POST['CenterName'];
                //$MCImage = $_POST['MCImage'];
                $EmailAddress = $_POST['EmailAddress'];
                $Address = $_POST['Address'];
                $Location = $_POST['Location'];
                $TelePhone = $_POST['TelePhone'];
                $SID = $_POST['SID'];

                //check whether the radio button for Featured and Active Checked or not
                if(isset($_POST['Featured']))
                {
                    $Featured = $_POST['Featured'];

                }
                else
                {
                    $Featured = "No";//setting the default value
                }

                if(isset($_POST['Active']))
                {
                    $Active = $_POST['Active'];

                }
                else
                {
                    $Active = "No";//setting the default value
                }


                // //2.Upload the image if selected.
                // //check whether the select image checked or not and upload the image if it is selected
                // if(isset($_FILES['MCImage']['Name']))
                // {
                //     //Get the details of selected image
                //     $MCImage = $_FILES['MCImage']['Name'];

                //     //Check whether the image is selected or not upload image if it is selected
                //     if($MCImage != "")
                //     {
                //         //image is selected
                //         //A.Rename the Image
                //         //Get the extention of selected image(jpg. png. gif. etc)
                //         $ext = end(explode('.',$MCImage));

                //         // create new name for image
                //         $MCImage = "MC_".rand(0000,9999).'.'.$ext;
                //         //B.Upload the Image
                //         //Get the source path
                //         //Source path is the current image location
                //         $src = $_FILES['MCImage']['temp-name'];
                //         //destination path to the uploaded image
                //         $dst = "../assets/MCs/".$MCImage;
                //         //upload the MC image
                //         $upload = move_uploaded_file($src, $dst);
                //         //check whether image uploaded or not
                //         if($upload == false)
                //         {
                //             //fail to upload image
                //             //redirect to add mc page with error msge
                //             $_SESSION['upload'] = "<div class='error'>Faild to upload image.</div>";
                //             header('location:'.SITEURL.'admin/add-MC.php');
                //             //Stop the process
                //             die();

                //         }

                //     }
                // }
                // else
                // {
                //     $MCImage = "";//Setteing default value as blank
                // }




                if(isset($_FILES['Image']['name']))
                {
                    //Upload the image
                    //To upload image we need image name, source path and destination
                    $SImage = $_FILES['Image']['name'];

                    //Upload the image is image selected
                    if($MCImage != "")
                    {

                        

                        //Auto rename image
                        //Get the Extention of our image (jpg, png, gif etc)
                        $ext = end(explode('.',$MCImage));

                        //Rename the image
                        $MCImage = "MC_".rand(000,999).'.'.$ext;



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
                            header('location:'.SITEURL.'admin/add-MC.php');
                            //Stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //Don't Upload image and set the image name as blank
                    $MCImage="";
                }







                //3.Insert data into database
                //create sql querry to save data 
                $sql2 = "INSERT INTO medicalcenters SET
                    CenterName = '$CenterName',
                    MCImage = '$MCImage',
                    EmailAddress = '$EmailAddress',
                    Address = '$Address',
                    Location = '$Location',
                    TelePhone = $TelePhone,
                    SID = $SID,
                    Featured = '$Featured',
                    Active = '$Active'


                ";

                //execute the querry
                $res2 = mysqli_query($conn,$sql2);

                //check whether the data insert or not
                //4.Redirect the Manage admin page with message

                if($res2 == true)
                {
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Medical Center added successfully</div>";
                    header('location:'.SITEURL.'admin/ManageMC.php');

                }
                else
                {
                    //faild to insert 
                    $_SESSION['add'] = "<div class='error'>Fail to Medical Center add</div>";
                    header('location:'.SITEURL.'admin/ManageMC.php');

                }

                


            }
        ?>




    </div>
</div>

<?php include('parts/footer.php'); ?>