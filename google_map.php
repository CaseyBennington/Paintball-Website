<?php
$myscript = 'findfield.php';
$page_title = 'Find the Nearest Field';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="includes/style.css" type="text/css"  />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    </head>
    <body>
        <div id="header">
            <h1>San Diego Paintball Club</h1>
            <h2><b>Time to Shoot</b></h2>
        </div>
        <div id="navigation">
            <ul>
                <li><a href="index.php">Home Page</a></li>
                <li><a href="start.php">Login Page</a></li>
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="view_users.php">Members List</a></li>
                <li><a href="edit_deleteusers.php">Edit/Delete Members</a></li>
                <li><a href="view_userssort.php">Sort Members</a></li>
                <li><a href="searchusers.php">Search Members</a></li>
                <li><a href="findfield.php">Find Field</a></li>
            </ul>
        </div>
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ?>
        <div id="content"><!-- Start of the page-specific content. -->

            <?php
            echo '<h1>Pick a User</h1><br />';

            require_once ('includes/mysqli_connect.php'); // Connect to the db.
            $custId = $_GET['id'];
            $q = "SELECT lastname, firstname, address, city, state, zip, custId FROM customers WHERE custId = $custId";
            $r = @mysqli_query($dbc, $q); // Run the query. 

            if (mysqli_affected_rows($dbc) == 0) {
                echo '<p class="error">Sorry, we could not find any members.</p>';
            } else if (mysqli_num_rows($r) > 0) {
                while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                    $address = $row ['address'] . ',' . $row['city'] . ',' . $row['state'] . ',' . $row['zip'];
                } // End of WHILE loop.

                mysqli_free_result($r);
                mysqli_close($dbc);
            }

            $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' .
                    urlencode($address) . '&sensor=true';
            $json = @file_get_contents($url);
            $data = json_decode($json);

            $status = $data->status;

            if ($status == "OK") {
                $latitude = $data->results[0]->geometry->location->lat;
                $longitude = $data->results[0]->geometry->location->lng;
                //echo 'Latitude = ' . $latitude;
                //echo '<br>';
                //echo 'Longitude = ' . $longitude;
            } else {
                echo "Invalid Address !!";
            }
            ?>

            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>
            <script>
                var map;
                var infowindow;
                var lat = <?php echo json_encode($latitude) ?>;
                var lng = <?php echo json_encode($longitude) ?>;

                function initialize() {

                    // Center of Map
                    var centerLatlng = new google.maps.LatLng(lat, lng);

                    // Marker Icons Declaration
                    var icon = new google.maps.MarkerImage("smLinks-twitter.png", null, null, new google.maps.Point(41, 47));

                    // Map Options
                    var myOptions = {
                        zoom: 9,
                        center: centerLatlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        icons: icon
                    };

                    // Draw the map
                    map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

                    // Marker Icons Implementation
                    markers = new google.maps.Marker({
                        position: centerLatlng,
                        map: map,
                        title: 'Center of Map',
                        icon: icon
                    });

                    // Services: Places
                    var request = {
                        location: centerLatlng,
                        radius: 111800,
                        name: ["paintball"]
                    };
                    infowindow = new google.maps.InfoWindow();
                    var service = new google.maps.places.PlacesService(map);
                    service.search(request, callback);

                } // function initialize()

                function callback(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        console.log(results);
                        for (var i = 0; i < results.length; i++) {
                            createMarker(results[i]);
                        }
                    }
                }

                function createMarker(place) {
                    var placeLoc = place.geometry.location;

                    var iconUrl;
                    switch (place.types[0]) {
                        case 'school':
                            iconUrl = "http://maps.google.com/mapfiles/kml/pal2/icon2.png";
                            break;
                        case 'church':
                            iconUrl = "http://maps.google.com/mapfiles/kml/pal2/icon11.png";
                            break;
                        case 'park':
                            iconUrl = "http://maps.google.com/mapfiles/kml/pal2/icon12.png";
                            break;
                        case 'university':
                            iconUrl = "http://maps.google.com/mapfiles/kml/pal2/icon14.png";
                            break;
                        default:
                            iconUrl = "http://maps.google.com/mapfiles/kml/pal3/icon32.png";
                    }

                    var marker = new google.maps.Marker({
                        map: map,
                        position: place.geometry.location,
                        icon: iconUrl
                    });

                    google.maps.event.addListener(marker, 'mouseover', function() {
                        infowindow.setContent(place.name + '<br/>' + place.vicinity + '<br/><img src="' + place.icon + '">');
                        infowindow.open(map, this);
                    });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>
            <div id="map-canvas"></div>
            <?php
            include ('includes/footer.php');
            ?>