<?php get_header();
/*Template Name: Genres*/
?>

<h1 class="text-danger font-weight-light text-center"><?php the_title(); ?></h1> <?php
echo '</br>';
the_post();
echo '<br>';
the_content();
?>
<?php
$genres = get_terms(array(
    'hide_empty' => false,
    'taxonomy' => 'dn_genres',
    'meta_type' => 'slug'
));
$genuri = array_column($genres, 'name');
?>

<div class="row">
<?php foreach ($genuri as $genre) { ?>
 <a href="<?php echo $genre; ?>"class="taxterm" style="background-color:#<?php echo rand(15,80); ?>0040"> <!-- trick that shows random colors on every page load -->
 <?php echo $genre; ?></a>
<?php } ?>
</div>

<?php get_footer(); ?>
