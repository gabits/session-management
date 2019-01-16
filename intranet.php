<?php

require 'includes/header.php';
require 'authentication.php';

require_authentication();

include 'forms/logout.php';
?>

<h1>Intranet</h1>
<ul>
    <li><a href="PfPresults.php">Problem Solving for Programming – PfP Results</a></li>
    <li><a href="P1results.php">Web Programming using PHP - P1 Results</a></li>
    <li><a href="DTresults.php">Introduction to Database Technology - DT Results</a></li>
</ul>
