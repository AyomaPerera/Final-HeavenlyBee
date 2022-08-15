<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage  Products</h1>

        <br />
                <br />

                <!--Button to add admin-->
                <a href="<?php echo SITEURL; ?>admin/addproducts.php" class="btn-primary">Add New Product</a>
                <br />
                <br />
                <br />


                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                        
                    }


                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['Udelete']))
                    {
                        echo $_SESSION['Udelete'];
                        unset($_SESSION['Udelete']);
                    }

                    if(isset($_SESSION['No-MC-Found']))
                    {
                        echo $_SESSION['No-MC-Found'];
                        unset($_SESSION['No-MC-Found']);
                    }

                    if(isset($_SESSION['failed-removed']))
                    {
                        echo $_SESSION['failed-removed'];
                        unset($_SESSION['failed-removed']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>


                <table class="tbl-full">
                    <tr>
                        <th>PID</th>
                        <th>PName</th>
                        <th>PImage</th>
                        <th>CenterId</th>
                        
                        <th>Active</th>
                        
                        <th>Featured</th>
                        
                        
                    </tr>

                    <?php
                        //Create sql query to get all details
                        $sql = "SELECT * FROM products";
                        //executethe query
                        $res = mysqli_query($conn, $sql);
                         // count the rows whethee we have mc or not
                        $count = mysqli_num_rows($res);

                        // create mcid variabel and set default value as 1
                        $MCN = 1;



                        if($count > 0)
                        {
                            //We have mc in database
                            //get the mc from database and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values individual
                                $PID = $row['PID'];
                                $PName = $row['PName'];
                                $PImage = $row['PImage'];
                                $CenterId = $row['CenterId'];
                                
                                
                                $Featured = $row['Featured'];
                                $Active = $row['Active'];
                                ?>

                                <tr>
                                    <td><?php echo $MCN++; ?></td>
                                    <td><?php echo $PName; ?></td>
                                    <td>
                                        <?php 
                                            //check whether we have image or not
                                            if($PImage == "")
                                            {
                                                //we dont have image and display message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                            else
                                            {
                                                //we have image and display image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>assets/PC/<?php echo $PImage; ?> " width="90px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <!-- <td><?php echo $PID; ?></td> -->
                                    
                                    <td><?php echo $CenterId ; ?></td>
                                    
                                    
                                    <td><?php echo $Featured; ?></td>
                                    <td><?php echo $Active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/updateproducts.php?PID=<?php echo $PID; ?>" class="btn-secondary">Update</a>
                                        <a href="<?php echo SITEURL; ?>admin/deleteproducts.php?PID=<?php echo $PID; ?>&PImage=<?php echo $PImage; ?>" class="btn-trinary">Delete</a>
                                    </td>
                                </tr>

                                <?php




                            }
                        }
                        else
                        {
                            //food not added yet
                            echo "<tr><td colspan='11' class = 'error'>Product not added yet </td></tr>";
                        }

                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('parts/footer.php'); ?>