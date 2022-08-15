<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Ayurvedic Medical Centers and Product Shops</h1>

        <br />
                <br />

                <!--Button to add admin-->
                <a href="<?php echo SITEURL; ?>admin/addMC1.php" class="btn-primary">Add Medical Centers</a>
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
                        <th>CenterId</th>
                        <th>CenterName</th>
                        <th>MCImage</th>
                        <th>EmailAddress</th>
                        <th>Address</th>
                        
                        <th>TelePhone</th>
                        <th>SID</th>
                        <th>latitude</th>
                        <th>longtiude</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                        
                    </tr>

                    <?php
                        //Create sql query to get all details
                        $sql = "SELECT * FROM medicalcenters";
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
                                $CenterId = $row['CenterId'];
                                $CenterName = $row['CenterName'];
                                $MCImage = $row['MCImage'];
                                $EmailAddress = $row['EmailAddress'];
                                $Address = $row['Address'];
                                
                                $TelePhone = $row['TelePhone'];
                                $SID = $row['SID'];
                                $latitude = $row['latitude'];
                                $longtiude = $row['longtiude'];
                                $Featured = $row['Featured'];
                                $Active = $row['Active'];
                                ?>

                                <tr>
                                    <td><?php echo $MCN++; ?></td>
                                    <td><?php echo $CenterName; ?></td>
                                    <td>
                                        <?php 
                                            //check whether we have image or not
                                            if($MCImage == "")
                                            {
                                                //we dont have image and display message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                            else
                                            {
                                                //we have image and display image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>assets/MC/<?php echo $MCImage; ?> " width="90px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $EmailAddress; ?></td>
                                    <td><?php echo $Address; ?></td>
                                    
                                    <td><?php echo $TelePhone; ?></td>
                                    <td><?php echo $SID ; ?></td>
                                    <td><?php echo $latitude; ?></td>
                                    <td><?php echo $longtiude; ?></td>
                                    <td><?php echo $Featured; ?></td>
                                    <td><?php echo $Active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/updateMC.php?CenterId=<?php echo $CenterId; ?>" class="btn-secondary">Update</a>
                                        <a href="<?php echo SITEURL; ?>admin/deleteMC.php?CenterId=<?php echo $CenterId; ?>&MCImage=<?php echo $MCImage; ?>" class="btn-trinary">Delete</a>
                                    </td>
                                </tr>

                                <?php




                            }
                        }
                        else
                        {
                            //food not added yet
                            echo "<tr><td colspan='11' class = 'error'>MC not added yet </td></tr>";
                        }

                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('parts/footer.php'); ?>