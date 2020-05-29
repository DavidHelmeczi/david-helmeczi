
<?php get_header(); ?>


<h1 class="text-danger font-weight-light ">Filme regizate de <?php the_title(); ?></h1><?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
    }
}

$connected = new WP_Query([
    'relationship' => [
        'id' => 'movies_to_directors',
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
