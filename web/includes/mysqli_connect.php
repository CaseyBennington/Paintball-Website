<?php

# Script 8.2 - mysqli_connect.php
// This file contains the database access information.
// This file also establishes a connection to MySQL
// and selects the database.
// Set the database access information as constants:
// DEFINE('DB_USER', 'itp225');
// DEFINE('DB_PASSWORD', 'itp225');
// DEFINE('DB_HOST', 'localhost');
// DEFINE('DB_NAME', 'mod4');

DEFINE('DB_USER', 'be093d74818bca');
DEFINE('DB_PASSWORD', '93790984');
DEFINE('DB_HOST', 'us-cdbr-iron-east-04.cleardb.net');
DEFINE('DB_NAME', 'heroku_b2f319a0cc7c82a');

DEFINE('API_KEY', 'AIzaSyA1lhYipcYX_G-jutwBZYOoJ3pA96FSNgA');
// mysql://be093d74818bca:93790984@us-cdbr-iron-east-04.cleardb.net/heroku_b2f319a0cc7c82a?reconnect=true
//
// Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());
?>
