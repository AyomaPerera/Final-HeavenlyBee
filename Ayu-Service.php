<?php include('Parts1/menue2.php'); ?>


<?php
//check whether ID is pass or not
    if(isset($_GET['SID']))
    {
        //Set the sid and get the sid
        $SID = $_GET['SID'];
        //Get the service name based on sid
        $sql = "SELECT SName FROM services WHERE SID = $SID ";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //get the value from databse
        $row = mysqli_fetch_assoc($res);
        //Get the Name
        $SName = $row['SName'];


    }
    else
    {
        //service not pass
        //redirect to home page
        header('location:'.SITEURL);
        
    }
?>













<!--Section start-->


        <section id="MCabout" class="MCabout"> 
            <h1 class="heading" ><?php echo $SName; ?>......</h1>


            <section class='teacher1'>
    <?php
        //create the sql query to get the details based on service
        $sql2 = "SELECT * FROM medicalcenters WHERE SID = $SID ";
        //execute the query
        $res2 = mysqli_query($conn,$sql2);
        //count the rows
        $count2 = mysqli_num_rows($res2);
        //check whether mc available or not
        if($count2 > 0 )
        {
            if($SID == 100)
            {
                
            //Display all services that are active
            //sql query
            $sql = "SELECT * FROM medicalcenters WHERE Active='Yes' AND SID = 100";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            //check whether the services ara available or not
            if($count > 0)
            {
                //Services available
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the values
                    $CenterId = $row['CenterId'];
                    $CenterName = $row['CenterName'];
                    $MCImage = $row['MCImage'];
                    $EmailAddress = $row['EmailAddress'];
                    $Address = $row['Address'];
                    $TelePhone = $row['TelePhone'];
                    ?>
                    <a href="<?php echo SITEURL; ?>productsetails.php?CenterId=<?php echo $CenterId; ?>">

                        <div class="box">
                            <?php 
                                if($MCImage == "")
                                {
                                    //image not availble
                                    echo "<div class='error'>Image not found</div>";

                                }
                                else
                                {
                                    //image available
                                    ?>
                                        <img src="<?php echo SITEURL; ?>assets/MC/<?php echo $MCImage; ?>" alt="" />
                                    <?php
                                }
                            ?>
                            
                            <h3><?php echo $CenterName; ?></h3>
                            <p><?php echo $EmailAddress; ?></p>
                            <p><?php echo $Address; ?></p>
                            <p><?php echo $TelePhone; ?></p>
                            <div class="share">
                                <a href="#" class="fab fa-facebook-f"></a>
                                <a href="#" class="fab fa-twitter"></a>
                                <a href="#" class="fab fa-instagram"></a>
                                <a href="#" class="fab fa-linkedin"></a>

                            </div>
                        </div>
                    </a>

                    <?php
                }

            }
            else
            {
                //Services not availble
                echo "<div class='error'>Service not found</div>";
            }

        
            }




            
            else
            {
            //MC is available
            while($row2=mysqli_fetch_assoc($res2))
            {
                $CenterName = $row2['CenterName'];
                $MCImage = $row2['MCImage'];
                $EmailAddress = $row2['EmailAddress'];
                $Address = $row2['Address'];
                // $Location = $row2['Location'];
                $TelePhone = $row2['TelePhone'];

                ?>
                
                <div class="box">

                
                    <?php
                        if($MCImage == "")
                        {
                            echo "<div class='error'>Image not available</div>";

                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>assets/MC/<?php echo $MCImage; ?>"  />
                            <?php

                        }

                    ?>
                    
                    <h3><?php echo $CenterName; ?></h3>
                    
                    <p><?php echo $EmailAddress; ?></p>
                    <p><?php echo $Address; ?></p>
                    <!-- <p><?php echo $Location; ?></p> -->
                    <p><?php echo $TelePhone; ?>
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>

                    </div>
                </div>



                


               

                <?php
            }
        }

                

            
        }
        else
        {
            //Mc is not available
            echo "<div class='error'>Not available</div>";
        }


    ?>

    

            
            
<div class="clearfix"></div>


</section>         
            

 </section>



        <!--section end-->

    

        
    
        
<?php include('Parts1/footer.php'); ?>