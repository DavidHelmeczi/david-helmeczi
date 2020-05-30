<?php get_header();
/*Template Name: Istoric*/
?>
<script>
window.onload =  istoricAjaxPosts();

</script>


    <h1 class="text-danger tax_title font-weight-light"><?php the_title(); ?><button type="button" class="ml-4 btn btn-danger" id="clear_history">Sterge istoric</button></h1>
    <script>
    $( "#clear_history" ).click(function() {
        setCookie("istoricCookie", '', -1);
        $('#istoric_movies_list').html('<h3 class="alert alert-success">Clear!</h3>') //stergem cookie-ul si afisam mesaj de confirmare
    });
    </script>
    <ul id="istoric_movies_list" class="list-group list-group-flush">
        <div id="loader" class="d-flex justify-content-center">
            <div class="spinner-border custom_spinner" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div style="font-size:1.5rem; padding-left:1rem;">
                Loading..
            </div>
        </div>
    </ul>




<?php get_footer(); ?>
