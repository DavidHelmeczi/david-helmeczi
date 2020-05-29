
<?php get_header(); ?>
<h1 class="text-danger font-weight-light ">Filme cu <?php the_title(); ?></h1><?php if (
    have_posts()
) {
    while (have_posts()) {
        the_post();
    }
} ?>
    <div class="featured-image">
    <?php if (has_post_thumbnail()) {
    the_post_thumbnail();
} ?>
    </div><?php
    the_content();
    $connected = new WP_Query([
        'relationship' => [
            'id' => 'movies_to_actors',
            'to' => get_the_ID()
        ],
        'nopaging' => true
    ]);
    while ($connected->have_posts()):

        $connected->the_post();

        require 'template-parts/loop-movies.php';
        ?>
	</div>
    
	</div>
	</div>
    <?php
    endwhile;
    wp_reset_postdata();

    get_footer();
     ?>
