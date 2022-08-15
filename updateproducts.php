<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Product Details </h1>

        <br><br>


        <?php
            //Check whether the id is set or not
            if(isset($_GET['PID']))
            {
                //Get the id and allother details
                //echo "Getting the data";
                $PID=$_GET['PID'];
                //create sql querry to get all other details
                $sql = "SELECT * FROM products WHERE PID = $PID ";

                //Execute the qurry
                $res = mysqli_query($conn, $sql);

                //count the rows check whether SID is valid or not
                // $count = mysqli_num_rows($res);
                // if($count == 1)
                // {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $PName = $row['PName'];
                    $current_PImage = $row['PImage'];
                    
                    $cCenterId = $row['CenterId'];
                    
                    
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
                header('location:'.SITEURL.'admin/ManageProducts.php');
            }
        ?>




        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Product Name: </td>
                    <td>
                        <input type="text" name="PName" value="<?php echo $PName; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_PImage == "")
                            {
                                //image not available
                                echo "<div class='error'>Image not available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>assets/PC/<?php echo $current_PImage; ?>" width = '100px'>
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
                    <td>Center Id: </td>
                    <td>
                        <select name="CenterId">
                            <?php 
                                //create php codes to display services from database
                                //1.create sql query to get all active services from database 

                                $sql1 = "SELECT * FROM medicalcenters WHERE Active = 'Yes' and SID = 100";
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
                                        
                                        $CenterName = $row['CenterName'];
                                        $CenterId = $row['CenterId'];

                                        ?>
                                        <option <?php if($cCenterId == $CenterId){echo "selected";} ?> value="<?php echo $CenterId; ?>"><?php echo $CenterName; ?></option>
                                        <?php
                                    
                                    }
                                }
                                else
                                {
                                    //We don't have services
                                    
                                        echo "<option value='0'>Product not Available</option>";
                                    
                                }

                                //2.Display services in dropdown
                            ?>
                            
                            
                        </select>

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
                        <input type="hidden" name="current_PImage" value="<?php echo $current_PImage; ?>">
                        <input type="hidden" name="PID" value="<?php echo $PID; ?>">
                        <input type="submit" name="submit" value="Update Product" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1.Get all the values from our form
                $PID = $_POST['PID'];
                $PName = $_POST['PName'];
                $current_PImage = $_POST['current_PImage'];
                
                $CenterId = $_POST['CenterId'];
                
                
                $Featured = $_POST['Featured'];
                $Active = $_POST['Active'];

                //2.Updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['Image']['name']))
                {
                    //Get the image Details
                    $PImage = $_FILES['Image']['name'];

                    //check whether the image is availableor not
                    if($PImage != "")
                    {
                        //Image available
                        //A. upload the new image
                            //Auto rename image
                            //Get the Extention of our image (jpg, png, gif etc)
                            // $ext = end(explode('.',$MCImage));

                            // //Rename the image
                            // $MCImage = "Service_".rand(000,999).'.'.$ext;



                            $source_path = $_FILES['Image']['tmp_name'];

                            $destination_path ="../assets/PC/".$PImage;

                            //Finally upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);
                            //Check whether the image is uploaded or not
                            //And if thr image is not uploaded then we will stop the process and redirect
                            if($upload == false)
                            {
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                //redirect to add service page
                                header('location:'.SITEURL.'admin/ManageProducts.php');
                                //Stop the process
                                die();
                            }

                        //B. remover the current image if availabe
                            if($current_PImage != "")
                            {
                                $remove_path = "../assets/PC/".$current_PImage;

                                $remove = unlink($remove_path);

                                //Check whether the image is remove or not
                                //If fail to remove then display message and stop the process 
                                if($remove == false)
                                {
                                    //fail to remove image
                                    $_SESSION['failed-removed'] = "<div class='error'>Fail to remove current image.</div>";
                                    header('location:'.SITEURL.'admin/ManageProducts.php');
                                    die();//stop the process

                                }
                            }
                        }
                    else
                    {
                            $PImage = $current_PImage;
                     }
                    }
                else
                {
                    $PImage = $current_PImage;
                }

                //3.Update the database
                $sql2 = "UPDATE products SET 
                    PName = '$PName',
                    PImage = '$PImage',
                    
                    
                    
                    CenterId = $CenterId,
                    
                    
                    Featured = '$Featured',
                    Active = '$Active'
                    WHERE PID = $PID

                ";
                //Excecute thr query
                $res2 = mysqli_query($conn,$sql2);


                //4.Redirect to manage servises page
                //Check whether query execute or no
                if($res2 == true)
                {
                    //Service updated
                    $_SESSION['update'] = "<div class='success'>Product detail Update Successfully</div>";
                    header('location:'.SITEURL.'admin/ManageProducts.php');
                }
                else
                {
                    //fail to update service
                    $_SESSION['update'] = "<div class='error'>Fail to update product details</div>";
                    header('location:'.SITEURL.'admin/ManageProducts.php');
                }


            }
        ?>

    </div>
</div>

<?php include('parts/footer.php'); ?>