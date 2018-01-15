<?php

$link = @mysqli_connect("localhost", "nikiforos", "wn6ZwC3NyuJW6y6p", "rick_and_morty_website");

if (!$link) {
    echo '<p>Error connecting to the database <br>';  
    echo 'If this error insists, please mind contact administrator.</p>';
    exit(); 
}







?>
