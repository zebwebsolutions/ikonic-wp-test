<?php
/*
Template Name: Coffee Template
*/

get_header();

// Call the hs_give_me_coffee() function
$coffee_link = hs_give_me_coffee();

// Display the coffee link
?>
<div class="coffee-link">
  <?php echo 'Here is your cup of coffee: <a href="' . $coffee_link . '">Coffee</a>'; ?>
</div>

<?php

get_footer();
?>
