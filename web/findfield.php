<?php

// This script finds the nearest field given the member's address using Google Maps.

$myscript = 'findfield.php';
$page_title = 'Find the Nearest Field';
include ('includes/header.php');
echo '<h1>Pick a User</h1><br />';

require_once ('includes/mysqli_connect.php'); // Connect to the db.
// Page header:
$q = 'SELECT COUNT(custId) FROM customers';
$r = @mysqli_query($dbc, $q);
$row = @mysqli_fetch_array($r, MYSQLI_NUM);
$num = $row[0];
echo "<!-- row=$row -->";
echo "<p class=usercount>There are currently $num registered users.</p>\n";

$order_by = 'lastname'; // Define this var for table.inc.php.
$sort = 'ln';  // Define this var for table.inc.php.

include ('includes/table.inc.php');

include ('includes/footer.php');
?>