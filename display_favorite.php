<?php get_header(); ?>
<script>
window.onload = ajaxPosts(); //calls the ajax function as soon as the page is fully loaded
</script>


    <h1 class="tax_title font-weight-normal"><?php the_title(); ?></h1>
    <ul id="fav_movies_list" class="list-group list-group-flush">
        <div id="loader" class="d-flex justify-content-center">
            <div class="spinner-border custom_spinner" role="status"> <!-- loading spinner -->
            </div>
            <div style="font-size:1.5rem; padding-left:1rem;">
                Loading...  <!-- shows "Loading..." as default until ajax response arrives -->
            </div>
        </div>
    </ul>


<?php get_footer(); ?>
