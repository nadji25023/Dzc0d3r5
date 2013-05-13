<?php
/*
 +-----------------------------------------------------------------------------+
 | File Path = "index.php"                                                     |
 |                                                                             |
 | This file is part of Inpress Wordpress Theme                                |
 | Copyright (C) 2013, YouCode Web Studio                                      |
 |                                                                             |
 | CONTENTS:                                                                   |
 |   The index page of the wordpress website                                   |
 |                                                                             |
 |   THIS FILE IS REQUIRED FOR THEME RUNNING                                   |
 +-----------------------------------------------------------------------------+
 | Author: YouCode Web Studio - Zakaria Sahnoune <jokface@hotmail.com>         |
 | Author URL: http://themeforest.net/user/youcode                             |
 +-----------------------------------------------------------------------------+
*/
?>
<?php get_header(); ?>



<!-- content -->
<div class="container">
<?php if ( have_posts() ) while ( have_posts() ) : the_post();
do_shortcode(the_content()); 
endwhile; ?>
    
<!-- end content -->
</div>


<?php get_footer(); ?>