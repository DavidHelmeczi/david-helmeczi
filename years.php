<?php get_header();
/*Template Name: Years*/
?>

<h1 class="text-danger font-weight-light text-center"><?php the_title(); ?></h1> <?php
echo '</br>';
the_post();
echo '<br>';
the_content();
?>
<?php
$years = get_terms(array(
    'hide_empty' => false,
    'taxonomy' => 'dn_years',
    'meta_type' => 'slug'
));
$anii = array_column($years, 'name');
?>

<div class="row">
<?php foreach ($anii as $year) { ?>
 <a href="<?php echo $year; ?>"class="taxterm" style="background-color:#<?php echo rand(
    15,
    80
); ?>0040">
 <?php echo $year; ?></a>
<?php } ?>
</div>

<?php get_footer(); ?>
