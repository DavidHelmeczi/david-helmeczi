<?php get_header(); ?>
<h1 class="text-danger font-weight-light ">Lista de regizori</h1>

<?php
$argsdirectori = array(
    'post_type' => 'dn_directors',
    'orderby' => 'title',
    'order' => 'asc',
    'posts_per_page' => '-1'
);

$directori = new wp_query($argsdirectori);

while (
    $directori->have_posts()
): ?><div class="text-center m-4 border-bottom border-danger"><?php $directori->the_post(); ?>
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php echo '</br>'; ?></div><?php endwhile;
?>
<?php wp_reset_postdata(); ?>


<?php get_footer(); ?>
