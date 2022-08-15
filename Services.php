<?php include('Parts1/menue2.php'); ?>


        <!--section start-->
        <section id="MCabout" class="MCabout"> 
            <h1 class="heading">Services</h1>


            <!--teacher section-->
    <section class="teacher">
        

        <?php 
            //Display all services that are active
            //sql query
            $sql = "SELECT * FROM services WHERE Active='Yes' ";
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
                    $SID = $row['SID'];
                    $SName = $row['SName'];
                    $SImage = $row['SImage'];
                    ?>
                    <a href="<?php echo SITEURL; ?>Ayu-Service.php?SID=<?php echo $SID; ?>">

                        <div class="box">
                            <?php 
                                if($SImage == "")
                                {
                                    //image not availble
                                    echo "<div class='error'>Image not found</div>";

                                }
                                else
                                {
                                    //image available
                                    ?>
                                        <img src="<?php echo SITEURL; ?>assets/SImages/<?php echo $SImage; ?>" alt="" />
                                    <?php
                                }
                            ?>
                            
                            <h3><?php echo $SName; ?></h3>
                            <div class="share">
                            <!-- <a href="#" class="fab fa-facebook-f"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-instagram"></a>
                            <a href="#" class="fab fa-linkedin"></a> -->

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

        ?>

        

        

    </section>





    
                

            
            

        </section>



        <!--section end-->



        
    
        
<?php include('Parts1/footer.php'); ?>