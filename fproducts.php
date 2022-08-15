<?php include('Parts1/menue2.php'); ?>


        <!--section start-->
        <section id="MCabout" class="MCabout"> 
            <h1 class="heading">Products</h1>


            <!--teacher section-->
    <section class="teacher1">

    <?php
        //Display foods that are active
        $sql = "SELECT * FROM products WHERE Active='Yes' ";
        //Execute the query
        $res = mysqli_query($conn,$sql);
        //count rows
        $count = mysqli_num_rows($res);
        //check whethre the mcs are available or not
        if($count > 0)
        {
            //MCS are avalable
            while($row = mysqli_fetch_assoc($res))
            {
                //Get the values
                $PID = $row['PID'];
                $PName = $row['PName'];
                $PImage = $row['PImage'];
                // $EmailAddress = $row['EmailAddress'];
                // $Address = $row['Address'];
                // $Location = $row['Location'];
                // $TelePhone = $row['TelePhone'];

                ?>
                    <div class="box">
                        <?php
                            //check whether image available or not
                            if($PImage == "")
                            {
                                //Image not available
                                echo "<div class='error'>Image not available</div>";

                            }
                            else
                            {
                                //Image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>assets/PC/<?php echo $PImage; ?>" alt="" />
                                <?php
                            }
                        ?>
                        
                        <h3><?php echo $PName; ?></h3>
                        
                        <!-- <p><?php echo $CenterName; ?></p> -->
                        <!-- <p><?php echo $Address; ?></p> -->
                        <!-- <p><?php echo $TelePhone; ?></p> -->
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
            //MCs are not available
            echo "<div class='error'>Mc not found </div>";
        }


    ?>
        


        <div class="clearfix"></div>
    </section>

            
                

            
            

        </section>



        <!--section end-->



        <?php include('Parts1/footer.php'); ?>