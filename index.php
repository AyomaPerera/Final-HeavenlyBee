<?php include('Parts1/menue1.php'); ?>



<!--Search section start-->
<!-- <section class="Search" text-center>
    <div class="container">
        <form action="MCSearch.html" Method="POST">
            <input type="search" name="search" placeholder = "Serch for ....." required>
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
    </div>

</section> -->
<!--Search Section Start -->



        <!--home section starts-->

        <section id="home" class="home">
            <h1 class="banner">Heavenly Bee is the Way To Have Good Health.</h1>
            <h2 class="banner1"> Herbal Medicine is natures Wonder!!</h2>
            <h3 class="slogan">Amazing technology. Graceful Care</h3>
            <h3 class="slogan1">The Skill To Heal. The Spirit To Care.</h3>

            <a href="Servises.php"><button class="button">Start here </button></a>

            
            

        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="bee beew"></div>
        <div class="bee1 beew1"></div>
        

        <div class="fas fa-mortar-pestle herb1"></div>
        <div class="fas fa-mortar-pestle herb2"></div>

        
    </section>

        <!--home section ends-->

        <!--Aboutsection start-->
        <section id="about" class="about"> 
            <h1 class="heading">About Us</h1>
            <div class="row">
                <div class="content">
                    <h3>We will show you Nearest Traditional Medical Centers & Product Shops </h3>
                    <p>Follow the Heavenly Bee</p>
                    <a href="AboutUS.php"><button class="btn">Read More</button></a>
                </div>
                

            <div class="image">
                <img src="Home4.jpg" alt="">
            </div>
            </div>
            

        </section>



        <!--About section end-->

        <!--Service section starts-->
        <section id="services" class="services">
           <a href="Services.php"> <h1 class="heading">Our Services</h1></a>



        <?php
            //create sql query to display services from database
            $sql = "SELECT * FROM services WHERE Active='Yes' AND Featured ='Yes' ";
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check whether the services available or not
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                //Service available
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the values like id,Service title, image
                    $SID = $row['SID'];
                    $SName = $row['SName'];
                    $SImage = $row['SImage'];

                    ?>

                        <a href="<?php echo SITEURL; ?>Ayu-Service.php?SID=<?php echo $SID; ?>">
                            <div class="row">
                                <div class="image">
                                    <?php 
                                    //check whether image is available or not
                                        if($SImage == "")
                                        {
                                            //display the message
                                            echo "<div class='error'>Image Not Available</div>";
                                        }
                                        else
                                        {
                                            //Image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>assets/SImages/<?php echo $SImage; ?>" alt="">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                <div class="content">
                                    <h3><?php echo $SName; ?></h3>
                                    <p>Ayurvedic medicine (“Ayurveda” for short) is one of the world's oldest holistic (“whole-body”) healing systems..</p>
                                    
                                </div>
                            </div>
                        </a>


                    <?php
                }

            }
            else
            {
                //Services not avalable
                echo "<div class='error'>Services Not added</div>";
            }
        ?>



            


           


            

        </section>


        <!--Service section ends-->


        <!--Direction start-->
        <section id="Direction" class="direction"> 
            <h1 class="heading">Places</h1>
            <div class="row">
                
                <div class="content">
                    
                    <p>Visit Our Website and Get the location of Ayurvedic Center which close to You! </p>
                    <br>
                    <a href="Direction.php"><button class="btn">More...</button></a>
                </div>


                <div class="image">
                    <img src="herbwave.jpg" alt="">
                </div>
            </div>
            </div>
            

        </section>



        <!--About section end-->


        <!--Contact Section Starts-->
        <section id="contact" class="contact">
            <h1 class="heading">Contact Us</h1>
            <div class="row">
                <div class="image">
                    <img src="contact.jpg" alt="">
                </div>

                <div class="form-container">
                    <form action="">

                        <div class="inputBox">
                            <input type="text" placeholder="first name">
                            <input type="text" placeholder="last name">

                        </div>
                        <input type="email" placeholder="email">
                        <textarea name="" id="" cols="30" rows="10" placeholder="message"></textarea>
                        <input type="submit" value="send">
                    </form>

                </div>
            </div>

        </section>

        <!--Contact Section Ends-->


        <!--FAQ section starts-->
        <section id="faq" class="faq">
            <h1 class="heading">FAQ</h1>
            <div class="row">
                <div class="image">
                    <img src="ppt1.png" alt="">
                </div>
                <div class="accordion-container">
                    <div class="accordion">
                        <div class="accordion-headre">
                            <span>+</span>
                            <h3>How to use this?</h3>
                        </div>
                        <div class=" accordion-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt excepturi totam facilis asperiores nihil, esse assumenda laudantium vero accusamus recusandae aperiam facere rerum voluptatibus quidem tempora ipsam dolor ea accusantium!</p>
                        </div>
                    </div>

                    <div class="accordion">
                        <div class="accordion-headre">
                            <span>+</span>
                            <h3>How to get direction</h3>
                        </div>
                        <div class=" accordion-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt excepturi totam facilis asperiores nihil, esse assumenda laudantium vero accusamus recusandae aperiam facere rerum voluptatibus quidem tempora ipsam dolor ea accusantium!</p>
                        </div>
                    </div>
                </div>
            </div>


        </section>


        <!--FAQ section Ends-->



        <!--Admin Login Form start-->
        <div class="loginform">
            <p>User ? <a href="#services"> Welcome to our services</a></p>
            <p>Admin ? <p> Please Login</p></p>
            <form action="">
                <h3>Login</h3>
                <input type="email" placeholder="User Name" class="box"/>
                <input type="password" placeholder="PassWord" class="box"/>
                <input type="submit" class="btn" value="login"/>

                <i class="fas fa-times"></i>
                
                
            </form>

        </div>
        <!--Admin Login Form End-->
        

        
        
        
        <?php include('Parts1/footer.php'); ?>













       