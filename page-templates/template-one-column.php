
<?php
/*Template Name: No column*/

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post(); ?>
					<div class="page" id="page-<?php the_ID(); ?>">
          
   
    <h1 class="text-danger font-weight-light"><?php the_title(); ?></h1>
    <?php the_content(); ?>
    </div>
    

					
<?php
    }
}
?>

<?php get_footer(); ?>
