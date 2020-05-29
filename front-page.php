test 
<?php
get_header();
the_post();
$count_posts = wp_count_posts('dn_movies'); //numarul total al filmelor
$numTermsgenuri = wp_count_terms('dn_genres', array(
    'hide_empty' => false,
    'parent' => 0
)); //numarul total al genurilor
$numTermsactori = wp_count_posts('dn_actors'); //numarul total al actorilor
$numTermsdirectori = wp_count_posts('dn_directors'); //guess what :))
?>
<div class="page" id="page-<?php the_ID(); ?>">

<h1 class="text-danger pb-5 font-weight-light text-center "><?php the_title(); ?></h1></div>
<h4 class="text-dark pb-4 font-weight-light text-justify "?>Site-ul nostru vă pune la dispoziție o listă cu <a href="./movie">
<?php echo $count_posts->publish; ?> </a> filme împărțite pe <a href="./genuri">  
<?php echo $numTermsgenuri; ?> </a>genuri. La fel puteți vedea filmografia a <a href="./actor">
<?php echo $numTermsactori->publish; ?> </a>actori sau a <a href="./director">
<?php echo $numTermsdirectori->publish; ?> </a>regizori. </h4>
<div class="row">
<div class="col px-4 bg-light">
<h2 class="text-dark pb-4 font-weight-light text-center"><u>Cele mai vechi filme</u></h2>
<?php
$termsyears = get_terms('dn_years', array(
    'order' => 'ASC',
    'parent' => 0
));
$nrfilme = 10; //cate filme vrem sa afisam in total dintr-o categorie ex. Cele mai vechi filme
foreach ($termsyears as $term) {
    $args = array(
        'post_type' => 'dn_movies',
        'posts_per_page' => $nrfilme,
        'tax_query' => array(
            array(
                'taxonomy' => 'dn_years',
                'field' => 'slug',
                'terms' => $term->slug
            )
        ),
        'no_found_rows' => true
    );

    $query = new WP_Query($args); //pentru fiecare an facem un query
    if ($query->have_posts() and $nrfilme > 0) { //daca inca nu am afisat cele 10 filme specizate la $nrfilme incepem sa afisam filmele
        while ($query->have_posts()) {
            $query->the_post();
            require ('template-parts/loop-movies.php'); ?>
            


    </div>
    </div>
    </div>
    </br>
    <?php
        }
    }

    $nrfilme = $nrfilme - $query->post_count;
    if ($nrfilme <= 0) {  //if we reach 10 films then break
        break;
    }
}

/* Partea cu cele mai lungi si scurte filme  ?>
</br>
<h2 class="text-dark pb-4 font-weight-light text-center"><u>Cele mai scurte filme</u></h2>
<?php
$args = array(
        'post_type' => 'dn_movies',
        'posts_per_page' => '10',
        'meta_key' => 'runtime',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'no_found_rows'=> true,
    );
$query= new WP_Query($args);

if($query->have_posts()){
    while($query->have_posts()){
        $query->the_post();
        require('template-parts/loop-movies.php');?>

        </div>
        </br>
    <?php }} */
?>

</div>
<div class="col px-4 bg-light">
<h2 class="text-dark pb-4 font-weight-light text-center"><u>Cele mai noi filme</u></h2>
<?php
$termsyears = get_terms('dn_years', array(
    'order' => 'DESC',
    'number' => '10',
    'parent' => 0
));
$nrfilme = 10;
foreach ($termsyears as $term) {
    $args = array(
        'post_type' => 'dn_movies',
        'posts_per_page' => $nrfilme,
        'tax_query' => array(
            array(
                'taxonomy' => 'dn_years',
                'field' => 'slug',
                'terms' => $term->slug
            )
        ),
        'no_found_rows' => true
    );

    $query = new WP_Query($args);
    if ($query->have_posts() and $nrfilme > 0) {
        while ($query->have_posts()) {
            $query->the_post();
            require 'template-parts/loop-movies.php'; ?>
            
    </div>
    </div>
    </div>
    </br>
    <?php
        }
    }

    $nrfilme = $nrfilme - $query->post_count;
    if ($nrfilme == 0) {
        break;
    }
}

/*  Partea cu cele mai lungi si scurte filme   ?>
</br>
<h2 class="text-dark pb-4 font-weight-light text-center"><u>Cele mai lungi filme</u></h2>
<?php
$args = array(
        'post_type' => 'dn_movies',
        'posts_per_page' => '10',
        'meta_key' => 'runtime',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'no_found_rows'=> true,
    );
$query= new WP_Query($args);

if($query->have_posts()){
    while($query->have_posts()){
        $query->the_post();
        require('template-parts/loop-movies.php');?>

        </div>
        </br>
    <?php }} */
?>
  
</div>
</div>

            



<?php  ?>


<?php get_footer(); ?>
