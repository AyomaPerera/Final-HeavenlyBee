<?php include('Parts1/menue2.php'); 

    // If search form is submitted 
if(isset($_POST['searchSubmit'])){ 
    if(!empty($_POST['location'])){ 
        $location = $_POST['location']; 
    } 
     
    if(!empty($_POST['loc_latitude'])){ 
        $latitude = $_POST['loc_latitude']; 
    } 
     
    if(!empty($_POST['loc_longtiude'])){ 
        $longtiude = $_POST['loc_longtiude']; 
    } 
     
    if(!empty($_POST['distance_km'])){ 
        $distance_km = $_POST['distance_km']; 
    } 
} 
 
// Calculate distance and filter records by radius 
$sql_distance = $having = ''; 
if(!empty($distance_km) && !empty($latitude) && !empty($longtiude)){ 
    $radius_km = $distance_km; 
    $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`p`.`latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`p`.`latitude`*pi()/180)) * cos(((".$longtiude."-`p`.`longtiude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
     
    $having = " HAVING (distance <= $radius_km) "; 
     
    $order_by = ' distance ASC '; 
}else{ 
    $order_by = ' p.CenterId DESC '; 
} 
 
// Fetch places from the database 
$sql = "SELECT p.*".$sql_distance." FROM medicalcenters p $having ORDER BY $order_by";  
$query = $conn->query($sql); 

?>



<!-- new section -->


<!-- jQuery library -->
<script src="cdnjs/jquery.min.js"></script>

<!-- Google Maps JavaScript library -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyD7nufDlm93jaVmWKw9nHvNsVuWQ2oGhVo"></script>


<script>
var searchInput = 'location';

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
    });
	
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('latitude').value = near_place.geometry.location.lat();
        document.getElementById('longtiude').value = near_place.geometry.location.lng();
    });
});

$(document).on('change', '#'+searchInput, function () {
    document.getElementById('latitude').value = '';
    document.getElementById('longtiude').value = '';
});
</script>




<!--Direction Section start-->




<!--Direction Section end-->

<!-- newsection end -->


        




<!--section start-->
        <section id="MCabout" class="MCabout"> 
            <h1 class="heading">Find Your Nearest Ayurvedic Place</h1>

    
        <div class="SearchPanel">
            <form method="post" action="">
                <input type="text" name="location" id="location" value="<?php echo !empty($location)?$location:''; ?>" placeholder="Type location...">
                <input type="hidden" name="loc_latitude" id="latitude" value="<?php echo !empty($latitude)?$latitude:''; ?>">
                <input type="hidden" name="loc_longtiude" id="longtiude" value="<?php echo !empty($longtiude)?$longtiude:''; ?>">
                
                <select name="distance_km">
                    <option value="">Distance</option>
                    <option value="2" <?php echo (!empty($distance_km) && $distance_km == '2')?'selected':''; ?>>+2 KM</option>
                    <option value="5" <?php echo (!empty($distance_km) && $distance_km == '5')?'selected':''; ?>>+5 KM</option>
                    <option value="10" <?php echo (!empty($distance_km) && $distance_km == '10')?'selected':''; ?>>+10 KM</option>
                    <option value="15" <?php echo (!empty($distance_km) && $distance_km == '15')?'selected':''; ?>>+15 KM</option>
                    <option value="20" <?php echo (!empty($distance_km) && $distance_km == '20')?'selected':''; ?>>+20 KM</option>
                </select>
                <input type="submit" name="searchSubmit" value="Search" class='btn'/>
            </form>
        </div>    
        




        







        
        <section class="teacher3">
          <div class="Dbox-container"> 
              <!-- <div class="box"> -->
        <?php 

                //$sql = "SELECT * FROM medicalcenters WHERE Active='Yes' ";
                //execute the query
               // $res = mysqli_query($conn, $sql);
                //count rows
                //$count = mysqli_num_rows($query);
            if($query->num_rows > 0){ 
                while($row = $query->fetch_assoc()){ 
        ?> 
              <a href="https://www.google.com/maps/dir/@">  <div class="pbox"> 
                    <h4><?php echo $row['CenterName']; ?></h4> <br>
                    
                    <!-- <?php echo $row['MCImage']; ?><br> -->
                    
                    <p1><?php echo $row['Address']; ?></p1> <br>
                    <p2>Latitude: <?php echo $row['latitude']; ?></p2><br>
                    <p2>Longtiutde: <?php echo $row['longtiude']; ?></p2><br>
                    <?php if(!empty($row['distance'])){ ?> 
                    <p>Distance: <?php echo round($row['distance'], 2); ?> KM<p> 

                    
                        
                        
                    <?php } ?> 
                </div> </a>
            <?php 
                } 
            }else{ 
                echo '<h5>Place(s) not found...</h5>'; 
            } 
            ?>
            

        
            </div> 

            </section>
        


            
                

            

        

        <!--section end-->

        
        
        </section>


        
    
        
<?php include('Parts1/footer.php'); ?>