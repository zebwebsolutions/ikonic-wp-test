<?php
/*
Template Name: Coffee Template
*/

get_header();

// Call the hs_give_me_coffee() function
$coffee_link = hs_give_me_coffee();

// Display the coffee link
echo 'Here is your cup of coffee: <a href="' . $coffee_link . '">Coffee</a>';

get_footer();
?>
