
<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
      the_post(); ?>
      <div class="page" id="page-<?php the_ID(); ?>">
      <div class="row">
    <div class="col-lg-4 col-md-6">
    <div class="featured-image">
    <?php if (has_post_thumbnail()) {
            the_post_thumbnail();
        } ?></div>
    </div>
    <div class="col-lg-8 col-md-6 bg-light order-first order-md-last">
    <h1 class="text-danger font-weight-light"><?php the_title(); ?></h1>
    <?php the_content(); ?>
    </div>
    
    </div>
    </div>
					
<?php
    }
}
?>


<?php get_footer(); ?>
