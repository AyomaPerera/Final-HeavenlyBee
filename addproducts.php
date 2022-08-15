<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Products</h1>
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

        <!--Add Services Form Starts-->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Product : </td>
                    <td>
                        <input type="text" name="PName" placeholder="Name of Product">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
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

                                $sql = "SELECT * FROM medicalcenters WHERE Active = 'Yes' AND SID = 100";
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
                                        $CenterId = $row['CenterId'];
                                        $CenterName = $row['CenterName'];

                                        ?>
                                        <option value="<?php echo $CenterId; ?>"><?php echo $CenterName; ?></option>
                                        <?php
                                    
                                    }
                                }
                                else
                                {
                                    //We don't have services
                                    ?>
                                        <option value="0">No product found</option>
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
                        <input type="submit" name="submit" value="Add Product" class="btn-primary">
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
                $PName = $_POST['PName'];
                
                $CenterId = $_POST['CenterId'];
                
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
                    $PImage = $_FILES['Image']['name'];

                    //Upload the image is image selected
                    if($PImage != "")
                    {

                        

                        //Auto rename image
                        //Get the Extention of our image (jpg, png, gif etc)
                        
                        // $ext1 = end(explode('.' , $MCImage));
                        // // create new name for image
                        // $MCImage = "MC_".rand(0000,9999).".".$ext1;



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
                            header('location:'.SITEURL.'admin/addproducts.php');
                            //Stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //Don't Upload image and set the image name as blank
                    $PImage="";
                }

                //2. Create SQL query to insert services into database
                $sql2 = "INSERT INTO products SET
                    PName = '$PName',

                    PImage='$PImage',
                    
                    
                   
                    CenterId = $CenterId,
                    
                    
                    Featured = '$Featured',
                    Active = '$Active'
                ";

                //3. Execute the Query and Save in the Database
                $res2 = mysqli_query($conn,$sql2);

                //4. Check whether the query executed or not and data added or not
                if($res2 == true)
                {
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Product added successfully</div>";
                    //header('location:'.SITEURL.'admin/ManageMC.php');
                    header('location:'.SITEURL.'admin/ManageProducts.php');

                }
                else
                {
                    //faild to insert 
                    $_SESSION['add'] = "<div class='error'>Fail to product add</div>";
                    header('location:'.SITEURL.'admin/ManageProducts.php');

                }

            }
        ?>
    </div>
</div>


<?php include('parts/footer.php'); ?>