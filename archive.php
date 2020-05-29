
<?php get_header(); ?>

<h1 class="text-danger font-weight-light ">Filme din <?php echo the_archive_title('', false); ?></h1>				
	
    <nav class="pagination justify-content-center"> 

	<?php dn_pagination_bar(); //paginare on top?>

    </nav>

    <?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        require 'template-parts/loop-movies.php'; ?>
						</div>
						</div>
						</div>
        <?php
            }
            } 
        ?>


<nav class="pagination justify-content-center">

<?php dn_pagination_bar(); //paginare on bottom?>

</nav>



<?php get_footer(); ?>
