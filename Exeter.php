<?php

// Author : Yonis Ismail

// Title : Twin cities web development

/* Description : This is a web development project that processes and analyses data between a pair of twin cities.
 This is current the Exeter city file which will show places of interests in Exeter on google maps using the google maps API,
 weather data in Exeter using openweathermaps API and Images using the Flikr Api.


// Current task : Completed

// Next task: N/A

// Created: 01/05/21

// Last edited: 22/01/22

*/

echo "<h2> Places of interest in Exeter city!!</h2>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>A Basic Map</title>
	<style>
		#map {
			height: 100%;
		}
		/* Optional: Makes the sample page fill the window. */
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>
	

    <script>
    /* Function to start the mapping API, which will work by creating variables which contain coordinates of places of interest in Exeter,
        and then plotting that onto a map. */
function initMap() {
	var mapOptions = {
		zoom: 8,
        center: new google.maps.LatLng(50.716667, -3.533333),  // Assign centre (Exeter)
        
		mapTypeId: 'roadmap'
	};
	var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Assign Coordinates

    var Ecathedral = {lat: 50.7225,lng: -3.5299};
    var RAMmuseum = {lat: 50.7250,lng: -3.5322};
    var gardens = {lat: 50.6642,lng: -3.3103};
    var BDCmuseum = {lat: 50.733410,lng: -3.534100};

    // Coordinates for Rennes


    /*var Parc = {lat: 48.1144,lng: -1.6695};
    var MuseumFAR = {lat: 48.1096,lng: -1.6750};
    var cathedralSPDR = {lat: 48.1116,lng: -1.6833};
    var AntipodeMJC = {lat: 48.1006,lng: -1.7092};
    */
	
    
    /// This section will place the markers onto the map and add button click actions to show more information.



    // Exeter Cathedral
    
    var marker = new google.maps.Marker({ // Assign Marker
            position: Ecathedral,
			map: map,
			title: 'Exeter Cathedral'
            });
            google.maps.event.addListener(marker, 'click', function() {   // On click
            window.location.href = "https://www.exeter-cathedral.org.uk/";
            });



// Robert Albert Memorial Museum
            var marker = new google.maps.Marker({ // Assign marker
            position: RAMmuseum,
			map: map,
			title: 'Museum'
            });
            google.maps.event.addListener(marker, 'click', function() { // On click
            window.location.href = "http://www.rammuseum.org.uk/";
            });


// Bicton Park Botanical Gardens
            var marker = new google.maps.Marker({ // Assign marker
            position: gardens,
			map: map,
			title: 'Park'
            });
            google.maps.event.addListener(marker, 'click', function() { // On click
            window.location.href = "https://www.bictongardens.co.uk/";
            });


// Bill Douglas Cinema Museum
            var marker = new google.maps.Marker({ // Assign marker
            position: BDCmuseum,
			map: map,
			title: 'Museum'
            });
            google.maps.event.addListener(marker, 'click', function() { // On click
            window.location.href = "https://www.bdcmuseum.org.uk/";
            });



            

}

</script>

</head>
<body>
<div id="map"></div>
<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArDhvU9Hqwm6ZG4_8QAjaV45LoCENe7A0&callback=initMap">  // API call
</script>
</body>
</html>


<?php
/* Create a HTML Search box where you are going to enter the city you want to search for.
Task: Create a web application to find current weather data using openweathermaps API 

*/

// Weather data for Exeter
$app_address = "http://api.openweathermap.org/data/2.5/weather?appid=59ea498db836580ce0373ce596f688ef&&units=metric&q=Exeter,UK"; // API Call for current weather data






// Convert the from json into an array

$data = file_get_contents($app_address);
$data2 = json_decode($data, true);



// Extract specific information within data2 


// current weather
echo "<h2> Current weather!!</h2>";

# Description 
echo ("Description :");
echo $data2["weather"][0]["description"];
echo "<br />";

# Temperature
echo "Temperature: ";
echo $data2["main"]["temp"];
echo "<br />";

echo "Feels like : ";
echo $data2["main"]["feels_like"];
echo "<br />";

echo "Pressure : ";
echo $data2["main"]["pressure"];
echo "<br />";

echo "Humidity : ";
echo $data2["main"]["humidity"];
echo "<br />";

#Wind
echo "wind speed: ";
echo $data2["wind"]["speed"];
echo "<br />";

echo "wind speed: ";
echo $data2["wind"]["deg"];
echo "<br />";




// Weather data for Exeter

$app_addressForecast = "http://api.openweathermap.org/data/2.5/forecast?&appid=59ea498db836580ce0373ce596f688ef&units=metric&q=Exeter,UK";

$data3 = file_get_contents($app_addressForecast);
$data4 = json_decode($data3, true);


// 5 day weather forecast
echo "<h2> 5 day Forecast!!</h2>";
    // <!-- START weather data  -->
    for ($i = 0; $i <= 39; $i+= 3){                     ## Loop through different intervals

        echo("Weather information : ");
        echo($data4["list"][$i]["dt_txt"]);
        echo "<br />";
    
        echo ("Temperature: ");
        echo($data4["list"][$i]["main"]["temp"]);
        echo "<br />";
    
    
        echo("Feels like: ");
        echo($data4["list"][$i]["main"]["feels_like"]);
        echo "<br />";
    
        echo("Humidity: ");
        echo($data4["list"][$i]["main"]["humidity"]);
        echo "<br />";
    
        echo("Wind speed: ");
        echo($data4["list"][$i]["wind"]["speed"]);
        echo "<br />";
    
        echo("Wind Degree: ");
        echo($data4["list"][$i]["wind"]["deg"]);
        echo "<br />";
    
        echo("Description: ");
        echo($data4["list"][$i]["weather"][0]["description"]);
        echo "<br />";
    
    }

    // <!-- FINISH weather data  -->





/* Flikr API implementation to allow users of the application to view pictures of places of Exeter. */

  $tag = 'Exeter';

  $app_address = "https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=4f6e67d452d64a93a1386537a29cc851&tags="
  .$tag."&format=json&nojsoncallback=1";   

  $data = json_decode(file_get_contents($app_address));

  $photos = $data->photos->photo;
  $photos = array_slice($photos,0,4);
  foreach($photos as $photo){
      
      $url = 'http://farm'.$photo->farm.'.staticflickr.com/'.$photo->server.'/'.$photo->id.'_'.$photo->secret.'.jpg';

      echo '<img src="'.$url.'">';
      
    
  }
  echo "<br>";



  

