<?php
/*
Plugin Name: Prayer Form Template Plugin with Classes
*/
get_header();?>

<?php the_title();
echo do_shortcode('[prayer_form]');

?>



<?php get_footer();?>