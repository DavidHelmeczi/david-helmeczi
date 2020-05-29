
<?php get_header(); ?>

<h1 class="text-danger font-weight-light ">Rezultatele cautarii pentru "<?php echo $_GET['s'] ?>"</h1>				
	
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

            else echo '<h3 class="alert alert-danger">No posts were found</h3>'
        ?>


<nav class="pagination justify-content-center">

<?php dn_pagination_bar(); //paginare on bottom?>

</nav>



<?php get_footer(); ?>
