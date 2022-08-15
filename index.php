<?php include('parts/menu.php'); ?>








        <!--Main Section Start-->
        <div class="main-content ">
            <div class="wrapper ">
                <h1>Dashboard</h1>

                <br><br>


                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>

                <br><br>


                <div class="Col text-center">
                    <?php 
                        //sql query
                        $sql1 = "SELECT * FROM admin";
                        //execute query
                        $res1 = mysqli_query($conn,$sql1);
                        //count rows
                        $count1 = mysqli_num_rows($res1);


                    ?>
                    <h1><?php echo $count1; ?></h1>
                    <br></br>
                    No.of admins
                </div>

                <div class="Col text-center">
                    <?php 
                        //sql query
                        $sql2 = "SELECT * FROM services";
                        //execute query
                        $res2 = mysqli_query($conn,$sql2);
                        //count rows
                        $count2 = mysqli_num_rows($res2);


                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br></br>
                    No.of Services
                </div>

                <div class="Col text-center">
                    <?php 
                        //sql query
                        $sql3 = "SELECT * FROM medicalcenters";
                        //execute query
                        $res3 = mysqli_query($conn,$sql3);
                        //count rows
                        $count3 = mysqli_num_rows($res3);


                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br></br>
                    No.of Places
                </div>


                <div class="Col text-center">
                    <?php 
                        //sql query
                        $sql4 = "SELECT * FROM products";
                        //execute query
                        $res4 = mysqli_query($conn,$sql4);
                        //count rows
                        $count4 = mysqli_num_rows($res4);


                    ?>
                    <h1><?php echo $count4; ?></h1>
                    <br></br>
                    No.of Products
                </div>


                <div class="clearfix"></div>

                
            </div>

        </div>
        <!--Main Section End-->

        <?php include('parts/footer.php'); ?>