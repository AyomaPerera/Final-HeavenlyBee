<?php include('Parts1/menue2.php'); ?>


<?php
//check whether ID is pass or not
    if(isset($_GET['CenterId']))
    {
        //Set the sid and get the sid
        $CenterId = $_GET['CenterId'];
        //Get the service name based on sid
        $sql = "SELECT CenterName FROM medicalcenters WHERE CenterId = $CenterId ";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //get the value from databse
        $row = mysqli_fetch_assoc($res);
        //Get the Name
        $SName = $row['CenterName'];


    }
    else
    {
        //service not pass
        //redirect to home page
        header('location:'.SITEURL);
        
    }
?>



<!--section start-->
        <section id="MCabout" class="MCabout"> 
            <h1 class="heading" ><?php echo $SName; ?>......</h1>


            <section class='teacher1'>
    <?php
        //create the sql query to get the details based on service
        $sql2 = "SELECT * FROM products WHERE CenterId = $CenterId ";
        //execute the query
        $res2 = mysqli_query($conn,$sql2);
        //count the rows
        $count2 = mysqli_num_rows($res2);
        //check whether mc available or not
        if($count2 > 0 )
        {
            //MC is available
            while($row2=mysqli_fetch_assoc($res2))
            {
                $PName = $row2['PName'];
                $PImage = $row2['PImage'];
                // $EmailAddress = $row2['EmailAddress'];
                // $Address = $row2['Address'];
                // $Location = $row2['Location'];
                // $TelePhone = $row2['TelePhone'];

                ?>
                
                <div class="box">
                    <?php
                        if($PImage == "")
                        {
                            echo "<div class='error'>Image not available</div>";

                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>assets/PC/<?php echo $PImage; ?>"  />
                            <?php

                        }

                    ?>
                    
                    <h3><?php echo $PName; ?></h3>
                    
                    <!-- <p><?php echo $EmailAddress; ?></p> -->
                    <!-- <p><?php echo $Address; ?></p> -->
                    <!-- <p><?php echo $Location; ?></p> -->
                    <!-- <p><?php echo $TelePhone; ?> -->
                    <!-- <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>

                    </div> -->
                </div>


               

                <?php
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