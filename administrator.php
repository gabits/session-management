<?php

include 'includes/header.php';
include_once 'authentication.php';

require_admin_access();

?>

<link rel="stylesheet" type="text/css" href="css/main.css">
<main>
    <h3>Administrator</h3>
    <ul>
        <li><a href="forms/register_new_user.php">Register a new user</a></li>
    </ul>


<?php include 'includes/footer.php'?>
