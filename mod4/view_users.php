<?php

// This script retrieves all the records from the users table.

$myscript = 'view_users.php';
$page_title = 'View the Current Users';
include ('includes/header.php');

require_once ('includes/mysqli_connect.php'); // Connect to the db.
// Page header:
$q = 'SELECT COUNT(custId) FROM customers';
$r = @mysqli_query($dbc, $q);
$row = @mysqli_fetch_array($r, MYSQLI_NUM);
$num = $row[0];
echo "<!-- row=$row -->";
echo '<h1>Registered Users</h1>' .
 "<p class=usercount>There are currently $num registered users.</p>\n";

$order_by = 'lastname'; // Define this var for table.inc.php.
$sort = 'ln';  // Define this var for table.inc.php.
include ('includes/table.inc.php');

include ('includes/footer.php');
?>