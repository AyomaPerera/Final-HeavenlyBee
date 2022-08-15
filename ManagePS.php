<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Services</h1>

        <br /><br />

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['No-Service-Found']))
            {
                echo $_SESSION['No-Service-Found'];
                unset($_SESSION['No-Service-Found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-removed']))
            {
                echo $_SESSION['failed-removed'];
                echo $_SESSION['failed-removed'];
            }
            



        ?>

        <br><br>

                <!--Button to add admin-->
                <a href="<?php echo SITEURL; ?>admin/add-Services.php" class="btn-primary">Add Services</a>
                <br />
                <br />
                <table class="tbl-full">
                    <tr>
                        <th>SID</th>
                        <th>SName</th>
                        <th>SImage</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    
                        //Query to get all services from database
                        $sql = "SELECT * FROM services";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //count rows
                        $count = mysqli_num_rows($res);

                        //create SID number variable and assign value as 1
                        $SIDN=1;

                        //Check whether we have data in database or not
                        if($count>0)
                        {
                            //We have data in database
                            //get the data and display 
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $SID = $row['SID'];
                                $SName = $row['SName'];
                                $SImage = $row['SImage'];
                                $Featured = $row['Featured'];
                                $Active = $row['Active'];

                                ?>

                                <tr>
                                    <td><?php echo $SIDN++; ?></td>
                                    <td><?php echo $SName; ?></td>

                                    <td>
                                        <?php 
                                            //check whether image name is availble or not
                                            if($SImage != "")
                                            {
                                                //Display the image
                                                
                                                ?>
                                                <img src="<?php echo SITEURL; ?>assets/SImages/<?php echo $SImage; ?>" width="100px">

                                                    

                                                <?php

                                            } 
                                            else
                                            {
                                                //display the message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $Featured; ?></td>
                                    <td><?php echo $Active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-service1.php?SID=<?php echo $SID; ?>" class="btn-secondary">Update Service</a>
                                        <a href="<?php echo SITEURL; ?>admin/Delete1-Service.php?SID=<?php echo $SID; ?>&SImage=<?php echo $SImage; ?>" class="btn-trinary">Delete Service</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //we do not have data
                            //we'll display the message in table
                            ?>

                                <tr>
                                    <td colspan="6"><div class="error">No Services added</div></td>
                                </tr>

                            <?php
                        }
                    
                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('parts/footer.php'); ?>