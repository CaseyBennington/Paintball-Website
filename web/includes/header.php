<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="includes/style.css" type="text/css"  />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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