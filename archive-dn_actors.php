<?php get_header(); ?>
<h1 class="text-danger font-weight-light ">Lista de actori</h1>

<?php
$argsactori = array(
    'post_type' => 'dn_actors',
    'orderby' => 'title',
    'order' => 'asc',
    'posts_per_page' => '-1'
);

$actori = new wp_query($argsactori);

while (
    $actori->have_posts()
): ?><div class="text-center m-4 border-bottom border-danger"><?php $actori->the_post(); ?>
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php echo '</br>'; ?></div><?php endwhile;
?>
<?php wp_reset_postdata(); ?>


<?php get_footer(); ?>
