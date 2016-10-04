<?php
// This script searches for and retrieves all the records from the users table.

$myscript = 'searchusers.php';
$page_title = 'Search for Current Users';
include ('includes/header.php');
echo '<h1>Search</h1>' .
 '<h2>Click on blue titles to sort your data</h2><br />';
?>
<form action="view_userssort.php" method="post">
    <div class="fieldSet">
        <fieldset>
            <p><label class="field" for="name">Search Name:</label><input type="text" name="name" size="15" maxlength="20" /> </p>
            <p><input id="submit_button" type="submit" name="submit" value="Search" /></p>
        </fieldset>
    </div>
</form>
<?php
include ('includes/footer.php');
?>