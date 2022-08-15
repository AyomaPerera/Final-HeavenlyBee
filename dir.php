<!DOCTYPE html>
<html>
  <head>
    <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>GFG Google Maps Demo</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 28.501859, lng: 77.410320};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src=
"https://maps.googleapis.com/maps/api/js?key=
AIzaSyB2bXKNDezDf6YNVc-SauobynNHPo4RJb8&callback=initMap">
    </script>
  </body>
</html>