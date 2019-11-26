<?php

if(isset($_POST["fname"]) && isset($_POST["lname"])) {
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);
    
    // Creating full name by joining first and last name
    $fullname = $fname . " " . $lname;

    // Displaying a welcome message
    echo "Hello, $fullname! Welcome to our website.";
} else {
    echo "Hi there! Welcome to our website.";
}